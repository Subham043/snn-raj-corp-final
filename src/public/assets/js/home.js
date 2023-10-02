(function () {
    "use strict";

    // <!---Home Page Project Section ---!>
    // Isotope Active
    // $('.projects2-items').imagesLoaded(function () {
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
                ,
            }
        });
        return false;
    });
    $(".projects2-items").isotope({
        itemSelector: '.single-item',
        filter: '.ongoing'
        , layoutMode: 'masonry'
        ,
    });

    if ($(".vdo-play-btn").length) {
        $(".vdo-play-btn").on("click", function () {
            $(this).parent().addClass("d-none");
            var url = $(this).attr('data-href');
            $(this).closest('.vid-area').find('.yt_iframe').attr("src", url);
            $(this).closest('.vid-area').find('.yt_iframe').removeClass("d-none").addClass("d-block");
        });
    }

    if ($('.purecounter').length) {
        new PureCounter();
    }

    // <!---Home Page Project Section ---!>

    // Slider
    $(document).ready(function () {
        // Slider owlCarousel

        // <!---Home Page Banner Section ---!>
        // Slider-fade owlCarousel
        var owl = $('.header .owl-carousel');
        $('.slider-fade .owl-carousel').owlCarousel({
            items: 1,
            rewind: true,
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
                $("#snh-1").html("<span>0" + (1 > b ? b + a : b > a ? b - a : b) + "</span><span>" + "0" + e.item.count + "</span>");
                // var presentage = Math.round((100 / a));
                // var presentage = Math.round((100 / e.item.count));
                var current = 1 > b ? b + a : b > a ? b - a : b;
                var presentage = Math.round((current / e.item.count) * 100);
                $('.slider__progress span').css("width", presentage + "%");
            }
        });

        owl.on('changed.owl.carousel', function (e) {
            // var item = e.item.index - 1;     // Position of the current item
            var item = e.item.index - 2;     // Position of the current item
            var b = --e.item.index,
                a = e.item.count;
            $("#snh-1").html("<span> " + "0" + (1 > b ? b + a : b > a ? b - a : b) + "</span><span>" + "0" + a + "</span>");

            // var current = e.item.index+2;
            var current = 1 > b ? b + a : b > a ? b - a : b;
            // console.log(current);
            // var presentage = Math.round((100 / e.item.count) * current);
            var presentage = Math.round((current / e.item.count) * 100);

            $('.slider__progress span').css("width", presentage + "%");


        });
    });

    // <!---Home Page Testimonials Section ---!>
    // Testimonials owlCarousel
    $('.testimonials .owl-carousel').owlCarousel({
        loop: false,
        margin: 20,
        mouseDrag: true,
        autoplay: true,
        dots: false,
        nav: true,
        navText: ["<span class='lnr ti-arrow-left'></span>", "<span class='lnr ti-arrow-right'></span>"],
        autoplayHoverPause: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 1
            },
            1000: {
                items: 2
            },
            1920: {
                items: 3
            }
        }
    });

})();
