<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package light
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <section class="main-slider">
      <?php if(!empty(carbon_get_theme_option('banner_title_1')) && !empty(carbon_get_theme_option('banner_subtitle_1'))):?>
      <div class="main-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_theme_option('banner_image_1'), 'full')[0];?>)">
        <div class="container">
          <div class="main-slider__item-content">
            <div class="main-slider__item-title"><?php echo carbon_get_theme_option('banner_title_1');?></div>
            <div class="main-slider__item-subtitle"><?php echo carbon_get_theme_option('banner_subtitle_1');?></div>
          </div>
        </div>
      </div>
      <?php endif;?>
      <?php if(!empty(carbon_get_theme_option('banner_title_2')) && !empty(carbon_get_theme_option('banner_subtitle_2'))):?>
      <div class="main-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_theme_option('banner_image_2'), 'full')[0];?>)">
        <div class="container">
          <div class="main-slider__item-content">
            <div class="main-slider__item-title"><?php echo carbon_get_theme_option('banner_title_2');?></div>
            <div class="main-slider__item-subtitle"><?php echo carbon_get_theme_option('banner_subtitle_2');?></div>
          </div>
        </div>
      </div>
      <?php endif;?>
      <?php if(!empty(carbon_get_theme_option('banner_title_3')) && !empty(carbon_get_theme_option('banner_subtitle_3'))):?>
      <div class="main-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_theme_option('banner_image_3'), 'full')[0];?>)">
        <div class="container">
          <div class="main-slider__item-content">
            <div class="main-slider__item-title"><?php echo carbon_get_theme_option('banner_title_3');?></div>
            <div class="main-slider__item-subtitle"><?php echo carbon_get_theme_option('banner_subtitle_3');?></div>
          </div>
        </div>
      </div>
    <?php endif;?>
    </section>

    <section class="popular">
      <div class="container">
        <h2 class="popular__title">Популярные товары</h2>
        <div class="products-wrapper">
        <?
					$args = array(
						'posts_per_page' => 4,
						'post_type' => 'light',
						'orderby' => 'rand',
						'tax_query' => array(
								array(
										'taxonomy' => 'lightcat',
										'field'    => 'slug',
										'terms'    => 'dizajnerskie-svetilniki'
								),
						)
					);
					$query = new WP_Query($args);

					foreach( $query->posts as $post ){
						$query->the_post();
						get_template_part('template-parts/product-loop');
					}  
					wp_reset_postdata(); 
			?>
        </div>
      </div>
    </section>

    <section class="whom">
      <div class="container">
        <a href="<?php echo get_permalink(10);?>" class="whom-item">
          <div class="whom-item__photo" style="background-image: url(<?php echo get_template_directory_uri();?>/img/designer.jpg)"></div>
          <div class="whom-item__title">Дизайнерам <span class="color-yellow">/</span>Архитекторам</div>
        </a>
        <a href="<?php echo get_permalink(7);?>" class="whom-item">
          <div class="whom-item__photo" style="background-image: url(<?php echo get_template_directory_uri();?>/img/complect.jpg)"></div>
          <div class="whom-item__title">Комплектовщикам <span class="color-yellow">/</span>Снабженцам</div>
        </a>
      </div>
    </section>
    <section class="about">
      <div class="container">
        <h2 class="about-title"><?php echo carbon_get_theme_option('as_about_title');?></h2>
        <div class="about-subtitle"><?php echo carbon_get_theme_option('as_about_subtitle');?></div>
        <?php echo carbon_get_theme_option('as_about_text');?>
      </div>
    </section>

    <section class="offers">
      <div class="container">
        <div class="offers-item">
          <h2 class="offers-item__title">Дизайнеры <span class="color-yellow">/</span><br> Архитекторы <span class="color-yellow">/</span> Декораторы</h2>
          <div class="offers-item__descr">Став нашим партнером<br> Вы получаете</div>
          <ul class="offers-item__list ul-clean">
            <li>более 200  топ  брендов </li>
            <li>проверенный ассортимент</li>
            <li>сопровождение проекта</li>
            <li>подбор по визуализации</li>
            <li>составление КП заказчику</li>
            <li>производство по спец. заказу</li>
            <li>образцы и каталоги</li>
            <li>бонусная программа + Cashback</li>
            <li>бартер-реклама в соцсетях</li>
          </ul>
          <a href="#" data-partner="Стать партнером (Дизайнеры/Архитекторы/Декораторы)" class="offers-item__link">Отправить заявку</a>
        </div>
        <div class="offers-item">
          <h2 class="offers-item__title">Комплектовщики <span class="color-yellow">/</span> Снабженцы <span class="color-yellow">/</span> Строители</h2>
          <div class="offers-item__descr">Став нашим партнером<br> Вы получаете</div>
          <ul class="offers-item__list ul-clean">
            <li>более 50 000 товаров в наличии</li>
            <li>накопительная система скидок</li>
            <li>оформление спецификаций</li>
            <li>контроль качества поставок</li>
            <li>расчет освещения DiaLux</li>
            <li>выезд сотрудника на объект</li>
            <li>монтажная бригада</li>
            <li>гарантийное сопровождение</li>
            <li>услуга «примерки»</li>
          </ul>
          <a href="#" data-partner="Стать партнером (Комплектовщики/Снабженцы/Строители)" class="offers-item__link">Отправить заявку</a>
        </div>
        <div class="offers-item">
          <h2 class="offers-item__title">Интернет-магазины <span class="color-yellow">/</span> Салоны света</h2>
          <div class="offers-item__descr">Став нашим партнером<br> Вы получаете</div>
          <ul class="offers-item__list ul-clean">
            <li>более 250 брендов в одном месте</li>
            <li>актуальные остатки и контент</li>
            <li>экономия в логистике</li>
            <li>отгрузка от 1 единицы</li>
            <li>навигация по ассортименту</li>
            <li>печатная и рекламная продукция</li>
            <li>быстрые сроки отгрузки</li>
            <li>программа дропшиппинг</li>
            <li>гибкие условия возврата</li>
          </ul>
          <a href="#" data-formid="Заявка Стать партнером" data-mailmsg="Заявка Стать партнером" data-partner="Стать партнером (Интернет-магазины/Салоны света)" class="offers-item__link">Отправить заявку</a>
        </div>
      </div>
    </section>
    <section class="brands">
      <div class="container">
        <h2 class="section-title">У нас только лучшие бренды</h2>
        <div class="brands-about">
          Мы собрали лучшие европейские и мировые бренды производителей люстр и светильников, которые есть на складе нашего интернет магазина. Мы можем поставить практически любое декоративное осещение. Свяжитесь с нами, если нужного товара нет на сайте.
        </div>
      </div>
      <?php 
        $arr_brands = carbon_get_theme_option('as_complex_brand');
        if($arr_brands):
      ?>
      <div class="brands-wrapper-home">
      <div class="container">
      <div class="brands-wrapper page-brands-wrapper">
          <?php 
          $inc = 1;
          foreach($arr_brands as $brand):
              if($inc > 10) {
                break;
              }
            ?>
            <a href="#" data-text='<?php echo $brand['as_complex_brand_descr']?>'>
              <img src="<?php echo wp_get_attachment_image_src($brand['as_complex_brand_img'], 'full')[0];?>" alt="">
            </a>
          <?php 
          $inc++;
          endforeach;?>
        </div>
      </div>
      <div class="btn-wrap">
        <a href="<?php echo get_permalink(17);?>" class="more-link">Перейти к торговым маркам</a>
      </div>
      </div>
    <?php endif;?>
    </section>
    <section class="cert">
      <div class="container">
        <h2 class="section-title">Сертификаты</h2>
        <?php 
          $arr_cert = carbon_get_theme_option('complex_cert');
          if($arr_cert):
        ?>
        <div class="cert-slider">
          <?php foreach($arr_cert as $cert):?>
            <a href="<?php echo wp_get_attachment_image_src($cert['complex_cert_img'], 'full')[0];?>" data-lightbox="cert" style="background-image: url(<?php echo wp_get_attachment_image_src($cert['complex_cert_img'], 'large')[0];?>)" class="cert-slider__item"></a>
          <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
    </section>
    <section class="form-section" style="background-image: url(<?php echo get_template_directory_uri();?>/img/fon1.jpg);">
      <?php get_template_part('template-parts/form-section');?>
    </section>
    <?php get_template_part('template-parts/reviews');?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
