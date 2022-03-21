// Файлы Java Script -----------------------------------------------------------------------------------------------------

// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}


function inBascetCounting() {
  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];
  for (let i = 0; i < cart.length; i++) {
    let element = document.getElementById('bcounter_' + cart[i].sku);
    if (element != null)
      element.innerHTML = "(" + cart[i].count + ")";
  }
}

function number_format() {
  let elements = document.querySelectorAll('.price_formator');
  for (let elem of elements) {
    elem.dataset.realPrice = elem.innerHTML;
    elem.innerHTML = Number(elem.innerHTML).toLocaleString('ru-RU');
  }
}


//--- Корзина -------------------------------------------------------------------------------------------------------------

let cart = [];
let cartCount = 0;

function cart_recalc() {
  cart = JSON.parse(localStorage.getItem("cart"));
  if (cart == null) cart = [];
  cartCount = 0;
  cartSumm = 0;
  for (let i = 0; i < cart.length; i++) {
    cartCount += Number(cart[i].count);

    cartSumm += Number(cart[i].count) * parseFloat(cart[i].price);
  }

  localStorage.setItem("cartcount", cartCount);
  localStorage.setItem("cartsumm", cartSumm);

  let elements = document.querySelectorAll('.bascet_counter');
  for (let elem of elements) {
    elem.innerHTML = cartCount;
  }

}

