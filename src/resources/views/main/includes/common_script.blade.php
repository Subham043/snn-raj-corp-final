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
<script src="{{ asset('assets/modules/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('assets/modules/masonry/masonry.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/modules/YouTubePopUp/YouTubePopUp.js')}}"></script>
<script src="{{ asset('assets/js/script.js')}}"></script>

@yield('js')
