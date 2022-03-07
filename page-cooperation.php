<?php

/*
* Template Name: Приглашаем к сотрудничеству
*/

get_header();

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php echo get_template_part('template-parts/top', 'banner')?>
			<div class="container">
				<h1 class="page-h1"><span><?php the_title();?></span></h1>
				<h2 class="page-subtitle">Вы дизайнер, архитектор, проектировщик?</h2>
				<div class="cooperation-content">
					<div class="cooperation-content__text">
						<ol>
							<li>Поможем подобрать подходящие светильники под Ваш проект
								<ul>
									<li>по визуализации и дизайн проекту</li>
									<li>исходя из пожеланий клиента</li>
								</ul>
							</li>
							<li>
								Проведем полный  комплекс услуг по расчету освещенности
								<ul>
									<li>расчет освещенности каждого помещения </li>
									<li>рекомендации по видам и типу освещения</li>
								</ul>
							</li>
							<li>
								Предоставим лучшие цены
								<ul>
									<li>гибкая  система скидок</li>
									<li>стабильная система агентских выплат</li>
								</ul>
							</li>
							<li>
								Предлагаем более 300 световых брендов Европы и Азии
								<ul>
									<li>топовые световые фабрики</li>
									<li>недорогие аналоги европейских светильников</li>
								</ul>
							</li>
						</ol>
					</div>
					<form action="" class="cooperation-content__form">
						<div class="cooperation-content__form-title">Заполните форму</div>
						<input type="text" placeholder="Имя*" name="name">
						<input type="tel" placeholder="Телефон*" name="tel">
						<input type="email" placeholder="E-mail*" name="email">
						<a href="#" class="uniSendBtn">Отправить</a>
						<div class="cooperation-content__form-note">
							* Нажимая на кнопку "Отправить" Вы принимаете условия политики конфиденциальности в отношении обработки персональных данных
						</div>
					</form>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
