<?php

/*
* Template Name: Контакты
*/
get_header();
?>


<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="container">
			<h1 class="section-title"><?php the_title();?></h1>
			<p>
				<strong>Телефон:</strong> <span><a href="tel:<?php echo str_replace(array('(', ')', '-', ' '), '', carbon_get_theme_option('as_phone'))?>"><?php echo carbon_get_theme_option('as_phone');?></a></span>
			</p>
			<p>
				<strong>Email:</strong> <span><a href="mailto:<?php echo carbon_get_theme_option('as_email');?>"><?php echo carbon_get_theme_option('as_email');?></a></span>
			</p>
			<p>
				<strong>Email оптового отдела:</strong> <span><?php echo carbon_get_theme_option('as_email_offer');?></span>
			</p>
			<p>
				<strong>Адрес:</strong> <span><?php echo carbon_get_theme_option('as_address');?></span>
			</p>
			<?php the_content();?>
			<div id = "mapLine" class = "mapLine"></div>
			 <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
				<script>
								  ymaps.ready(init);
								  function init () {
									
									  var myMap = new ymaps.Map("mapLine", {
											  center: <?php echo carbon_get_theme_option('mkad_map_point') ?>,
											  zoom: 14,
											  controls: ['zoomControl']
										  }),
										myPlacemarkAdr = new ymaps.Placemark(<?php echo carbon_get_theme_option('mkad_map_point') ?>, {
											  iconContent: '',
											  balloonContent: 'Наш адрес: <b><?php echo carbon_get_theme_option('as_address') ?></b><br/>Телефон: <b> <?php echo carbon_get_theme_option('as_phone') ?>',
											  hintContent: 'Наш адрес: <b><?php echo carbon_get_theme_option('as_address') ?></b><br/>Телефон: <b> <?php echo carbon_get_theme_option('as_phone') ?>',
										  }, {
											iconLayout: 'default#image',
											iconImageHref: '<?php bloginfo("template_url"); ?>/img/map.svg',
											iconImageSize: [30, 54],
											iconImageOffset: [-15, -54]
										  });
										  
										  myMap.geoObjects.add(myPlacemarkAdr);
										  
										
										
										
									myMap.behaviors.disable('scrollZoom');
								  }
					</script>
		</div>
	</main>
</div>
<?php
get_footer();