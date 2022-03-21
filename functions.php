<?php

define("COMPANY_NAME", "light-snab");
define("MAIL_RESEND", "noreply@ultrakresla.ru");

/**
 * light functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package light
 */

add_action( 'carbon_fields_register_fields', 'boots_register_custom_fields' );
function boots_register_custom_fields() {
require_once __DIR__ . '/inc/custom-field-options/metabox.php';
require_once __DIR__ . '/inc/custom-field-options/theme-options.php';
}
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
require_once( get_template_directory() . '/inc/carbon-fields/vendor/autoload.php' );
\Carbon_Fields\Carbon_Fields::boot();
}

if ( ! function_exists( 'light_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function light_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on light, use a find and replace
		 * to change 'light' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'light', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'light' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'light_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'light_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function light_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'light_content_width', 640 );
}
add_action( 'after_setup_theme', 'light_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function light_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'light' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'light' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'light_widgets_init' );


function cf_search_join( $join ) {
	global $wpdb;
	if ( is_search() ) {
		$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}
	return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
* Modify the search query with posts_where
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
*/

function cf_search_where( $where ) {
	global $pagenow, $wpdb;
	if ( is_search() ) {
		$where = preg_replace(
			"/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
			"(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
	}
	return $where;
}
add_filter('posts_where', 'cf_search_where');

/**
* Prevent duplicates
*
* http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
*/

function cf_search_distinct( $where ) {
	global $wpdb;
	if ( is_search() ) {
		return "DISTINCT";
	}
	return $where;
}
add_filter('posts_distinct', 'cf_search_distinct');


/**
 * Enqueue scripts and styles.
 */
function light_scripts() {
	wp_enqueue_style("fonts", '//fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap');

	wp_enqueue_style('arctic', get_template_directory_uri() . '/css/jquery.arcticmodal-0.3.css', array(), null, 'all');

	wp_enqueue_style( 'light-style', get_stylesheet_uri() );

	wp_enqueue_script('jquery');

	wp_enqueue_script( 'light-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'light-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script('libs', get_template_directory_uri() . '/js/scripts.min.js', array(), null, true);

	wp_enqueue_script('arctic', get_template_directory_uri() . '/js/jquery.arcticmodal-0.3.min.js', array(), null, true); 

	wp_enqueue_script("vendors", get_template_directory_uri() . '/js/vendors.min.js', array(), null, true);

	wp_enqueue_script("main", get_template_directory_uri() . '/js/common.js', array(), null, true); 

	if ( is_page(17172))
	{
		wp_enqueue_script( 'vue', get_template_directory_uri().'/js/vue.js', array(), $scrypt_version, true);
		wp_enqueue_script( 'axios', get_template_directory_uri().'/js/axios.min.js', array(), $scrypt_version, true);
		wp_enqueue_script( 'bascet', get_template_directory_uri().'/js/bascet.js', array(), $scrypt_version, true); 
	}

	// if ( is_page(219))
	// {
	// 	wp_enqueue_script( 'vue', get_template_directory_uri().'/js/vue.js', array(), $scrypt_version, true);
	// 	wp_enqueue_script( 'axios', get_template_directory_uri().'/js/axios.min.js', array(), $scrypt_version, true);
	// 	wp_enqueue_script( 'cabinet', get_template_directory_uri().'/js/cabinet.js', array(), $scrypt_version, true);
	// }

	wp_localize_script( 'main', 'allAjax', array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce'   => wp_create_nonce( 'NEHERTUTLAZIT' )
    ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'light_scripts' );

add_action( 'wp_ajax_universal_send_2', 'universal_send_2' );
  add_action( 'wp_ajax_nopriv_universal_send_2', 'universal_send_2' );

  function universal_send_2() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт Light Snab <noreply@propuska-mkad-ttk-sk.ru>',
        'content-type: text/html',
      );
    
      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
      if (wp_mail(carbon_get_theme_option( 'as_email_send' ), 'Заказ с сайта', '<strong>С какой формы:</strong> '.$_REQUEST["msg"].'<br/> <strong>' . $_REQUEST["partner"] . '</strong> '.'<br/> <strong>Имя:</strong> '.$_REQUEST["name"].' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"], $headers))
        wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
      else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>");
      
    } else {
      wp_die( 'НО-НО-НО!', '', 403 );
    }
  }

add_action( 'wp_ajax_universal_send', 'universal_send' );
  add_action( 'wp_ajax_nopriv_universal_send', 'universal_send' );

  function universal_send() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт Light Snab <noreply@propuska-mkad-ttk-sk.ru>',
        'content-type: text/html',
      );
    
      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
      if (wp_mail(carbon_get_theme_option( 'as_email_send' ), 'Заказ с сайта', '<strong>С какой формы:</strong> '.$_REQUEST["msg"].'<br/> <strong>Имя:</strong> '.$_REQUEST["name"].' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"] .' <br/> <strong>E-mail:</strong> '.$_REQUEST["email"] .' <br/> <strong>Сообщение:</strong> '.$_REQUEST["comment"], $headers))
        wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
      else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>");
      
    } else {
      wp_die( 'НО-НО-НО!', '', 403 );
    }
  }

function cc_mime_types($mimes) {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function main_menu() {
	wp_nav_menu(array(
		'theme_location' => 'menu-1',
		'container' => false,
		'menu_class' => 'menu ul-clean',
	));
}
add_filter('template_include', 'my_template');
function my_template( $template ) {
 $main_cat_id = 3;
 if (cat_is_ancestor_of( $main_cat_id, get_query_var('cat') ) or is_category( $main_cat_id) ) {
  $new_template = locate_template( array( 'category-3.php' ) );
  return $new_template ;
 }
 return $template;
}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


	// Регистрация кастомного поста

	add_action( 'init', 'create_light_taxonomies' );

	function create_light_taxonomies(){
	
		register_taxonomy('lightcat', array('light'), array(
			'hierarchical'  => true,
			'labels'        => array(
				'name'              => "Категория товара",
				'singular_name'     => "Категория товара",
				'search_items'      => "Найти категорию товара",
				'all_items'         => __( 'Все категории' ),
				'parent_item'       => __( 'Дочерние категории' ),
				'parent_item_colon' => __( 'Дочерние категории:' ),
				'edit_item'         => __( 'Редактировать категорию' ),
				'update_item'       => __( 'Обновить категорию' ),
				'add_new_item'      => __( 'Добавить новую категорию товара' ),
				'new_item_name'     => __( 'Имя новой категории товара' ),
				'menu_name'         => __( 'Категории товара' ),
			),
			'description' => "Категория товаров для магазина",
			'public' => true,
			'show_ui'       => true,
			'query_var'     => true,
			'show_in_rest'  => true,
			'show_admin_column'     => true,
		));
	
		register_taxonomy('lightstyle', array('light'), array(
			'hierarchical'  => false,
			'labels'        => array(
				'name'              => "Стиль дизайна",
				'singular_name'     => "Стиль дизайна",
				'search_items'      => "Найти стиль",
				'all_items'         => __( 'Все стили' ),
				'parent_item'       => __( 'Дочерние стили' ),
				'parent_item_colon' => __( 'Дочерние стили:' ),
				'edit_item'         => __( 'Редактировать стиль' ),
				'update_item'       => __( 'Обновить стиль' ),
				'add_new_item'      => __( 'Добавить новый стиль' ),
				'new_item_name'     => __( 'Имя новго стиля товара' ),
				'menu_name'         => __( 'Стили товара' ),
			),
			'description' => "Стиль дизайна товаров",
			'public' => true,
			'show_ui'       => true,
			'query_var'     => true,
			'show_in_rest'  => true,
			'show_admin_column'     => true,
		));
	}
	
	
	add_action('init', 'light_custom_init');
	
	function light_custom_init(){
		register_post_type('light', array(
			'labels'             => array(
				'name'               => 'Продукты', // Основное название типа записи
				'singular_name'      => 'Продукты', // отдельное название записи типа Book
				'add_new'            => 'Добавить новый',
				'add_new_item'       => 'Добавить новый товар',
				'edit_item'          => 'Редактировать товар',
				'new_item'           => 'Новый товар',
				'view_item'          => 'Посмотреть товар',
				'search_items'       => 'Найти товар',
				'not_found'          =>  'Товаров не найдено',
				'not_found_in_trash' => 'В корзине товаров не найдено',
				'parent_item_colon'  => '',
				'menu_name'          => 'Товары'
	
			  ),
			'taxonomies' => array('lightcat'), 
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'show_admin_column'        => true,
			'show_in_quick_edit'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats')
		) );
	}

	
// Колонки в таблицу админки

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

function posts_columns($defaults){
    $defaults['riv_post_sku'] = __('Артикул');
	$defaults['riv_post_thumbs'] = __('Миниатюра');
	$defaults['riv_post_price'] = __('Цена');
	return $defaults;
}

function posts_custom_columns($column_name, $id){


	if($column_name === 'riv_post_sku'){
		$SKU_t = get_post_meta(get_the_ID(), "_offer_sku", true);
		echo empty($SKU_t)?"-":$SKU_t;
	}

	if($column_name === 'riv_post_thumbs'){	
		$img1 = get_the_post_thumbnail_url( get_the_ID(), "thumbnail");

		if (empty($img1))
			$img1 = get_bloginfo("template_url")."/img/no-photo.jpg";

		echo '<img width = "60" src = "'.$img1.'" />';


	}

	if($column_name === 'riv_post_price'){
		$PRICE = get_post_meta(get_the_ID(), "_offer_price", true);
		echo empty($PRICE)?"0 руб.":$PRICE." руб.";
	}


}


	// Отправка корзины
	
	function tovarTo1c($bascetElem) {
		return 
		"<Товар>\n\r".
			"<Ид>".$bascetElem->sku1c."</Ид>\n\r".
			'<Наименование>'.$bascetElem->name.'</Наименование>\n\r'.
			'<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>\n\r'.
			"<ЦенаЗаЕдиницу>".$bascetElem->price."</ЦенаЗаЕдиницу>\n\r".
			"<Количество>".$bascetElem->count."</Количество>\n\r".
			"<Сумма>".$bascetElem->subtotal."</Сумма>\n\r".
			"<ЗначенияРеквизитов>\n\r".
				"<ЗначениеРеквизита>\n\r".
					"<Наименование>ВидНоменклатуры</Наименование>\n\r".
					"<Значение>Товар</Значение>\n\r".
				"</ЗначениеРеквизита>\n\r".
				
				"<ЗначениеРеквизита>\n\r".
					"<Наименование>ТипНоменклатуры</Наименование>\n\r".
					"<Значение>Товар</Значение>\n\r".
				"</ЗначениеРеквизита>\n\r".
			"</ЗначенияРеквизитов>\n\r".
		"</Товар>\n\r";
	}	

	function sendToFtp($fileAdr, $zak_number) {
		$ftp_server = "81.177.141.133";
		$ftp_user_name = "asmi046_1s";
		$ftp_user_pass = "!#(yTY)uz9d8";

		$conn_id = ftp_connect($ftp_server);
		$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
		ftp_pasv($conn_id, true);
		if ((!$conn_id) || (!$login_result)) {
			return false;
		} else {
			$upload = ftp_put ($conn_id, "orders/".$zak_number.".xml", $fileAdr, FTP_ASCII);
			return true;
		}
		ftp_close($conn_id);
	}

	add_action( 'wp_ajax_send_cart', 'send_cart' );
	add_action( 'wp_ajax_nopriv_send_cart', 'send_cart' );

	function send_cart() {
		if ( empty( $_REQUEST['nonce'] ) ) {
			wp_die( '0' );
		}
		
		if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {

			$headers = array(
				'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>',
				'content-type: text/html', 
			);
		
			add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
			
			$adr_to_send = carbon_get_theme_option("as_email_send");
			$adr_to_send = (empty($adr_to_send))?"asmi046@gmail.com":$adr_to_send;
			
			$zak_number = "A".date("H").date("i").date("s").rand(100,999);

			$mail_content = "<h1>Заказ на сайте №".$zak_number."</h1>";
			
			$bscet_dec = json_decode(stripcslashes ($_REQUEST["bascet"]));
			
			// Отправка в базу основного заказа

			global $wpdb;
			$wpdb->insert( "shop_zakhistory", array(
				"agent" => empty($_COOKIE["agriautorise"])?"":$_COOKIE["agriautorise"],
				"zak_number" => $zak_number,
				"zak_summ" => $_REQUEST["bascetsumm"],
				"zak_count" => count($bscet_dec),
				"client_name" => $_REQUEST["name"],
				"client_phone" => $_REQUEST["phone"],
				"client_mail" => $_REQUEST["mail"],
				"client_adr" => $_REQUEST["adres"],
				"client_comment" => $_REQUEST["comment"],
			) );


			$mail_content .= "<table style = 'text-align: left;' width = '100%'>";
				$mail_content .= "<tr>";
					$mail_content .= "<th></th>";
					$mail_content .= "<th>ТОВАР</th>";
					$mail_content .= "<th>КОЛИЧЕСТВО</th>";
					$mail_content .= "<th>СУММА</th>";
				$mail_content .= "</tr>";

				$toXMLstr = "";

				for ($i = 0; $i<count($bscet_dec); $i++) {
					$toXMLstr .= tovarTo1c($bscet_dec[$i]);
					$mail_content .= "<tr>";
						$mail_content .= "<td><img src = '".$bscet_dec[$i]->picture."' width = '70' height = '70'></td>";
						$mail_content .= "<td><a href = '".$bscet_dec[$i]->lnk."'>".$bscet_dec[$i]->name." / ".$bscet_dec[$i]->sku."</a></td>";
						$mail_content .= "<td>".$bscet_dec[$i]->count."</td>";
						$mail_content .= "<td>".$bscet_dec[$i]->subtotal." р.</td>";
					$mail_content .= "</tr>";

					// Отправка в базу содержимого корзины

					$wpdb->insert( "shop_zaktovar", array(
						"zak_number" => $zak_number,
						 "price" => $bscet_dec[$i]->price,
						 "price_old" => empty($bscet_dec[$i]->oldprice)?"":$bscet_dec[$i]->oldprice,
						 "subtotal" => $bscet_dec[$i]->subtotal,
						"sku" => $bscet_dec[$i]->sku,
						"lnk" => $bscet_dec[$i]->lnk,
						"name" => $bscet_dec[$i]->name,
						"count" => $bscet_dec[$i]->count,
						"picture" => $bscet_dec[$i]->picture,
					) );

				}

			$mail_content .= "</table>";
			$mail_content .= "<h2>Сумма: ".$_REQUEST["bascetsumm"]." р.</h2>";


			 $zaktpl = file_get_contents(__DIR__.'/zaktempl.xml', true);
			// ---- Формирование файла для 1С

			$clname = 	explode(" ", $_REQUEST["name"])[0];
			$clnames = 	explode(" ", $_REQUEST["name"])[1];

			 $zaktpl = str_replace("{zaknum}", $zak_number, $zaktpl);
			 $zaktpl = str_replace("{zakdata}", date("Y-m-d"), $zaktpl);
			 $zaktpl = str_replace("{zaksumm}", $_REQUEST["bascetsumm"], $zaktpl);
			 $zaktpl = str_replace("{zaktime}", date("H:i:s"), $zaktpl);
			 $zaktpl = str_replace("{name}", $clname, $zaktpl);
			 $zaktpl = str_replace("{inn}", ($_REQUEST["inn"] == "null")?"":$_REQUEST["inn"], $zaktpl);
			 $zaktpl = str_replace("{sname}", $clnames, $zaktpl);
			 $zaktpl = str_replace("{adr}", $_REQUEST["adres"], $zaktpl);
			 $zaktpl = str_replace("{clientname}", $clname." ".$clnames, $zaktpl);
			 $zaktpl = str_replace("{clientnamefull}", $clname." ".$clnames, $zaktpl);
			 $zaktpl = str_replace("{clienphone}",  $_REQUEST["phone"], $zaktpl);
			 $zaktpl = str_replace("{clientmail}", $_REQUEST["mail"], $zaktpl);
			 $zaktpl = str_replace("{zakcomment}", $_REQUEST["comment"], $zaktpl);
			 $zaktpl = str_replace("{tovars}", $toXMLstr, $zaktpl);
			
			 $fileAdr = __DIR__."/1s/orders/".$zak_number.".xml";
			 file_put_contents($fileAdr, $zaktpl);
			
			 $ftprez = sendToFtp($fileAdr, $zak_number);

			$mail_content .= "<strong>Имя:</strong> ".$_REQUEST["name"]."<br/>";
			$mail_content .= "<strong>Телефон:</strong> ".$_REQUEST["phone"]."<br/>";
			$mail_content .= "<strong>e-mail:</strong> ".$_REQUEST["mail"]."<br/>";
			$mail_content .= "<strong>Адрес:</strong> ".$_REQUEST["adres"]."<br/>";
			$mail_content .= "<strong>Комментарий:</strong> ".$_REQUEST["comment"]."<br/>";
			// $mail_content .= "<strong>FTP:</strong> ".($ftprez)?"Загружен":"Не загружен"."<br/>";

			$mail_them = "Заказ на сайте Strader";


			
			if (wp_mail($adr_to_send, $mail_them, $mail_content, $headers)) 
			{

				wp_die(json_encode(array("send" => true )));
			}
			else {
				wp_die( 'Ошибка отправки!', '', 403 );
			}
			
		} else {
			wp_die( 'НО-НО-НО!', '', 403 );
		}
	}