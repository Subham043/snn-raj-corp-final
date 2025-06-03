// $("#projects2-filter.projects2-filter li").on("click", function () {
//     $("#projects2-filter.projects2-filter li").removeClass("active"),
//         $(this).addClass("active");
//     var e = $(this).attr("data-filter");
//     return (
//         $("#projects2-items").isotope({
//             filter: e,
//             animationOptions: { duration: 750, easing: "linear", queue: !1 },
//         }),
//         !1
//     );
// }),
//     $("#projects2-items").isotope({
//         itemSelector: ".single-item",
//         filter: ".ongoing",
//         layoutMode: "masonry",
//     }),
$("#vdo-play-btn .vdo-play-btn").length&&$("#vdo-play-btn .vdo-play-btn").on("click",function(){$(this).parent().addClass("d-none");var a=$(this).attr("data-href");$(this).closest(".vid-area").find(".yt_iframe").attr("src",a),$(this).closest(".vid-area").find(".yt_iframe").removeClass("d-none").addClass("d-block")}),$("#purecounter .purecounter").length&&new PureCounter({selector:"#purecounter .purecounter"}),$("#testimonials-area.testimonials .owl-carousel").length&&$("#testimonials-area.testimonials .owl-carousel").owlCarousel({loop:!0,margin:20,mouseDrag:!0,autoplay:!0,dots:!1,nav:!0,navText:["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>",],autoplayHoverPause:!0,responsiveClass:!0,responsive:{0:{items:1,dots:!0},600:{items:1,dots:!0},1e3:{items:2},1920:{items:3}}}),$("#award-area .owl-carousel").length&&$("#award-area .owl-carousel").owlCarousel({margin:15,mouseDrag:!0,autoplay:!0,dots:!0,nav:!0,center:!0,loop:!0,navText:["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>",],autoplayHoverPause:!0,responsiveClass:!0,responsive:{0:{items:1},600:{items:1},1300:{items:4},1920:{items:5}}});
var myvid=document.getElementById("video1");document.getElementById("clickunmuteBtn").addEventListener("click",function(){document.getElementById("video1").muted=!1,$("#mutecase").hide(),$("#unmutecase").show()}),document.getElementById("clickmuteBtn").addEventListener("click",function(){document.getElementById("video1").muted=!0,$("#mutecase").show(),$("#unmutecase").hide()}),$(window).scroll(function(){$(this).scrollTop()>70?myvid.pause():myvid.play()});
