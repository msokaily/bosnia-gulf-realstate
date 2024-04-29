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


  $('.main-header .navbar .navbar-collapse .nav-item').click(function () {
    $(this).find('.nav-dropdown').fadeToggle()
  })



  /*------------------------------------
    Activate input
  --------------------------------------*/
  $("body").on('click', '.toggle-cart,.overlay-page', function () {
    $('.overlay-page').toggleClass('active');
    $('.cart').toggleClass('active');
    $('body, .main-header').toggleClass('no-scroll');
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

  var checkPastTime = function (inputDateTime) {
    if (typeof (inputDateTime) != "undefined" && inputDateTime !== null) {
      var current = new Date();

      //check past year and month
      if (inputDateTime.getFullYear() < current.getFullYear()) {
        $('#datetimepicker7').datetimepicker('reset');
        alert("Sorry! Past date time not allow.");
      } else if ((inputDateTime.getFullYear() == current.getFullYear()) && (inputDateTime.getMonth() < current.getMonth())) {
        $('#datetimepicker7').datetimepicker('reset');
        alert("Sorry! Past date time not allow.");
      }

      // 'this' is jquery object datetimepicker
      // check input date equal to todate date
      if (inputDateTime.getDate() == current.getDate()) {
        if (inputDateTime.getHours() < current.getHours()) {
          $('#datetimepicker7').datetimepicker('reset');
        }
        this.setOptions({
          minTime: current.getHours() + ':00' //here pass current time hour
        });
      } else {
        this.setOptions({
          minTime: false
        });
      }
    }
  };

  $(".datetimepicker_2").datetimepicker({
    format: "yyyy/mm/dd",
    todayHighlight: true,
    autoclose: true,
    startView: 2,
    minView: 2,
    forceParse: 0,
    pickerPosition: "bottom-right",
    minDate: 0,
    onChangeDateTime:checkPastTime,
  });

  /*------------------------------------
    datetimeclock
      --------------------------------------*/
  $(".datetimeclock").datetimepicker({
    pickDate: false,
    minuteStep: 5,
    pickerPosition: "top-right",
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


var swiperproduct = new Swiper(".swiper-services", {
  slidesPerView: 4,
  speed: 1500,
  spaceBetween: 20,
  loop: true,
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
      slidesPerView: 3,
      spaceBetween: 30,
    },
    992: {
      spaceBetween: 40,
      slidesPerView: 4,
    },
  },
});

var swiperproduct = new Swiper(".swiper-product", {
  slidesPerView: 1,
  speed: 1500,
  spaceBetween: 20,
  loop: true,
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
      spaceBetween: 40,
      slidesPerView: 2,
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
