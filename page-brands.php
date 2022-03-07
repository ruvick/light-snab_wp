<?php 

/*
* Template Name: Бренды
*/

get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php echo get_template_part('template-parts/top', 'banner')?>
		<div class="container">
			<h1 class="page-h1"><span><?php the_title();?></span></h1>
			<div class="brands-about">
	          Мы собрали лучшие европейские и мировые бренды производителей люстр и светильников, которые есть на складе нашего интернет магазина. Мы можем поставить практически любое декоративное осещение. Свяжитесь с нами, если нужного товара нет на сайте.
	        </div>
	        <?php 
	        	$arr_brand = carbon_get_theme_option('as_complex_brand');
	        	if($arr_brand):
	        ?>
	        <div class="page-brands-wrapper">
	        	<?php foreach($arr_brand as $brand):?>
	        	<a href="#" data-text='<?php echo $brand['as_complex_brand_descr']?>'>
	        		<img src="<?php echo wp_get_attachment_image_src($brand['as_complex_brand_img'], 'full')[0];?>" alt="">
	        	</a>
	        <?php endforeach;?>
	        </div>
		    <?php endif;?>
		</div>
		
	    <section class="form-section" style="background-image: url(<?php echo get_template_directory_uri();?>/img/LIGHT_ban.jpg);">
	      
		      <?php get_template_part('template-parts/form-section');?>
	    </section>
	    <?php get_template_part('template-parts/reviews');?>
	</main>
</div>

<?php 
get_footer();