<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package light
 */

?>

<div class="container">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php //light_post_thumbnail(); ?>

	<div class="entry-content single-product">
		<div class="single-product__photo">
			<div class="single-slider__item" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);"></div>
			<?php if(carbon_get_the_post_meta('product_photo_1')):?>
				<div class="single-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('product_photo_1'), 'full')[0];?>);"></div>
			<?php endif;?>
			<?php if(carbon_get_the_post_meta('product_photo_2')):?>
				<div class="single-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('product_photo_2'), 'full')[0];?>);"></div>
			<?php endif;?>
			<?php if(carbon_get_the_post_meta('product_photo_3')):?>
				<div class="single-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('product_photo_3'), 'full')[0];?>);"></div>
			<?php endif;?>
			<?php if(carbon_get_the_post_meta('product_photo_4')):?>
				<div class="single-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('product_photo_4'), 'full')[0];?>);"></div>
			<?php endif;?>
			<?php if(carbon_get_the_post_meta('product_photo_5')):?>
				<div class="single-slider__item" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('product_photo_5'), 'full')[0];?>);"></div>
			<?php endif;?>
		</div>
		<div class="single-product__content">
			<h1 class="single-product__title"><?php the_title();?></h1>
			<div class="single-product__price single-product__item"> <span class = "parsPrice"><?php echo carbon_get_the_post_meta('product_price');?></span> ₽</div>
			<div class="single-product__char-wrap single-product__item">
				<div class="single-product__char">
					<div class=""><span class="single-product__char-name">Артикул: </span> <span class = "parsSku"><?php echo carbon_get_the_post_meta('product_sku');?></span></div>
					<div class=""><span class="single-product__char-name">Серия: </span> <span class = "parsSiries"><?php echo carbon_get_the_post_meta('product_series');?></span></div>
					<div class=""><span class="single-product__char-name">Применение: </span> 
						<?php if(carbon_get_the_post_meta('product_ceiling')):
							echo ' На потолок';endif;?>
						<?php if(carbon_get_the_post_meta('product_wall')):
							echo ' На стену';endif;?>
						<?php if(carbon_get_the_post_meta('product_table')):
							echo ' На стол';endif;?>
						<?php if(carbon_get_the_post_meta('product_floor')):
							echo ' На пол';endif;?>
						<?php if(carbon_get_the_post_meta('product_one')):
							echo ' Одна лампа';endif;?></div>
				</div>
			</div>
			<div class="single-product__descr1 single-product__item">
				<?php echo carbon_get_the_post_meta('product_descr');?>
			</div>
			<a href="#" class="more-link product-question" data-mailmsg="Задать вопрос о товаре <?php the_title();?>">Хочу купить</a>
		</div>
	</div><!-- .entry-content -->
	<div class="upsells">
		<div class="upsells-title">Товары серии <?php echo carbon_get_the_post_meta('product_series');?></div>
		<div class="products-wrapper">
			<?php 
			$array = array();
			if(carbon_get_the_post_meta('product_ceiling')):
					array_push($array, 'На потолок');endif;?>
				<?php if(carbon_get_the_post_meta('product_wall')):
					array_push($array, 'На стену');endif;?>
				<?php if(carbon_get_the_post_meta('product_table')):
					array_push($array, 'На стол');endif;?>
				<?php if(carbon_get_the_post_meta('product_floor')):
					array_push($array, 'На пол');endif;?>
				<?php if(carbon_get_the_post_meta('product_one')):
					array_push($array, 'Одна лампа');endif;?>
			<?php 
			$current_id = get_the_ID();
			$series_prod = carbon_get_the_post_meta('product_series');
				$args = array(
					// 'posts_per_page' => 8,
					'post_type' => 'post',
					'post__not_in' => array($current_id),
					'meta_key' => '_product_series',
					'meta_value' => $series_prod,
			        // 'meta_query' => array(
			       //    'relation' => 'OR',
		        // 	  array(
				      //     'key' => 'product_ceiling',
				      //     'value' => 'yes',
				      // ),
		        // 	  array(
				      //     'key' => 'product_wall',
				      //     'value' => 'yes',
				      // ),
		        // 	  array(
				      //     'key' => 'product_table',
				      //     'value' => 'yes',
				      // ),
		        // 	  array(
				      //     'key' => 'product_floor',
				      //     'value' => 'yes',
				      // ),
		        // 	  array(
				      //     'key' => 'product_one',
				      //     'value' => 'yes',
				      // ),
			        // ),
				);
				$query = new WP_Query($args);
				if($query->have_posts()):
					while($query->have_posts()):
						$query->the_post();?>
						<a href="<?php echo get_permalink();?>" class="product-loop">
							<div class="product-loop__photo" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
							<div class="product-loop__title"><?php the_title();?></div>
							<div class="product-loop__price"><?php echo carbon_get_the_post_meta('product_price');?> ₽</div>
							<span class="more-link">Подробнее</span>
						</a>
					<?php endwhile;
				endif; wp_reset_postdata();
			?>
		</div>
	</div>
	<footer class="entry-footer">
		<?php //light_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
</div>
<section class="form-section" style="background-image: url(<?php echo get_template_directory_uri();?>/img/fon1.jpg);">
  <?php get_template_part('template-parts/form-section');?>
</section>
<?php get_template_part('template-parts/reviews');?>
