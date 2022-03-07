<?php
/**
 *
 * Template Name: О нас
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package light
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php echo get_template_part('template-parts/top', 'banner')?>
			<?php 
				$arr_info = carbon_get_the_post_meta('complex_info');
				if($arr_info):
			?>
			<div class="container">
				<?php foreach($arr_info as $info):?>
				<div class="about-block">
					<div class="about-block__title"><?php echo $info['complex_info_title']?></div>
					<div class="about-block__text">
						<?php echo $info['complex_info_text']?>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		    <section class="form-section" style="background-image: url(<?php echo get_template_directory_uri();?>/img/LIGHT_ban_1.jpg);">
		      
			      <?php get_template_part('template-parts/form-section');?>
		    </section>
		    <?php get_template_part('template-parts/reviews');?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
