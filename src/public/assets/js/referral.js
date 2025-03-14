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