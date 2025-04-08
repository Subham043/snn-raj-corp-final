<!DOCTYPE html>
<html lang="en">
@include('main.includes.common_head')
<body>
    <div class="content-wrapper">
        @include('main.includes.loader')
        @include('main.includes.scroll_top')
        @include('main.includes.lines')
        @include('main.includes.header')

        @yield('content')

        @include('main.includes.footer')
        @include('cookie-consent::index')
    </div>
    <!-- jQuery -->
</body>
    <script nonce="{{ csp_nonce() }}">
        const nonce = '{{ csp_nonce() }}';
    </script>

    {{-- <script src="{{ asset('assets/js/plugins/jquery-3.6.1.min.js')}}"></script> --}}
    <script src="{{ asset('assets/js/plugins/jq.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}" defer></script>
    <script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/plugins/lazysizes.min.js') }}" defer></script>
    <script src="{{ asset('admin/js/pages/iziToast.min.js') }}" async></script>
    <script src="{{ asset('admin/js/pages/axios.min.js') }}" async></script>
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
    <script src="{{ asset('assets/js/common_script.js') }}" defer></script>
    @yield('js')
    <script type='text/javascript' nonce="{{ csp_nonce() }}">
        window.requestIdleCallback(() => {
            var p5 = document.createElement('script');
            p5.type = 'text/javascript';
            p5.src = 'https://src.plumb5.com/snnrajcorp_com.js';
            document.body.appendChild(p5);
        });
    </script>
</html>
