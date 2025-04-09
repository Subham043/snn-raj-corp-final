$(document).ready(function () {
    $("#floor-container .slider.owl-carousel").owlCarousel({
        items: 1,
        loop: !0,
        dots: !1,
        margin: 0,
        autoplay: !0,
        autoplayTimeout: 5e3,
        nav: !0,
        navText: [
            '<i class="ti-angle-left" aria-hidden="true"></i>',
            '<i class="ti-angle-right" aria-hidden="true"></i>',
        ],
    });
}),
    $("#project-page-banner.project-page .owl-carousel").owlCarousel({
        loop: !0,
        margin: 0,
        mouseDrag: !0,
        autoplay: !1,
        dots: !1,
        nav: !0,
        navText: [
            '<i class="ti-angle-left" aria-hidden="true"></i>',
            '<i class="ti-angle-right" aria-hidden="true"></i>',
        ],
        responsiveClass: !0,
        responsive: { 0: { items: 1 }, 600: { items: 1 }, 1e3: { items: 1 } },
    }),
    $(document).ready(function () {
        $("#tab-panels .tabs li").click(function () {
            var a = $(this).closest("#tab-panels");
            a.find(" .tabs li.active").removeClass("active"),
                $(this).addClass("active");
            var e = $(this).attr("data-panel-name");
            parseInt($(this).attr("data-panel-key")),
                a.find(".panel.active").slideUp(300, function a() {
                    $(this).removeClass("active"),
                        $("#" + e).slideDown(300, function () {
                            $(this).addClass("active");
                        });
                });
        }),
        $("#gallery-tab-panels .tabs li").click(function () {
            var a = $(this).closest("#gallery-tab-panels");
            a.find(" .tabs li.active").removeClass("active"),
                $(this).addClass("active");
            var e = $(this).attr("data-panel-name");
            parseInt($(this).attr("data-panel-key")),
                a.find(".panel.active").slideUp(300, function a() {
                    $(this).removeClass("active"),
                        $("#" + e).slideDown(300, function () {
                            $(this).addClass("active");
                        });
                });
        }),
            new ImgPreviewer("#image-container", {
                fillRatio: 0.9,
                dataUrlKey: "src",
                style: { modalOpacity: 0.6, headerOpacity: 0, zIndex: 99 },
                imageZoom: { min: 0.1, max: 5, step: 0.1 },
                bubblingLevel: 0,
            });
    });
