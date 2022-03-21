<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package light
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>> 

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11"><link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri();?>/img/favicon/ls256.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri();?>/img/favicon/ls32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri();?>/img/favicon/ls16.png">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri();?>/img/favicon/safari-pinned-tab.svg" color="#00abaf">
  <meta name="theme-color" content="#00abaf"> 

  <?php wp_head(); ?>
	
	<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(65477215, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/65477215" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
	
</head>

<body <?php body_class(); ?>> 

<!-- Скрипт корзины, отправка -->
<script>  
  let main_page = "<?echo get_bloginfo("url"); ?>";
  let kabinet_page = "<?echo get_the_permalink(219); ?>";
  let bascet_page = "<?echo get_the_permalink(17172); ?>"; 
  let thencs_page = "<?echo get_the_permalink(17179); ?>";   
  let nophoto_page = "<?echo get_bloginfo("template_url");?>/img/no-photo.jpg";
</script> 

  <!-- Подключение  модальных окон-->
  <? include "modal-win.php";?>

  <div id="page" class="site">

    <header class="header">
      <div class="header-top">
        <div class="container">
          <div class="header-address"><?php echo carbon_get_theme_option('as_address');?></div>
          <a href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', carbon_get_theme_option('as_phone'))?>" class="header-phone"><?php echo carbon_get_theme_option('as_phone');?></a>
          <a href="mailto:<?php echo carbon_get_theme_option('as_email');?>" class="header-email"><?php echo carbon_get_theme_option('as_email');?></a>
        </div>
      </div>
      <div class="header-bottom"> 
        <div class="container">
          <a href="<?php echo home_url('/');?>" class="logo" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_theme_option('as_logo'), 'full')[0];?>)"></a>

          <nav class="main-menu">
            <div class="hamburger">
              <span class="hamburger-top"></span>
              <span class="hamburger-middle"></span>
              <span class="hamburger-bottom"></span>
            </div>
            <?php main_menu();?>
          </nav>
          <a href="<?php echo get_category_link(3);?>" class="header__brand"></a>
          <a href="<?php echo get_permalink(17172);?>" class="header__bascket bascket-icon"><span class="bascket-icon__number bascet_counter">0</span></a>
        </div>
      </div>
    </header>

    <div id="content" class="site-content">
