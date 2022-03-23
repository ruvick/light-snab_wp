<a href="<?php echo get_permalink();?>" class="product-loop">
	<div class="product-loop__photo" style="background-image: url(<?php the_post_thumbnail_url();?>);"></div>
	<div class="product-loop__title"><?php the_title();?></div>
	<div class="product-loop__price"><?php echo carbon_get_the_post_meta('offer_price');?> ₽</div>
	<span class="more-link">Подробнее</span>
</a>