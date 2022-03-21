<?php
/**
* A Simple Category Template
*/
 
get_header(); ?> 
<div class="main-slider main-slider__cat">
	<div class="main-slider__item" style="background-image: url(<?php echo get_template_directory_uri()?>/img/LIGHT_ban_vnut.jpg)">
        <div class="container">
          <div class="main-slider__item-content">
            <div class="main-slider__item-title">Более 3000 моделей</div>
            <div class="main-slider__item-subtitle">Для различных интерьеров</div>
          </div>
        </div>
      </div>
</div>
<?php $cat_current_ID = get_query_var('cat');
	$args = array(
		'parent' => 3,
		'hide_empty' => 0,
	);
	$categories = get_categories($args);
?>
<section class="categories-wrapper">
	<div class="container">
		<?php 
		$active = '';
		foreach($categories as $cat):
			if($cat_current_ID == $cat->term_id) $active = 'active';?>
			<a href="<?php echo get_category_link( $cat->term_id )?>" class="categories-item <?php echo $active?> categories-item-<?php echo $cat->term_id?>"><?php echo $cat->name;?></a>
		<?php $active = ''; endforeach;?>
	</div>
</section>
<section class="search-section">
	<div class="container">
		<?php get_template_part('template-parts/search-form');?>
	</div>
</section>
<section id="primary" class="site-content">
<div id="content" role="main">
 <div class="container">
<?php 
// Check if there are any posts to display
if ( have_posts() ) : ?>
 
<header class="archive-header">
<!-- <h1 class="archive-title"><?php single_cat_title( '', true ); ?></h1> -->
 
 
<?php
// Display optional category description
 if ( category_description() ) : ?>
<div class="archive-meta"><?php echo category_description(); ?></div>
<?php endif; ?>
</header>
<div class="products-wrapper">
	<?php
	 
	// The Loop
	while ( have_posts() ) : the_post(); ?>

		<a href="<?php echo get_permalink();?>" class="product-loop">
			<div class="product-loop__photo" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
			<div class="product-loop__title"><?php the_title();?></div>
			<div class="product-loop__price"><?php echo carbon_get_the_post_meta('offer_price');?> ₽</div>
			<span class="more-link">Подробнее</span>
		</a>
	 
	<?php endwhile; ?>
	</div>	
	<?php the_posts_pagination();?> 
	<?php else: ?>
	<p>Нет товаров</p>
	 
	 
	<?php endif; ?>
		</div>
	</div>
</section>
 
<section class="form-section" style="background-image: url(<?php echo get_template_directory_uri();?>/img/fon1.jpg);">
  <?php get_template_part('template-parts/form-section');?>
</section>
<?php get_template_part('template-parts/reviews');?>

<?php get_footer(); ?>