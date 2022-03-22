<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package light
 */

?>

</div><!-- #content -->

<footer class="footer">
  <div class="container">
    <div class="logo" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_theme_option('as_logo_white'), 'full')[0];?>)"></div>
    <div class="footer-block">
      <h3 class="footer-title">Навигация</h3>
      <?php main_menu();?>
    </div>
    <div class="footer-block">
      <h3 class="footer-title">Мы в соцсетях</h3>
      <ul class="soc-menu ul-clean">
        <?php if(carbon_get_theme_option('as_vk')):?>
        <li><a href="<?php echo carbon_get_theme_option('as_vk');?>" target="_blank"><span style="background-image: url(<?php echo get_template_directory_uri();?>/img/vk.svg)"></span> Вконтакте</a></li>
      <?php endif;?>
      </ul>
    </div>
    <div class="footer-block">
      <h3 class="footer-title">Контакты</h3>
      <div class="address"><?php echo carbon_get_theme_option('as_address');?></div>
      <div class="footer-phone">
        Тел.: <a href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', carbon_get_theme_option('as_phone'))?>"><?php echo carbon_get_theme_option('as_phone');?></a>
      </div>
      <div class="footer-mail-wrap">
        Для заказов: <a href="mailto:<?php echo carbon_get_theme_option('as_email');?>"><?php echo carbon_get_theme_option('as_email');?></a>
      </div>
      <div class="footer-mail-wrap">
        Оптовые закупки: <a href="mailto:<?php echo carbon_get_theme_option('as_email_offer');?>"><?php echo carbon_get_theme_option('as_email_offer');?></a>
      </div>
    </div>
  </div>
</footer>
</div><!-- #page -->
<div class="top-button"></div>
<?php wp_footer(); ?>

</body>

</html>
