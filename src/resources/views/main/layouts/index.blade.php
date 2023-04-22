<!DOCTYPE html>
<html lang="xyz">
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
    @include('main.includes.common_script')
</body>
</html>
