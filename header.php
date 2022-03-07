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
  <div style="display: none;">
    <div class="box-modal" id="messgeModal">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <div class = "modalline" id = "lineIcon">
    </div>
    
    <div class = "modalline" id = "lineMsg">
    </div>
    </div>
  </div>

  <div style="display: none;">
    <div class="box-modal" id="brand-modal">
        <div class="box-modal_close arcticmodal-close"></div>
        <div class = "modalline" id = "lineIcon">
    </div>
    
    <div class = "brand-modal-wrapper" id = "lineMsg">
      <div class="brand-modal__photo"></div>
      <div class="brand-modal__content"></div>
    </div>
    </div>
  </div>

  <div style="display: none;">
    <div class="box-modal" id="order-modal">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <div class="box-modal_close arcticmodal-close"></div>
        <div class = "modalline" id = "lineIcon">
          <form action="">
            <h2>Стать нашим партнером</h2>
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="tel" name="tel" placeholder="Ваш телефон">
            <input type="hidden" name="partner">
            <a href="#" class="uniSendBtn-2">Отправить</a>
          </form>
        </div>
    
    <div class = "modalline" id = "lineMsg">
    </div>
    </div>
  </div>
  <div style="display: none;">
    <div class="box-modal" id="question-modal">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <div class="box-modal_close arcticmodal-close"></div>
        <div class = "modalline" id = "lineIcon">
          <form action="">
            <h2>Задать вопрос</h2>
            <input type="text" name="name" placeholder="Ваше имя">
            <input type="tel" name="tel" placeholder="Ваш телефон">
            <a href="#" class="more-link uniSendBtn">Отправить</a>
          </form>
        </div>
    
    <div class = "modalline" id = "lineMsg">
    </div>
    </div>
  </div>

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
        </div>
      </div>
    </header>

    <div id="content" class="site-content">
