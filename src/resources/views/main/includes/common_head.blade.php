<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;1,300;1,400&amp;family=Oswald:wght@300;400&amp;display=swap">
    <link rel=stylesheet href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link href="{{ asset('admin/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel=stylesheet href="{{ asset('assets/css/animate.css')}}">
    <link rel=stylesheet href="{{ asset('assets/css/themify-icons.css')}}">
    <link rel=stylesheet href="{{ asset('assets/css/owl.carousel.min.css')}}">
    <link rel=stylesheet href="{{ asset('assets/css/owl.theme.default.min.css')}}">
    <link rel=stylesheet href="{{ asset('assets/modules/magnific-popup/magnific-popup.css')}}">
    <link rel=stylesheet href="{{ asset('assets/modules/YouTubePopUp/YouTubePopUp.css')}}">
    <link rel=stylesheet href="{{ asset('assets/css/style.css')}}">
    <style nonce="{{ csp_nonce() }}">
        :root{
            --theme-background-color: {{ empty($themeSetting) ? '#1b1b1b' : $themeSetting->background_color}};
            --theme-primary-color: {{ empty($themeSetting) ? '#dccc73' : $themeSetting->primary_color}};
            --theme-overlay-color: {{ empty($themeSetting) ? '#000' : $themeSetting->overlaycolor}};
            --theme-lines-color: {{ empty($themeSetting) ? '255,255,255,0.03' : $themeSetting->lines_color_rgb.',0.03'}};
            --theme-dark-lines-color: {{ empty($themeSetting) ? '255,255,255,0.075' : $themeSetting->lines_color_rgb.',0.075'}};
            --theme-input-lines-color: {{ empty($themeSetting) ? '255,255,255,0.4' : $themeSetting->lines_color_rgb.',0.4'}};
            --theme-text-color: {{ empty($themeSetting) ? '#999' : $themeSetting->text_color}};
            --theme-highlight-text-color: {{ empty($themeSetting) ? '#fff' : $themeSetting->highlight_text_color}};
        }
    </style>
    @yield('css')
</head>
