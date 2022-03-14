<?
    //php lsnab/wp-content/themes/light/parsing/gettovar.php
    ini_set('max_execution_time', 900);

    require_once("../../../../wp-config.php");
    
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    include_once("simple_html_dom.php");

    function mb_ucfirst($text) {
        return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
    }

    $pars_pages = [
        // "https://blesslight.ru/collection/svet",
        // "https://blesslight.ru/collection/svet?page=2",
        // "https://blesslight.ru/collection/svet?page=3",
        // "https://blesslight.ru/collection/svet?page=4",
        // "https://blesslight.ru/collection/svet?page=5",

        // "https://blesslight.ru/collection/svet?page=6",
        // "https://blesslight.ru/collection/svet?page=7",
        // "https://blesslight.ru/collection/svet?page=8",
        // "https://blesslight.ru/collection/svet?page=9",

        // "https://blesslight.ru/collection/svet?page=10",
        // "https://blesslight.ru/collection/svet?page=11",
        // "https://blesslight.ru/collection/svet?page=12",
        // "https://blesslight.ru/collection/svet?page=13",

        // "https://blesslight.ru/collection/svet?page=14",
        // "https://blesslight.ru/collection/svet?page=15",
        // "https://blesslight.ru/collection/svet?page=16",
        // "https://blesslight.ru/collection/svet?page=17",
        
        // "https://blesslight.ru/collection/svet?page=18",
        // "https://blesslight.ru/collection/svet?page=19",
        // "https://blesslight.ru/collection/svet?page=20",
        // "https://blesslight.ru/collection/svet?page=21",

        "https://blesslight.ru/collection/svet?page=22",
        "https://blesslight.ru/collection/svet?page=23",
        "https://blesslight.ru/collection/svet?page=24"
    ];

    $context = stream_context_create(
        array(
            "http" => array(
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
            )
        )
    );

    $allTovar = [];

    add_filter('https_ssl_verify', '__return_false');

    foreach ($pars_pages as $p) {
        $p_html = file_get_html($p, false, $context);

        $elements = $p_html->find('.product-grid ul li');
        
        $indexElem = 0;
        foreach ($elements as $el) {
            $lnk = "https://blesslight.ru".$el->find(".name a")[0]->href;

            $tvr_html = file_get_html($lnk, false, $context);

            $tvr["lnk"] = $lnk;
            $tvr["name"] = mb_ucfirst($tvr_html->find('h1')[0]->plaintext);
            $tvr["sku"] = $tvr_html->find('#sku-field')[0]->plaintext;
            $tvr["price"] = trim(str_replace(array(" ","USD","руб.","₽", "ք","$",",",",00",".00"), "", $tvr_html->find('.price-new')[0]->plaintext));
            $tvr["nal"] = $tvr_html->find('.prod-stock span')[0]->plaintext;

            $description = $tvr_html->find('.description')[0]->plaintext;
            $description = substr($description, 0, strpos($description, "Наличие"));
            $description = explode("\n",$description);
            
            $tvr["param"] = [];
            foreach ($description as $d) {
                $param = explode(":", $d);
                if (empty(trim($param[0])))  continue;
                $tvr["param"][] = ["name" => trim($param[0]), "val" =>  trim($param[1])];
                
            }

            $tvr["galery"] = [];
            $galery = $tvr_html->find('.gallery a');
            foreach ($galery as $glr) {
                $tvr["galery"][] = $glr->href;
            }

            if (empty($tvr["galery"])) {
            
                $galery = $tvr_html->find('.photo a');
                foreach ($galery as $glr) {
                    $tvr["galery"][] = $glr->href;
                }
            }

            $tvr["cats"] = [];
            $cats = explode("»",$tvr_html->find('.breadcrumb')[0]->plaintext);
            $tvr["cats"][] = trim($cats[2]); 
            $tvr["cats"][] = trim($cats[2])." - ".trim($cats[3]); 

            wp_insert_term(trim($cats[2]), "lightcat");
            wp_insert_term(trim($cats[2])." - ".trim($cats[3]), "lightcat");


            $to_post_meta  = [ 
                '_offer_smile_descr' => "Товар: ".$tvr["name"], 
                '_offer_sku' => $tvr["sku"], 
                '_offer_nal' => $tvr["sku"], 
                '_offer_price' => $tvr["price"],
                '_offer_fulltext' => "Товар: ".$tvr["name"],
                '_offer_name' => $tvr["name"],
                '_offer_allsearch' => $tvr["name"]." ".$tvr["sku"],
            ];

            $indexCh = 0;
            foreach ($tvr["param"] as $carrecter) {
                $to_post_meta["_offer_cherecter|c_name|".$indexCh."|0|value"] = $carrecter["name"];
                $to_post_meta["_offer_cherecter|c_val|".$indexCh."|0|value"] = $carrecter["val"];
                $indexCh++;
            }

  

            $post_id = wp_insert_post(  wp_slash( array(
                'post_type'     => 'light',
                'post_author'    => 1,
                'post_status'    => 'publish',
                'post_title' => $tvr["name"],
                'post_excerpt'  => $tvr["name"]." ".$tvr["sku"],
                'post_content'  => $tvr["name"]." ".$tvr["sku"],
                'meta_input'     => $to_post_meta,
            ) ) );

            $postCat = [ get_term_by("name", $tvr["cats"][0], 'lightcat')->term_id, get_term_by("name", $tvr["cats"][1], 'lightcat')->term_id ];

            wp_set_object_terms( $post_id, $postCat, "lightcat" );

            $indexImg = 0;
            foreach ($tvr["galery"] as $imgMn) {
                $img1 = $imgMn;
                
                $ttl = $tvr["name"]." - фото ".(string)($indexImg+1);
                $img_id = media_sideload_image( $img1, $post_id, $ttl, "id" );
                
                // echo $img_id->get_error_message();

                add_post_meta( $post_id, '_offer_picture|gal_img|'.$indexImg.'|0|value', $img_id, true );
                add_post_meta( $post_id, '_offer_picture|gal_img_sku|'.$indexImg.'|0|value', "", true );
                add_post_meta( $post_id, '_offer_picture|gal_img_alt|'.$indexImg.'|0|value', $ttl, true );
                
                if ($indexImg == 0) set_post_thumbnail($post_id, $img_id);
                
                $indexImg++;
            } 

            

            $allTovar[] = $tvr;
            $indexElem++;

        }

        print_r($allTovar);
    }
?>