(function () {
    "use strict";

    // <!---Project Detail Page Project Section ---!>
    // MagnificPopup
    $(".img-zoom").magnificPopup({
        type: "image"
        , closeOnContentClick: !0
        , mainClass: "mfp-fade"
        , gallery: {
            enabled: !0
            , navigateByImgClick: !0
            , preload: [0, 1]
        }
    })
    // <!---Project Detail Page Project Section ---!>

    // Slider
    $(document).ready(function () {
        // Slider owlCarousel

        // <!---Project Detail Page Plan Section ---!>
        $('.slider .owl-carousel').owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            margin: 0,
            autoplay: true,
            autoplayTimeout: 5000,
            nav: true,
            navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>']
        });

    });

    // <!---Project Page Banner Section ---!>
    // // Project Page owlCarousel
    $('.project-page .owl-carousel').owlCarousel({
        loop: true
        , margin: 0
        , mouseDrag: true
        , autoplay: false
        , dots: false
        , nav: true
        , navText: ['<i class="ti-angle-left" aria-hidden="true"></i>', '<i class="ti-angle-right" aria-hidden="true"></i>']
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
                ,
            }
            , 600: {
                items: 1
            }
            , 1000: {
                items: 1
            }
        }
    });

})();
