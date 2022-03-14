<?php
if(!defined('ABSPATH')) {
    exit();
}
use Carbon_Fields\Container;
use Carbon_Fields\Field;
Container::make( 'theme_options', 'as_theme_options', 'Настройки темы' )
    ->add_tab('Главная', array(
      Field::make( 'image', 'as_logo', 'Логотип')
        ->set_width(30),
      Field::make( 'image', 'as_logo_white', 'Логотип белый')
        ->set_width(30),
    ))
    ->add_tab('Отзывы', array(
      Field::make('complex', 'review_complex', 'Отзывы')
        ->add_fields(array(
          Field::make('image', 'review_photo', 'Фото')
            ->set_width(30),
          Field::make('text', 'review_name', 'Имя/ник')
            ->set_width(30),
          Field::make('text', 'review_title', 'Название')
            ->set_width(30),
          Field::make('textarea', 'review_text', 'Текст')
            ->set_width(30),
        )),
    ))
    ->add_tab('Баннер', array(
      Field::make('text', 'banner_title_1', 'Заголовок')
        ->set_width(30),
      Field::make('text', 'banner_subtitle_1', 'Подзаголовок')
        ->set_width(30),
      Field::make('image', 'banner_image_1', 'Фото')
        ->set_width(30),
      Field::make('text', 'banner_title_2', 'Заголовок')
        ->set_width(30),
      Field::make('text', 'banner_subtitle_2', 'Подзаголовок')
        ->set_width(30),
      Field::make('image', 'banner_image_2', 'Фото')
        ->set_width(30),
      Field::make('text', 'banner_title_3', 'Заголовок')
        ->set_width(30),
      Field::make('text', 'banner_subtitle_3', 'Подзаголовок')
        ->set_width(30),
      Field::make('image', 'banner_image_3', 'Фото')
        ->set_width(30),
    ))
    ->add_tab('Сертификаты', array(
      Field::make('complex', 'complex_cert', 'Сетрификаты')
        ->add_fields(array(
          Field::make('image', 'complex_cert_img', 'Сертификат')
        )),
    ))
    ->add_tab('Торговые марки', array(
      Field::make('complex', 'as_complex_brand', 'Торговые марки')
        ->add_fields(array(
          Field::make('text', 'as_complex_brand__title', 'Название')
            ->set_width(30),
          Field::make('image', 'as_complex_brand_img', 'Логотип')
            ->set_width(30),
          Field::make('textarea', 'as_complex_brand_descr', 'Краткое описание')
            ->set_width(30),
        ))
    ))
    ->add_tab('О нас' , array(
      Field::make('text', 'as_about_title', 'Заголовок')
        ->set_width(50),
      Field::make('text', 'as_about_subtitle', 'Подзаголовок')
        ->set_width(50),
      Field::make('rich_text', 'as_about_text', 'Текст'),
    ))
    ->add_tab('Контакты', array(
        Field::make( 'text', 'as_phone', __( 'Телефон' ) )
          ->set_width(50),
		Field::make( 'text', 'as_phone2', __( 'Телефон 2' ) )
          ->set_width(50),
        Field::make( 'text', 'as_email', __( 'Email' ) )
          ->set_width(50),
        Field::make( 'text', 'as_email_offer', __( 'Email опт' ) )
          ->set_width(50),
        Field::make( 'text', 'as_email_send', __( 'Email для отправки' ) )
          ->set_width(50),
        Field::make( 'text', 'as_inn', __( 'ИНН' ) )
          ->set_width(50),
        Field::make( 'text', 'as_orgn', __( 'ОРГН' ) )
          ->set_width(50),
        Field::make( 'text', 'as_address', __( 'Адрес' ) )
          ->set_width(50),
        Field::make( 'text', 'as_facebook', __( 'Facebook' ) )
          ->set_width(50),
        Field::make( 'text', 'as_insta', __( 'Instagram' ) )
          ->set_width(50),
        Field::make( 'text', 'as_vk', __( 'Вконтакте' ) )
          ->set_width(50),
        Field::make( 'text', 'mkad_map_point', __( 'Координаты карты' ) )
          ->set_width(50),
    ) );
Container::make('post_meta', 'top_banner', 'Баннер на странице')
  ->show_on_post_type(array('light'))
  ->show_on_post_type(array('page'))
  ->add_fields(array(
    Field::make('image', 'top_banner_img', 'Фото')
      ->set_width(30),
    Field::make('text', 'top_banner_title', 'Заголовок')
      ->set_width(30),
    Field::make('text', 'top_banner_text', 'Текст')
      ->set_width(30),
  ));
Container::make('post_meta', 'product', 'Дополнительные поля')
  ->add_fields(array(
    Field::make('textarea', 'offer_smile_descr', 'Краткое описание')->set_width(100),
		Field::make('text', 'offer_name', 'Название товара')->set_width(30),
		Field::make('text', 'offer_label', 'Метка на товаре')->set_width(30),
		Field::make('text', 'offer_allsearch', 'Все артикулы для поиска')->set_width(100),
		Field::make('text', 'offer_siries', 'Серия (для сопутствующих)')->set_width(30),
		

		Field::make('text', 'offer_sku', 'Артикул (Базовый)')->set_width(50),
		Field::make('text', 'offer_nal', 'Наличие на складе')->set_default_value('Есть на складе')->set_width(50),

		Field::make('complex', 'offer_cherecter', "Характеристики товара")
			->add_fields(array(
				Field::make('text', 'c_name', 'Наименование параметра')->set_width(50),
				Field::make('text', 'c_val',  'Значение')->set_width(50),
			)),

		Field::make('text', 'offer_price', 'Цена (Базовая)')->set_width(50),
		Field::make('text', 'offer_old_price', 'Старая цена (Базовая)')->set_width(50),

		Field::make('complex', 'offer_modification', "Модификация товара")
			->add_fields(array(
				Field::make('text', 'mod_name', 'Наименование модификации')->set_width(20),
				Field::make('text', 'mod_sku', 'Артикул модификации')->set_width(20),
				Field::make('text', 'mod_price', 'Цена модификации')->set_width(20),
				Field::make('text', 'mod_old_price', 'Старая цена модификации')->set_width(20),
				Field::make('text', 'mod_picture_id', 'Изображения модификации')->set_width(20),
			)),

		Field::make('complex', 'offer_picture', "Галерея товара")
			->add_fields(array(
				Field::make('image', 'gal_img', 'Изображение')->set_width(30),
				Field::make('text', 'gal_img_sku', 'ID для модификации')->set_width(30),
				Field::make('text', 'gal_img_alt', 'alt и title')->set_width(30)
			)),

		Field::make('rich_text', 'offer_fulltext', 'Полное описание (SEO)')->set_width(50),
  ));
Container::make('post_meta', 'as_info', 'Дополнительные поля')
  ->where('post_id', '=', '7')
  ->add_fields(array(
    Field::make('complex', 'complex_info', 'Блок информации')
      ->add_fields(array(
        Field::make('text', 'complex_info_title', 'Заголовок')
          ->set_width(50),
        Field::make('rich_text', 'complex_info_text', 'Текст')
          ->set_width(50),
      ))
  ));