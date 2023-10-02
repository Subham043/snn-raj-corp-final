(function () {
    "use strict";

    var wind = $(window);

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

    // Sections background image from data background
    var pageSection = $(".bg-img, section");
    pageSection.each(function (indx) {
        if ($(this).attr("data-background")) {
            $(this).css("background-image", "url(" + $(this).data("background") + ")");
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
