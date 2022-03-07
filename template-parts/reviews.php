
    <section class="reviews">
      <div class="container">
        <h2 class="section-title">Отзывы покупателей</h2>
        <?php 
          $arr_reviews = carbon_get_theme_option('review_complex');
          if($arr_reviews):
        ?>
        <div class="reviews-slider">
          <?php foreach($arr_reviews as $review):?>
          <div class="reviews-item">
            <div class="reviews-item__photo" style="background-image: url(<?php echo wp_get_attachment_image_src($review['review_photo'], 'full')[0]?>)"></div>
            <div class="reviews-item__name"><?php echo $review['review_name']?></div>
            <div class="reviews-item__title"><?php echo $review['review_title']?></div>
            <div class="reviews-item__text">
              <?php echo $review['review_text']?>
            </div>
          </div>
          <?php endforeach;?>
        </div>
      <?php endif;?>
      </div>
    </section>