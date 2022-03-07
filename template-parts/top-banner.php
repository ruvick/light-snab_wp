<section class="top-banner" style="background-image: url(<?php echo wp_get_attachment_image_src(carbon_get_the_post_meta('top_banner_img'), 'full')[0];?>);">
	<div class="container">
		<div class="main-slider__item-content">
			<div class="main-slider__item-title"><?php echo carbon_get_the_post_meta('top_banner_title');?></div>
			<div class="main-slider__item-subtitle"><?php echo carbon_get_the_post_meta('top_banner_text');?></div>
          
        </div>
	</div>
</section>