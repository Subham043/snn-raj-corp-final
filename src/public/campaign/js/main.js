$(document).ready(function() {
    $(".regular").slick({
        dots: false,
        infinite: true,
        adaptiveHeight: true,
        arrows: false,
        // prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
        // nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                },
            },
        ],
    });
    $(".gallery-slider").slick({
        dots: true,
        infinite: true,
        adaptiveHeight: true,
        arrows: true,
        prevArrow:
            '<button type="button" data-role="none" class="slick-prev" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow:
            '<button type="button" data-role="none" class="slick-next" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right"></i></button>',
        customPaging: function (slider, i) {
            return (
                '<button  aria-label="Image Slider Index"> <img src="' +
                $(slider.$slides[i]).attr("img-src") +
                '"/></button>'
            );
        },
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                },
            },
        ],
    });
    $(".tab-regular").owlCarousel({
        items: 1,
        center: true,
        autoplay: true,
        rewind: true,
        nav: true,
        dots: false,
        navText: [
            '<button type="button" data-role="none" class="slick-prev slick-arrow" style="" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i></button>',
            '<button type="button" data-role="none" class="slick-next slick-arrow" style="" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></button>',
        ],
    });
    $(".creation").slick({
        dots: false,
        infinite: true,
        adaptiveHeight: true,
        // arrows: false,
        prevArrow:
            '<button type="button" data-role="none" class="slick-prev" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left"></i></button>',
        nextArrow:
            '<button type="button" data-role="none" class="slick-next" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right"></i></button>',
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: false,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false,
                },
            },
        ],
    });

    $(".tab-panels .tabs li").click(function () {
        var $panel = $(this).closest(".tab-panels");

        //event listener listening for clicks on the tabs panels

        //figure out which panel to show

        $panel.find(" .tabs li.active").removeClass("active");

        $(this).addClass("active");

        var clickedPanel = $(this).attr("data-panel-name");

        //hide current panel
        $panel.find(".panel.active").slideUp(300, nextPanel);

        //show new panel
        function nextPanel() {
            $(this).removeClass("active");

            $("#" + clickedPanel).slideDown(300, function () {
                $(this).addClass("active");
            });
        }
    });
});
