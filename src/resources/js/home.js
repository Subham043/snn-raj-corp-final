// import './bootstrap';
/* ------------------------------------------

[ Custom settings ]

01. ScrollIt
02. Progress bar
03. Preloader
04. Logo & Menu scroll sticky
05. Menu Navigation
06. Sub Menu
07. Sections background image
08. YouTubePopUp
09. Isotope Active
10. Animations
11. Accordion Box (for Faqs)
12. MagnificPopup
13. Hero owlCarousel
14. Slider owlCarousel
15. Project owlCarousel
16. Project Page owlCarousel
17. Services owlCarousel
18. Blog Grid owlCarousel
19. Team owlCarousel
20. Testimonials owlCarousel
21. Contact Form
22. Scroll back to top

------------------------------------------ */

(function () {
    "use strict";

    var wind = $(window);
    // scrollIt
    $.scrollIt({
      upKey: 38,                // key code to navigate to the next section
      downKey: 40,              // key code to navigate to the previous section
      easing: 'swing',          // the easing function for animation
      scrollTime: 600,          // how long (in ms) the animation takes
      activeClass: 'active',    // class given to the active nav element
      onPageChange: null,       // function(pageIndex) that is called when page is changed
      topOffset: -70            // offste (in px) for fixed top navigation
    });

    // Progress bar
    wind.on('scroll', function () {
        $(".skill-progress .progres").each(function () {
            var bottom_of_object =
            $(this).offset().top + $(this).outerHeight();
            var bottom_of_window =
            $(window).scrollTop() + $(window).height();
            var myVal = $(this).attr('data-value');
            if(bottom_of_window > bottom_of_object) {
                $(this).css({
                  width : myVal
                });
            }
        });
    });
    // var c4 = $('.circle');
    // var myVal = $(this).attr('data-value');
    // $(".sk-progress .circle").each(function () {
    //     c4.circleProgress({
    //         startAngle: -Math.PI / 4 * 2,
    //         value: myVal,
    //         fill: {
    //           gradient: ["#7fa1c6", "#7fa1c6"]
    //         }
    //     });

    // });

    // var DURU = {
    //     init: function () {
    //         this.cacheDom();
    //         this.bindEvents();
    //         this.enableGridGallery();
    //         this.enablePopupGallery();
    //     }
    //     , cacheDom: function () {
    //         this._body = $('body');
    //         this.archsanGalleryTabs = $('.archsan-toolbar-item');
    //         this.archsanGalleryItem = $('.archsan-gallery-item');
    //     }
    //     , bindEvents: function () {
    //         var self = this;
    //         this.archsanGalleryTabs.on('click', self.changeActiveTab);
    //         this.archsanGalleryTabs.on('click', self.addGalleryFilter);
    //     }
    //     , /* ======= popup gallery ======= */
    //     enablePopupGallery: function () {
    //         $('.archsan-popup-gallery').each(function () {
    //             $(this).magnificPopup({
    //                 delegate: 'a'
    //                 , type: 'image'
    //                 , gallery: {
    //                     enabled: true
    //                 }
    //             });
    //         });
    //     }
    //     , /* ======= gallery tab ======= */
    //     changeActiveTab: function () {
    //         $(this).closest('.archsan-gallery-toolbar').find('.active').removeClass('active');
    //         $(this).addClass('active');
    //     }
    //     , /* ======= gallery filter ======= */
    //     addGalleryFilter: function () {
    //         var value = $(this).attr('data-filter');
    //         if (value === 'all') {
    //             DURU.archsanGalleryItem.show('3000');
    //         }
    //         else {
    //             DURU.archsanGalleryItem.not('.' + value).hide('3000');
    //             DURU.archsanGalleryItem.filter('.' + value).show('3000');
    //         }
    //     }
    //     , /* ======= grid gallery ======= */
    //     enableGridGallery: function () {
    //         $('.archsan-grid-gallery').each(function (i, el) {
    //             var item = $(el).find('.archsan-grid-item');
    //             $(el).masonry({
    //                 itemSelector: '.archsan-grid-item'
    //                 , columnWidth: '.archsan-grid-item'
    //                 , horizontalOrder: true
    //             });
    //         });
    //     }
    //  };

    // Preloader
	$("#preloader").fadeOut(700);
	$(".preloader-bg").delay(600).fadeOut(700);
	var wind = $(window);

    // Logo & Menu scroll sticky
    $(window).scroll(function () {
        var $this = $(this)
            , st = $this.scrollTop()
            , navbar = $('.duru-header')
            , logo = $(".duru-header .duru-logo> img");
        if (st > 150) {
            if (!navbar.hasClass('scrolled')) {
                navbar.addClass('scrolled');
                logo.attr('src', logo.attr("data-img"));
            }
        }
        if (st < 150) {
            if (navbar.hasClass('scrolled')) {
                navbar.removeClass('scrolled sleep')
                logo.attr('src', logo.attr("data-img"));
            }
        }
        if (st > 350) {
            if (!navbar.hasClass('awake')) {
                navbar.addClass('awake');
            }
        }
        if (st < 350) {
            if (navbar.hasClass('awake')) {
                navbar.removeClass('awake');
                // navbar.addClass('sleep');
            }
        }
    });

    // Menu Navigation
    $('.duru-js-duru-nav-toggle').on('click', function (e) {
        var $this = $(this);
        e.preventDefault();
        if ($('body').hasClass('menu-open')) {
            $this.removeClass('active');
            $('.duru-wrap .duru-wrap-inner > ul > li').each(function (i) {
                var that = $(this);
                setTimeout(function () {
                    that.removeClass('open');
                }, i * 100);
            });
            setTimeout(function () {
                $('.duru-wrap').removeClass('duru-wrap-show');
            }, 300);
            $('body').removeClass('menu-open');
        }
        else {
            $('.duru-wrap').addClass('duru-wrap-show');
            $this.addClass('active');
            $('body').addClass('menu-open');
            setTimeout(function () {
                $('.duru-wrap .duru-wrap-inner > ul > li').each(function (i) {
                    var that = $(this);
                    setTimeout(function () {
                        that.addClass('open');
                    }, i * 100);
                });
            }, 200);
        }
    });

    // Sub Menu
    $('.duru-menu li.duru-menu-sub>a').on('click', function () {
        $(this).removeAttr('href');
        var element = $(this).parent('li');
        if (element.hasClass('open')) {
            element.removeClass('open');
            element.find('li').removeClass('open');
            element.find('ul').slideUp();
        }
        else {
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
        }
    });
    $('.duru-menu>ul>li.duru-menu-sub>a').append('<span class="holder"></span>');

    // Sections background image from data background
    var pageSection = $(".bg-img, section");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
        }
    });

    // YouTubePopUp
    // $("a.vid").YouTubePopUp();

    // Isotope Active
    $('.projects2-items').imagesLoaded(function () {
    // Add isotope on click function
        $('.projects2-filter li').on('click', function () {
            $(".projects2-filter li").removeClass("active");
            $(this).addClass("active");
            var selector = $(this).attr('data-filter');
            $(".projects2-items").isotope({
                filter: selector
                , animationOptions: {
                    duration: 750
                    , easing: 'linear'
                    , queue: false
                , }
            });
            return false;
        });
        $(".projects2-items").isotope({
            itemSelector: '.single-item',
            filter: '.ongoing',
            layoutMode: 'masonry',
        });
    });

    // Animations
    // var contentWayPoint = function () {
    //     var i = 0;
    //     $('.animate-box').waypoint(function (direction) {
    //         if (direction === 'down' && !$(this.element).hasClass('animated')) {
    //             i++;
    //             $(this.element).addClass('item-animate');
    //             setTimeout(function () {
    //                 $('body .animate-box.item-animate').each(function (k) {
    //                     var el = $(this);
    //                     setTimeout(function () {
    //                         var effect = el.data('animate-effect');
    //                         if (effect === 'fadeIn') {
    //                             el.addClass('fadeIn animated');
    //                         }
    //                         else if (effect === 'fadeInLeft') {
    //                             el.addClass('fadeInLeft animated');
    //                         }
    //                         else if (effect === 'fadeInRight') {
    //                             el.addClass('fadeInRight animated');
    //                         }
    //                         else {
    //                             el.addClass('fadeInUp animated');
    //                         }
    //                         el.removeClass('item-animate');
    //                     }, k * 200, 'easeInOutExpo');
    //                 });
    //             }, 100);
    //         }
    //     }, {
    //         offset: '85%'
    //     });
    // };
    // $(function () {
    //     contentWayPoint();
    // });

    if ($(".vdo-play-btn").length) {
        $(".vdo-play-btn").on("click", function () {
            $(this).parent().addClass("d-none");
            var url = $(this).attr('data-href');
            $(this).closest('.vid-area').find('.yt_iframe').attr("src",url);
            $(this).closest('.vid-area').find('.yt_iframe').removeClass("d-none").addClass("d-block");
        });
    }

    // Accordion Box (for Faqs)
    // if ($(".accordion-box").length) {
    //     $(".accordion-box").on("click", ".acc-btn", function () {
    //         var outerBox = $(this).parents(".accordion-box");
    //         var target = $(this).parents(".accordion");
    //         if ($(this).next(".acc-content").is(":visible")) {
    //             //return false;
    //             $(this).removeClass("active");
    //             $(this).next(".acc-content").slideUp(300);
    //             $(outerBox).children(".accordion").removeClass("active-block");
    //         } else {
    //             $(outerBox).find(".accordion .acc-btn").removeClass("active");
    //             $(this).addClass("active");
    //             $(outerBox).children(".accordion").removeClass("active-block");
    //             $(outerBox).find(".accordion").children(".acc-content").slideUp(300);
    //             target.addClass("active-block");
    //             $(this).next(".acc-content").slideDown(300);
    //         }
    //     });
    // }

    if($('.purecounter').length){
        new PureCounter();
    }

    // MagnificPopup
    // $(".img-zoom").magnificPopup({
    //     type: "image"
    //     , closeOnContentClick: !0
    //     , mainClass: "mfp-fade"
    //     , gallery: {
    //         enabled: !0
    //         , navigateByImgClick: !0
    //         , preload: [0, 1]
    //     }
    // })
    // $('.magnific-youtube, .magnific-vimeo, .magnific-custom').magnificPopup({
    //     disableOn: 700
    //     , type: 'iframe'
    //     , mainClass: 'mfp-fade'
    //     , removalDelay: 300
    //     , preloader: false
    //     , fixedContentPos: false
    // });

    // Slider
    $(document).ready(function() {
    var owl = $('.header .owl-carousel');
    // Slider owlCarousel
    // $('.slider .owl-carousel').owlCarousel({
    //     items: 1,
    //     loop:true,
    //     dots: false,
    //     margin: 0,
    //     autoplay: true,
    //     autoplayTimeout: 5000,
    //     nav: true,
    //     navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>']
    // });
    // Slider-fade owlCarousel
    $('.slider-fade .owl-carousel').owlCarousel({
        items: 1,
        rewind:true,
        dots: false,
        margin: 0,
        autoplay: true,
        autoplayHoverPause: false,
        autoplayTimeout: 4000,
        animateOut: 'fadeOut',
        nav: true,
        navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>'],
        mouseDrag: true,
        onInitialized: function (e) {
            var a = this.items().length;

            var b = --e.item.index,
            a = e.item.count;
            // console.log(e);
            // $("#snh-1").html("<span>01</span><span>" + "0" + a + "</span>");
            $("#snh-1").html("<span>0"+(1 > b ? b + a : b > a ? b - a : b)+"</span><span>" + "0" + e.item.count + "</span>");
            // var presentage = Math.round((100 / a));
            // var presentage = Math.round((100 / e.item.count));
            var current = 1 > b ? b + a : b > a ? b - a : b;
            var presentage = Math.round((current / e.item.count) * 100);
            $('.slider__progress span').css("width", presentage + "%");
        }
    });

    owl.on('changed.owl.carousel', function(e) {
        // var item = e.item.index - 1;     // Position of the current item
        var item = e.item.index-2;     // Position of the current item
        var b = --e.item.index,
            a = e.item.count;
        $("#snh-1").html("<span> " + "0" + (1 > b ? b + a : b > a ? b - a : b) + "</span><span>" + "0" + a + "</span>");

        // var current = e.item.index+2;
        var current = 1 > b ? b + a : b > a ? b - a : b;
        // console.log(current);
        // var presentage = Math.round((100 / e.item.count) * current);
        var presentage = Math.round((current / e.item.count) * 100);

        $('.slider__progress span').css("width", presentage + "%");

            // $('h4').removeClass('animated fadeInUp');
            // $('h1').removeClass('animated fadeInUp');
            // $('p').removeClass('animated fadeInUp');
            // $('.button-light').removeClass('animated fadeInUp');
            // $('.button-light2').removeClass('animated fadeInUp');
            // $('.button-dark').removeClass('animated fadeInUp');
            // $('.button-dark2').removeClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('h4').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('h1').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('p').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('.button-light').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('.button-light2').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('.button-dark').addClass('animated fadeInUp');
            // $('.owl-item').not('.cloned').eq(item-2).find('.button-dark2').addClass('animated fadeInUp');
        });
    });

    // Hero owlCarousel
    // $('.hero .owl-carousel').owlCarousel({
    //     loop:true,
    //     margin: 30,
    //     mouseDrag:true,
    //     autoplay: false,
    //     dots: true,
    //     nav: false,
    //     navText: ["<span class='lnr ti-angle-left'></span>","<span class='lnr ti-angle-right'></span>"],
    //     responsiveClass:true,
    //     responsive:{
    //         0:{
    //             items:1,
    //         },
    //         600:{
    //             items:1
    //         },
    //         1000:{
    //             items:1
    //         }
    //     }
    // });

    // Project owlCarousel
    // $('.projects .owl-carousel').owlCarousel({
    //     loop: true
    //     , margin: 20
    //     , mouseDrag: true
    //     , autoplay: false
    //     , dots: true
    //     , nav: false
    //     , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
    //     , autoplayHoverPause:true
    //     , responsiveClass: true
    //     , responsive: {
    //         0: {
    //             items: 1
    //         , }
    //         , 600: {
    //             items: 2
    //         }
    //         , 1000: {
    //             items: 3
    //         }
    //     }
    // });

    // Project Page owlCarousel
    // $('.project-page .owl-carousel').owlCarousel({
    //     loop: true
    //     , margin: 0
    //     , mouseDrag: true
    //     , autoplay: false
    //     , dots: false
    //     , nav: true
    //     , navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>']
    //     , responsiveClass: true
    //     , responsive: {
    //         0: {
    //             items: 1
    //         , }
    //         , 600: {
    //             items: 1
    //         }
    //         , 1000: {
    //             items: 1
    //         }
    //     }
    // });

    // Services owlCarousel
    // $('.services .owl-carousel').owlCarousel({
    //     loop: true
    //     , margin: 20
    //     , mouseDrag: true
    //     , autoplay: false
    //     , dots: true
    //     , nav: false
    //     , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
    //     , autoplayHoverPause:true
    //     , responsiveClass: true
    //     , responsive: {
    //         0: {
    //             items: 1
    //         , }
    //         , 600: {
    //             items: 2
    //         }
    //         , 1000: {
    //             items: 3
    //         }
    //     }
    // });

    // Blog Grid owlCarousel
    // $('.blog-home .owl-carousel').owlCarousel({
    //     loop: true
    //     , margin: 20
    //     , mouseDrag: true
    //     , autoplay: false
    //     , dots: true
    //     , nav: false
    //     , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
    //     , autoplayHoverPause:true
    //     , responsiveClass: true
    //     , responsive: {
    //         0: {
    //             items: 1
    //         , }
    //         , 600: {
    //             items: 2
    //         }
    //         , 1000: {
    //             items: 3
    //         }
    //     }
    // });

    // Team owlCarousel
    // $('.team .owl-carousel').owlCarousel({
    //     loop: true
    //     , margin: 20
    //     , mouseDrag: true
    //     , autoplay: false
    //     , dots: true
    //     , nav: false
    //     , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
    //     , autoplayHoverPause:true
    //     , responsiveClass: true
    //     , responsive: {
    //         0: {
    //             items: 1
    //         , }
    //         , 600: {
    //             items: 2
    //         }
    //         , 1000: {
    //             items: 3
    //         }
    //     }
    // });

    // var swiperOptions = {
    //     loop: true,
    //     autoplay: {
    //       delay: 1,
    //       disableOnInteraction: false
    //     },
    //     speed: 2000,
    //     grabCursor: true,
    //     mousewheelControl: true,
    //     keyboardControl: true,
    //     navigation: {
    //       nextEl: ".swiper-button-next",
    //       prevEl: ".swiper-button-prev"
    //     },
    //     slidesPerView: 1,
    //     spaceBetween: 10,
    //     // Responsive breakpoints
    //     breakpoints: {
    //         // when window width is >= 320px
    //         320: {
    //         slidesPerView: 2,
    //         spaceBetween: 20
    //         },
    //         // when window width is >= 480px
    //         480: {
    //         slidesPerView: 3,
    //         spaceBetween: 30
    //         },
    //         // when window width is >= 640px
    //         640: {
    //         slidesPerView: 4,
    //         spaceBetween: 40
    //         },
    //         // when window width is >= 990px
    //         990: {
    //         slidesPerView: 8,
    //         spaceBetween: 40
    //         }
    //     }
    //   };
    // var swiper = new Swiper(".swiper-container", swiperOptions);

    // Team owlCarousel
    // $('.partner .owl-carousel').owlCarousel({
    //     // loop: true
    //     // , margin: 20
    //     // , mouseDrag: true
    //     // , autoplay: true
    //     // , dots: false
    //     // , nav: false
    //     // , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
    //     // // , autoplayHoverPause:false
    //     // // , fluidSpeed: true
    //     // // , smartSpeed: 500
    //     // , autoplayTimeout: 0
    //     // , autoplaySpeed: 3000
    //     // , autoplayHoverPause: false
    //     // , slideTransition: 'linear'
    //     // , responsiveClass: true
    //     // , responsive: {
    //     //     0: {
    //     //         items: 3
    //     //     , }
    //     //     , 600: {
    //     //         items: 3
    //     //     }
    //     //     , 1000: {
    //     //         items: 5
    //     //     }
    //     //     , 1200: {
    //     //         items: 8
    //     //     }
    //     // }
    //     items: 8,
    //     loop: true,
    //     margin: 20,
    //     autoplay: true,
    //     slideTransition: 'linear',
    //     autoplayTimeout: 0,
    //     smartSpeed: 3000,
    //     autoplayHoverPause: false,
    //     rewindNav:false,
    //     rewindSpeed: 0
    // });

    // Testimonials owlCarousel
    $('.testimonials .owl-carousel').owlCarousel({
        loop:false,
        margin: 20,
        mouseDrag: true,
        autoplay: true,
        dots: false,
        nav: true,
        navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"],
        autoplayHoverPause:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1
            },
            1000:{
                items:2
            },
            1920:{
                items:3
            }
        }
    });

    //  Scroll back to top
    // var progressPath = document.querySelector('.progress-wrap path');
    // var pathLength = progressPath.getTotalLength();
    // progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    // progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    // progressPath.style.strokeDashoffset = pathLength;
    // progressPath.getBoundingClientRect();
    // progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    // var updateProgress = function () {
    //     var scroll = $(window).scrollTop();
    //     var height = $(document).height() - $(window).height();
    //     var progress = pathLength - (scroll * pathLength / height);
    //     progressPath.style.strokeDashoffset = progress;
    // }
    // updateProgress();
    // $(window).scroll(updateProgress);
    // var offset = 150;
    // var duration = 550;
    // jQuery(window).on('scroll', function () {
    //     if (jQuery(this).scrollTop() > offset) {
    //         jQuery('.progress-wrap').addClass('active-progress');
    //     } else {
    //         jQuery('.progress-wrap').removeClass('active-progress');
    //     }
    // });
    // jQuery('.progress-wrap').on('click', function (event) {
    //     event.preventDefault();
    //     jQuery('html, body').animate({ scrollTop: 0 }, duration);
    //     return false;
    // })

    // DURU.init();

})();

