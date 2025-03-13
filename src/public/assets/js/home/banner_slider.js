$(document).ready(function () {
    var e = $("#slider-area.header .owl-carousel");
    $("#slider-area.slider-fade .owl-carousel").owlCarousel({
        items: 1,
        rewind: !0,
        dots: !1,
        margin: 0,
        autoplay: !0,
        autoplayHoverPause: !1,
        autoplayTimeout: 4e3,
        animateOut: "fadeOut",
        nav: !0,
        navText: [
            '<i class="ti-angle-left" aria-hidden="true"></i>',
            '<i class="ti-angle-right" aria-hidden="true"></i>',
        ],
        mouseDrag: !0,
        onInitialized: function (e) {
            var t = this.items().length,
                a = --e.item.index,
                t = e.item.count;
            $("#snh-1").html(
                "<span>0" +
                    (1 > a ? a + t : a > t ? a - t : a) +
                    "</span><span>0" +
                    e.item.count +
                    "</span>"
            );
            var s = Math.round(
                ((1 > a ? a + t : a > t ? a - t : a) / e.item.count) * 100
            );
            $(".slider__progress span").css("width", s + "%");
        },
    }),
        e.on("changed.owl.carousel", function (e) {
            e.item.index;
            var t = --e.item.index,
                a = e.item.count;
            $("#snh-1").html(
                "<span> 0" +
                    (1 > t ? t + a : t > a ? t - a : t) +
                    "</span><span>0" +
                    a +
                    "</span>"
            );
            var s = Math.round(
                ((1 > t ? t + a : t > a ? t - a : t) / e.item.count) * 100
            );
            $(".slider__progress span").css("width", s + "%");
        });
});