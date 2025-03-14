$(document).ready(function () {
    var swiperOptions = {
        loop: true,
        autoplay: {
        delay: 1,
        disableOnInteraction: false
        },
        speed: 2000,
        grabCursor: true,
        mousewheelControl: true,
        keyboardControl: true,
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
        },
        slidesPerView: 1,
        spaceBetween: 10,
        // Responsive breakpoints
        breakpoints: {
            // when window width is >= 320px
            320: {
            slidesPerView: 2,
            spaceBetween: 20
            },
            // when window width is >= 480px
            480: {
            slidesPerView: 3,
            spaceBetween: 30
            },
            // when window width is >= 640px
            640: {
            slidesPerView: 4,
            spaceBetween: 40
            },
            // when window width is >= 990px
            990: {
            slidesPerView: 8,
            spaceBetween: 40
            }
        }
    };
    new Swiper("#swiper-container", swiperOptions);

    $('#team-area.team .owl-carousel').owlCarousel({
        loop: true
        , margin: 20
        , mouseDrag: true
        , autoplay: false
        , dots: true
        , nav: false
        , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
        , autoplayHoverPause:true
        , responsiveClass: true
        , responsive: {
            0: {
                items: 1
            , }
            , 600: {
                items: 2
            }
            , 1000: {
                items: 3
            }
        }
    });
});