jQuery(document).ready(function ($) {
  $(".main-slider").slick({
    dots: true,
    arrows: false,
  });
  $(".single-product__photo").slick({
    slidesToShow: 1,
    prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
    nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
  });
  $(".reviews-slider").slick({
    slidesToShow: 3,
    prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
    nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
    responsive: [
      {
        breakpoint: 1200,
        settings: {
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
        }
      },
    ]
  });
  $(".cert-slider").slick({
    slidesToShow: 5,
    prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
    nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
    responsive: [
      {
        breakpoint: 1104,
        settings: {
          slidesToShow: 3,
        }
    },
      {
        breakpoint: 760,
        settings: {
          slidesToShow: 2,
        }
    },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
    }
  ]
  });
  lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true,
    'albumLabel': ''
  });

  $('.page-brands-wrapper a').click(function(e) {
    e.preventDefault();
    var src = $(this).children('img').attr('src');
    var text = $(this).data('text');

    $("#brand-modal .brand-modal__photo").css('background-image', 'url(' + src + ')');
    $('#brand-modal .brand-modal__content').html(text);
    $('#brand-modal').arcticmodal();
  });

  jQuery(".uniSendBtn").click(function(e){ 
      e.preventDefault();
      var formid = jQuery(this).data("formid");
      var message = jQuery(this).data("mailmsg");
      var phone = $(this).parent().find('input[type=tel]').val();
      var name = $(this).parent().find('input[name=name]').val();
      var email = $(this).parent().find('input[name=email]').val();
      var comment = $(this).parent().find('textarea[name=message]').val();
      
      if ((phone == "")||(phone.indexOf("_")>0)) {
        $(this).parent().find('input[type=tel]').css("background-color","#ff91a4")
      } else {
        var  jqXHR = jQuery.post(
          allAjax.ajaxurl,
          {
            action: 'universal_send',    
            nonce: allAjax.nonce,
            msg: message,
            name: name,
            tel: phone,
            email: email,
            comment: comment
          }
          
        );
        
        
        jqXHR.done(function (responce) {
          
          jQuery('#messgeModal #lineMsg').html("Ваша заявка принята. Мы свяжемся с Вами в ближайшее время.");
          jQuery('#messgeModal').arcticmodal();
          
        });
        
        jqXHR.fail(function (responce) {
          jQuery('#messgeModal #lineIcon').html('');
          jQuery('#messgeModal #lineMsg').html("Произошла ошибка! Попробуйте позднее.");
          jQuery('#messgeModal').arcticmodal();
        });
      }
    });

  $(".offers-item__link").click(function(e) {
    e.preventDefault();
    var partner_name = $(this).data('partner');
    var formid = jQuery(this).data("formid");
    var message = jQuery(this).data("mailmsg");
    $("#order-modal .uniSendBtn-2").attr({'data-formid': formid, 'data-mailmsg': message});
    $("#order-modal input[name=partner]").val(partner_name);
    $('#order-modal').arcticmodal();
  });
  $(".product-question").click(function(e) {
      e.preventDefault();
      var formid = jQuery(this).data("formid");
      var message = jQuery(this).data("mailmsg");
      $("#question-modal .uniSendBtn").attr({'data-formid': formid, 'data-mailmsg': message});
      $('#question-modal').arcticmodal();
  });
    jQuery(".uniSendBtn-2").click(function(e){ 
      e.preventDefault();
      var formid = jQuery(this).data("formid");
      var message = jQuery(this).data("mailmsg");
      var phone = $(this).parent().find('input[type=tel]').val();
      var name = $(this).parent().find('input[name=name]').val();
      var partner = $(this).parent().find('input[name=partner]').val();
      
      if ((phone == "")||(phone.indexOf("_")>0)) {
        $(this).parent().find('input[type=tel]').css("background-color","#ff91a4")
      } else {
        var  jqXHR = jQuery.post(
          allAjax.ajaxurl,
          {
            action: 'universal_send_2',    
            nonce: allAjax.nonce,
            msg: message,
            name: name,
            tel: phone,
            partner: partner
          }
          
        );
        
        
        jqXHR.done(function (responce) {
          
          jQuery('#messgeModal #lineMsg').html("Ваша заявка принята. Мы свяжемся с Вами в ближайшее время.");
          jQuery('#messgeModal').arcticmodal();
          $('#order-modal').arcticmodal('close');
        });
        
        jqXHR.fail(function (responce) {
          jQuery('#messgeModal #lineIcon').html('');
          jQuery('#messgeModal #lineMsg').html("Произошла ошибка! Попробуйте позднее.");
          jQuery('#messgeModal').arcticmodal();
        });
      }
    });

  var inputmask_96e76a5f = {"mask":"+7(999)999-99-99"};
  jQuery("input[type=tel]").inputmask(inputmask_96e76a5f);

  function top_btn() {
    var button = $('.top-button');
    var height_page = $(document).outerHeight(true);
    var delay = 1000;
    $(window).scroll(function () {
      if ($(this).scrollTop() > 600) {
        button.fadeIn();
      } else {
        button.fadeOut();
      }
    });
    button.click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    });
  }
  top_btn();

  $('.hamburger').click(function () {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $(this).next().slideUp();
    } else {
      // $(this).addClass('active');
      $(this).next().slideDown();
    }
  });

  if($(window).width() < 1250) {
    $("#menu-menu-1").append('<div class="menu-close"></div>');
  }
  $(".menu-close").click(function() {
    $(this).parent().slideUp();
  });
});
