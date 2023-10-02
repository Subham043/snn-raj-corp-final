<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @cspMetaTag(App\Http\Policies\ContentSecurityPolicy::class)

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;1,300;1,400&amp;family=Oswald:wght@300;400&amp;display=swap">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/intlTelInput.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css'])
    @include('main.includes.common_head')
    @yield('css')
</head>

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
    <script src="{{ asset('assets/js/plugins/jq.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}" async></script>
    <script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
    <script src="{{ asset('admin/js/pages/iziToast.min.js') }}" async></script>
    <script src="{{ asset('admin/js/pages/axios.min.js') }}" async></script>
    <script src="{{ asset('assets/js/plugins/lazysizes.min.js') }}" async></script>
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
</html>