function add_tocart(elem, countElem) {

  let cartElem = {
    sku: elem.dataset.sku,
    size: elem.dataset.size,
    lnk: elem.dataset.lnk,
    price: elem.dataset.price,
    priceold: elem.dataset.oldprice,
    subtotal: elem.dataset.price,
    name: elem.dataset.name,
    count: (countElem == 0) ? elem.dataset.count : countElem,
    picture: elem.dataset.picture
  };

  if (cart.length == 0) {
    cart.push(cartElem);
  } else {
    let addet = true;
    for (let i = 0; i < cart.length; i++) {
      if ((cart[i].sku == cartElem.sku) && (cart[i].size == cartElem.size)) {
        cart[i].count++;
        cart[i].subtotal = Number(cart[i].count) * parseFloat(cart[i].price);
        addet = false;
        break;
      }
    }

    if (addet)
      cart.push(cartElem);
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  cart_recalc();

  console.log(cartElem);
}


//BildSlider
let sliders = document.querySelectorAll('._swiper');
if (sliders) {
  for (let index = 0; index < sliders.length; index++) {
    let slider = sliders[index];
    if (!slider.classList.contains('swiper-bild')) {
      let slider_items = slider.children;
      if (slider_items) {
        for (let index = 0; index < slider_items.length; index++) {
          let el = slider_items[index];
          el.classList.add('swiper-slide');
        }
      }
      let slider_content = slider.innerHTML;
      let slider_wrapper = document.createElement('div');
      slider_wrapper.classList.add('swiper-wrapper');
      slider_wrapper.innerHTML = slider_content;
      slider.innerHTML = '';
      slider.appendChild(slider_wrapper);
      slider.classList.add('swiper-bild');

      if (slider.classList.contains('_swiper_scroll')) {
        let sliderScroll = document.createElement('div');
        sliderScroll.classList.add('swiper-scrollbar');
        slider.appendChild(sliderScroll);
      }
    }
    if (slider.classList.contains('_gallery')) {
      //slider.data('lightGallery').destroy(true);
    }
  }
  sliders_bild_callback();
}

function sliders_bild_callback(params) { }

// Сюда пишем класс нашего слайдера и меняем переменную
let productSl = new Swiper('.cardProductSl', {
  // effect: 'fade',
  // autoplay: {
  // 	delay: 3000,
  // 	disableOnInteraction: false,
  // },

  observer: true,
  observeParents: true,
  slidesPerView: 1,
  spaceBetween: 0,
  autoHeight: true,
  speed: 2000,
  //touchRatio: 0,
  //simulateTouch: false,
  loop: true,
  //preloadImages: false,
  //lazy: true,
  // Dotts
  pagination: {
    el: '.swiper-paggination',
    clickable: true,
  },
  // Arrows
  navigation: {
    nextEl: '.sl-index-button-next',
    prevEl: '.sl-index-button-prev',
  },
  /*
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
      autoHeight: true,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    992: {
      slidesPerView: 3,
      spaceBetween: 20,
    },
    1268: {
      slidesPerView: 4,
      spaceBetween: 30,
    },
  },
  */
  on: {
    lazyImageReady: function () {
      ibg();
    },
  }
  // And if we need scrollbar
  //scrollbar: {
  //	el: '.swiper-scrollbar',
  //},
});


//QUANTITY
let quantityButtons = document.querySelectorAll('.quantity__button');
if (quantityButtons.length > 0) {
  for (let index = 0; index < quantityButtons.length; index++) {
    const quantityButton = quantityButtons[index];
    quantityButton.addEventListener("click", function (e) {
      let value = parseInt(quantityButton.closest('.quantity').querySelector('input').value);
      if (quantityButton.classList.contains('quantity__button_plus')) {
        value++;
      } else {
        value = value - 1;
        if (value < 1) {
          value = 1
        }
      }
      quantityButton.closest('.quantity').querySelector('input').value = value;
    });
  }
}

// Файлы Java Script End -----------------------------------------------------------------------------------------------------




// jQuery ======================================================================================================

jQuery(document).ready(function ($) {
  $(".main-slider").slick({
    dots: true,
    arrows: false,
  });
  // $(".single-product__photo").slick({
  //   slidesToShow: 1,
  //   prevArrow: '<div class="slider-arrow slider-arrow-prev"></div>',
  //   nextArrow: '<div class="slider-arrow slider-arrow-next"></div>',
  // });
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

  $('.page-brands-wrapper a').click(function (e) {
    e.preventDefault();
    var src = $(this).children('img').attr('src');
    var text = $(this).data('text');

    $("#brand-modal .brand-modal__photo").css('background-image', 'url(' + src + ')');
    $('#brand-modal .brand-modal__content').html(text);
    $('#brand-modal').arcticmodal();
  });

  jQuery(".uniSendBtn").click(function (e) {
    e.preventDefault();
    var formid = jQuery(this).data("formid");
    var message = jQuery(this).data("mailmsg");
    var phone = $(this).parent().find('input[type=tel]').val();
    var name = $(this).parent().find('input[name=name]').val();
    var email = $(this).parent().find('input[name=email]').val();
    var comment = $(this).parent().find('textarea[name=message]').val();

    if ((phone == "") || (phone.indexOf("_") > 0)) {
      $(this).parent().find('input[type=tel]').css("background-color", "#ff91a4")
    } else {
      var jqXHR = jQuery.post(
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

  $(".offers-item__link").click(function (e) {
    e.preventDefault();
    var partner_name = $(this).data('partner');
    var formid = jQuery(this).data("formid");
    var message = jQuery(this).data("mailmsg");
    $("#order-modal .uniSendBtn-2").attr({ 'data-formid': formid, 'data-mailmsg': message });
    $("#order-modal input[name=partner]").val(partner_name);
    $('#order-modal').arcticmodal();
  });
  $(".product-question").click(function (e) {
    e.preventDefault();
    var formid = jQuery(this).data("formid");
    var message = jQuery(this).data("mailmsg");
    $("#question-modal .uniSendBtn").attr({ 'data-formid': formid, 'data-mailmsg': message });
    $('#question-modal').arcticmodal();
  });
  jQuery(".uniSendBtn-2").click(function (e) {
    e.preventDefault();
    var formid = jQuery(this).data("formid");
    var message = jQuery(this).data("mailmsg");
    var phone = $(this).parent().find('input[type=tel]').val();
    var name = $(this).parent().find('input[name=name]').val();
    var partner = $(this).parent().find('input[name=partner]').val();

    if ((phone == "") || (phone.indexOf("_") > 0)) {
      $(this).parent().find('input[type=tel]').css("background-color", "#ff91a4")
    } else {
      var jqXHR = jQuery.post(
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

  var inputmask_96e76a5f = { "mask": "+7(999)999-99-99" };
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

  if ($(window).width() < 1250) {
    $("#menu-menu-1").append('<div class="menu-close"></div>');
  }
  $(".menu-close").click(function () {
    $(this).parent().slideUp();
  });
});
