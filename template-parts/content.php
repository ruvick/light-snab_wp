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
			<div class="cardProductSl _swiper">
			<?
				$pict = carbon_get_the_post_meta('offer_picture');
					if($pict) {
				$pictIndex = 0;
					foreach($pict as $item) {
			?>
				<div class="single-slider__item slider__slide">
					<img
						id = "pict-<? echo empty($item['gal_img_sku'])?$pictIndex:$item['gal_img_sku']; ?>" 
						alt = "<? echo $item['gal_img_alt']; ?>"
						title = "<? echo $item['gal_img_alt']; ?>"
						src = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'full')[0];?>" /> 								
				</div>
			<?
				$pictIndex++; 
					}
				}
			?>
			</div>
			<!-- Кнопки-точки -->
			<div class="product-sl-paggination swiper-paggination"></div>
		</div>

		<div class="single-product__content">
			<h1 class="single-product__title"><?php the_title();?></h1>
			<div class="single-product__price-block">
				<div class="single-product__price single-product__item"> <span class = "parsPrice"><?php echo carbon_get_the_post_meta('offer_price');?></span> ₽</div>
				<div class="product__quantity quantity">
					<div class="quantity__button quantity__button_minus"></div>
					<div class="quantity__input">
						<input id="pageNumeric" autocomplete="off" type="number" name="form[]" value="1"> 
					</div>
					<div class="quantity__button quantity__button_plus"></div>
				</div>
				<button class="single-product__price-btn more-link" id = "btn__to-card" onclick = "add_tocart(this, document.getElementById('pageNumeric').value); return false;"
					data-price = "<?echo carbon_get_post_meta(get_the_ID(),"offer_price"); ?>"
  				data-sku = "<? echo carbon_get_post_meta(get_the_ID(),"offer_sku")?>"
  				data-size = ""
  				data-oldprice = "<? echo carbon_get_post_meta(get_the_ID(),"offer_old_price")?>"
  				data-lnk = "<? echo  get_the_permalink(get_the_ID());?>"
  				data-name = "<? echo  get_the_title();?>"
  				data-count = "1"
  				data-picture = "<?php echo wp_get_attachment_image_src($item['gal_img'], 'large')[0];?>"
  				data-picture = "<?php  $imgTm = get_the_post_thumbnail_url( get_the_ID(), "tominiatyre" ); echo empty($imgTm)?get_bloginfo("template_url")."/img/no-photo.jpg":$imgTm; ?>">Купить</button> 
			</div>

			<div class="single-product__char-wrap single-product__item">
				<div class="single-product__char">
					<div class=""><span class="single-product__char-name">Артикул: </span> <span class = "parsSku"><?php echo carbon_get_the_post_meta('offer_sku');?></span></div>
					<!-- <div class=""><span class="single-product__char-name">Серия: </span> <span class = "parsSiries"><?php echo carbon_get_the_post_meta('offer_siries');?></span></div>
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
				</div> -->
				<div class="single-product__descp">
				<?
				$cherecter = carbon_get_the_post_meta('offer_cherecter');
					if($cherecter) {
				$cherecterIndex = 0;
					foreach($cherecter as $item) {
			?>
				<p class="single-product__descp-name"><? echo $item['c_name']; ?>: <span class="single-product__descp-value"><? echo $item['c_val']; ?></span></p>
			<?
				$cherecterIndex++; 
					}
				}
			?>
				</div>
			</div>
			</div>

			<!-- <div class="single-product__descr1 single-product__item">
				<?php echo carbon_get_the_post_meta('product_descr');?>
			</div>
			<a href="#" class="more-link product-question" data-mailmsg="Задать вопрос о товаре <?php the_title();?>">Хочу купить</a> -->

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
					'posts_per_page' => 4,
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
							<div class="product-loop__price"><?php echo carbon_get_the_post_meta('offer_price');?> ₽</div>
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
