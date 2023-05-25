<script nonce="{{ csp_nonce() }}">
    const nonce = '{{ csp_nonce() }}';
</script>

<script src="{{ asset('assets/js/plugins/jquery-3.6.1.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/modernizr-2.6.2.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/jquery.isotope.v3.0.2.js')}}"></script>
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/scrollIt.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('assets/modules/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('assets/modules/masonry/masonry.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/modules/YouTubePopUp/YouTubePopUp.js')}}"></script>
<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/iziToast.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
@vite(['resources/js/app.js'])


<script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

    const errorToast = (message) =>{
        iziToast.error({
            title: 'Error',
            message: message,
            position: 'bottomCenter',
            timeout:7000
        });
    }
    const successToast = (message) =>{
        iziToast.success({
            title: 'Success',
            message: message,
            position: 'bottomCenter',
            timeout:6000
        });
    }

    const COMMON_REGEX = /^[a-z 0-9~%.:_\@\-\/\(\)\\\#\;\[\]\{\}\$\!\&\<\>\'\?\r\n+=,]+$/i;


</script>

{!! empty($chatbotSetting) ? '' : $chatbotSetting->chatbot_script_nonce !!}

@yield('js')
