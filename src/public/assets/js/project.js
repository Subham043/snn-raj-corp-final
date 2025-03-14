$(document).ready(function(){$("#floor-container .slider.owl-carousel").owlCarousel({items:1,loop:!0,dots:!1,margin:0,autoplay:!0,autoplayTimeout:5e3,nav:!0,navText:['<i class="ti-angle-left" aria-hidden="true"></i>','<i class="ti-angle-right" aria-hidden="true"></i>']})}),$("#project-page-banner.project-page .owl-carousel").owlCarousel({loop:!0,margin:0,mouseDrag:!0,autoplay:!1,dots:!1,nav:!0,navText:['<i class="ti-angle-left" aria-hidden="true"></i>','<i class="ti-angle-right" aria-hidden="true"></i>'],responsiveClass:!0,responsive:{0:{items:1},600:{items:1},1e3:{items:1}}});

$(document).ready(function () {
    $('#tab-panels .tabs li').click(function(){
        var $panel = $(this).closest('#tab-panels');


        //event listener listening for clicks on the tabs panels

        //figure out which panel to show

        $panel.find(' .tabs li.active').removeClass('active');

        $(this).addClass('active');

        var clickedPanel = $(this).attr('data-panel-name');
        var clickedPanelKey = parseInt($(this).attr('data-panel-key'))

        //hide current panel
        $panel.find('.panel.active').slideUp(300, nextPanel);

        //show new panel
        function nextPanel(){
            $(this).removeClass('active');

            $('#'+clickedPanel).slideDown(300, function(){
                $(this).addClass('active');
            });
        }
    })
    new ImgPreviewer('#image-container',{
        // aspect ratio of image
        fillRatio: 0.9,
        // attribute that holds the image
        dataUrlKey: 'src',
        // additional styles
        style: {
            modalOpacity: 0.6,
            headerOpacity: 0,
            zIndex: 99
        },
        // zoom options
        imageZoom: {
            min: 0.1,
            max: 5,
            step: 0.1
        },
        // detect whether the parent element of the image is hidden by the css style
        bubblingLevel: 0,

    });
});