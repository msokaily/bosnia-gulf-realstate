(function ($) {
  "use-strict";

  /*------------------------------------
		loader page
	--------------------------------------*/
  $(window).on("load", function () {
    $(".loader-page").fadeOut(500);
    wow = new WOW({
      animateClass: "animated",
      offset: 50,
    });
    wow.init();
  });


  
  /*------------------------------------
		Sidebar toggle
	--------------------------------------*/
  $(".toggle-bookings").click(function () {
    $('.overlay-page').toggleClass('active');
    $('.sidebar-bookings').toggleClass('active');
  });

    /*------------------------------------
    Activate input
  --------------------------------------*/
  $("body").on('click', '.toggle-cart', function () {
    $('.overlay-page').toggleClass('active');
    $('.cart').toggleClass('active');
    $('body, .main-header').toggleClass('no-scroll');
  });
  
  // $(".toggle-login").click(function () {
  //   $('.overlay-page').toggleClass('active');
  //   $('.sidebar-login').toggleClass('active');
  // });
  
  $(".toggle-login").click(function () {
    $('body, .main-header').addClass('no-scroll');
    if($('.sidebar-login').hasClass('active')){
      console.log('1')
      $('.overlay-page').removeClass('active');
      $('.sidebar-register').removeClass('active');
      $('.sidebar-login').addClass('active');
    }else{
      console.log('2')
      $('.overlay-page').addClass('active');
      $('.sidebar-register').removeClass('active');
      $('.sidebar-login').addClass('active');
    }
  });

  $(".close-login").click(function () {
    $('.overlay-page').removeClass('active');
    $('.sidebar-register').removeClass('active');
    $('.sidebar-login').removeClass('active');
    $('body, .main-header').removeClass('no-scroll');
  });

  $(".toggle-register").click(function () {
    if($('.sidebar-register').hasClass('active')){
      $('.overlay-page').removeClass('active');
      $('.sidebar-login').removeClass('active');
      $('.sidebar-register').removeClass('active');
    }else{
      console.log('111')
      $('.overlay-page').addClass('active');
      $('.sidebar-login').removeClass('active');
      $('.sidebar-register').addClass('active');
    }
  });

  $(".overlay-page").click(function () {
    $('.overlay-page').removeClass('active');
    $('body, .main-header').removeClass('no-scroll');
    $('.sidebar-login, .sidebar-bookings, .sidebar-register, .cart').removeClass('active');
  });

  

  /*------------------------------------
		Activate input
	--------------------------------------*/
  $(".input-activate .form-control").keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next(".form-control").focus();
    }
  });


  
  /*------------------------------------
		Show Pass And Hide
	--------------------------------------*/
  $(".toggle-pass").click(function () {
    var $input = $(this).closest(".input-icon").find(".form-control");
    if ($input.attr("type") == "password") {
      $input.attr("type", "text");
    } else {
      $input.attr("type", "password");
    }
  });

  /*------------------------------------
		datetimepicker
	--------------------------------------*/

  $(".datetimepicker_1").datetimepicker({
    format: "yyyy/mm/dd",
    todayHighlight: true,
    autoclose: true,
    startView: 2,
    minView: 2,
    forceParse: 0,
    pickerPosition: "bottom-right",
  });

  /*------------------------------------
		datetimeclock
      --------------------------------------*/
  $(".datetimeclock").datetimepicker({
    pickDate: false,
    minuteStep: 5,
    pickerPosition: "bottom-right",
    format: "HH:ii",
    autoclose: true,
    showMeridian: true,
    todayHighlight: true,
    startView: 1,
    maxView: 1,
  });


  /*------------------------------------
   Fancybox
  --------------------------------------*/
  Fancybox.bind("[data-fancybox]", {
   //
  });



  /*------------------------------------
   select2
  --------------------------------------*/
  $('.select2').select2();
  
})(jQuery);

var swiperImages = new Swiper(".swiper-images", {
  slidesPerView: 2,
  speed: 1500,
  spaceBetween: 20,
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-images .swiper-button-next",
    prevEl: ".swiper-images .swiper-button-prev",
  },
});


var swiperTeam = new Swiper(".swiper-team", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 20,
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-team .swiper-next",
    prevEl: ".swiper-action-team .swiper-prev",
  },
});

var swiperGallaryAbout = new Swiper(".swiper-gallary-about", {
  slidesPerView: 2,
  speed: 1500,
  spaceBetween: 20,
  loop: true,
  centeredSlides: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    767: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    992: {
      spaceBetween: 30,
      slidesPerView: 2.3,
    },
  },
});

var swiperproduct = new Swiper(".swiper-product", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 20,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-product .swiper-next",
    prevEl: ".swiper-action-product .swiper-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    767: {
      slidesPerView: 2,
      spaceBetween: 30,
    },
    992: {
      spaceBetween: 30,
      slidesPerView: 3,
    },
  },
});

var swiperImages2 = new Swiper(".swiper-images-2", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 20,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-product .swiper-next",
    prevEl: ".swiper-action-product .swiper-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 1.5,
      spaceBetween: 20,
    },
    767: {
      slidesPerView: 2.5,
      spaceBetween: 30,
    },
    992: {
      spaceBetween: 40,
      slidesPerView: 3.5,
    },
  },
});

var swiperBrand = new Swiper(".swiper-brand", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 20,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-product .swiper-next",
    prevEl: ".swiper-action-product .swiper-prev",
  },
  breakpoints: {
    0: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    767: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
    992: {
      spaceBetween: 40,
      slidesPerView: 4,
    },
  },
});

var swiperAbout = new Swiper(".swiper-about", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 0,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-about .swiper-next",
    prevEl: ".swiper-action-about .swiper-prev",
  },
});
var swiperEventSingle= new Swiper(".swiper-event-signle", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 0,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-action-event-signle .swiper-next",
    prevEl: ".swiper-action-event-signle .swiper-prev",
  },
});

var swiperSingleRoom = new Swiper(".swiper-single-room", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 0,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".section-single-room .swiper-next",
    prevEl: ".section-single-room .swiper-prev",
  },
});
