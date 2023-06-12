<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @cspMetaTag(App\Http\Policies\ContentSecurityPolicy::class)

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;1,300;1,400&amp;family=Oswald:wght@300;400&amp;display=swap">
    <link href="{{ asset('admin/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css'])
    <style nonce="{{ csp_nonce() }}">
        :root{

            --theme-background-color: {{ empty($themeSetting) ? '#1b1b1b' : $themeSetting->background_color}};
            --theme-primary-color: {{ empty($themeSetting) ? '#dccc73' : $themeSetting->primary_color}};
            --theme-overlay-color: {{ empty($themeSetting) ? '#000' : $themeSetting->overlaycolor}};
            --theme-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-dark-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-input-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-text-color: {{ empty($themeSetting) ? '#999' : $themeSetting->text_color}};
            --theme-highlight-text-color: {{ empty($themeSetting) ? '#fff' : $themeSetting->highlight_text_color}};

            --theme-header-color: #1b1919;
            --theme-footer-color: #1b1919;
            --theme-primary-color: #be932d;
            /* --theme-hero-color: #e5d1c6; */
            --theme-hero-color: #be932d;
            --theme-secondary-color: #ece9de;
            --theme-subject-color: #f6f6f4;
            --theme-suffix-color: #f6f6f4;
            --theme-hero-title-color: #fff;
            --theme-hero-title-span-color: #1b1919;
            --theme-text-color: #000;
            --theme-highlight-text-color: #000;
            /* --theme-lines-color:#3d3b3b0f; */
            --theme-lines-color:#be932d;
        }
        body {
            color: #000000 !important;
            background: #ffffff !important;
        }
        .logo-shape{
            border-bottom-right-radius: 25px;
            border-top-left-radius: 25px;
        }
        .section-title {
            font-weight: 800;
            font-size: 30px;
        }
        .sub-title {
            font-weight: 600;
        }
        .duru-wrap {
            background: var(--theme-header-color);
        }
        .duru-menu>ul>li>a, .duru-menu ul ul li a{
            color: #fff;
        }
        .duru-header, .duru-header.scrolled {
            /* background: var(--theme-header-color); */
            background: #fff;
            border-bottom: 1px solid #000;
        }
        .duru-nav-toggle i, .duru-nav-toggle i:before, .duru-nav-toggle i:after{
            background: #000 !important;
        }
        .hero, #slider-area{
            background: var(--theme-hero-color);
        }
        .hero-main{
            padding-bottom: 70px;
        }
        .hero-main, .hero-main .hero{
            background: white;
        }
        .footer {
            background: var(--theme-footer-color);
        }
        .hero .section-title span {
            color: #fff;
        }
        .hero .section-title, .secondary-div .section-title {
            color: #000;
        }
        .hero .section-title span {
            color: #fff;
        }
        .hero-main .section-title span {
            color: var(--theme-primary-color);
        }
        .hero .sub-title:before{
            background-color: white;
        }
        .hero .sub-title.border-bot-light {
            border-bottom: 1px solid white;
        }
        .hero .button-light:hover {
            color: white;
        }
        .hero p {
            font-size: 18px;
            color: #000;
            font-weight: 500;
        }
        .secondary-div .section-title span {
            color: var(--theme-primary-color);
        }
        .secondary-div{
            background: var(--theme-secondary-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .subject-div{
            background: var(--theme-subject-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .suffix-div{
            background: var(--theme-suffix-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .hero-contact{
            padding: 125px 0;
            margin-top: 60px;
        }
        .secondary-div input[type=password].line-gray, .secondary-div input[type=email].line-gray, .secondary-div input[type=text].line-gray, .secondary-div input[type=file].line-gray, .secondary-div textarea.line-gray, .secondary-div select.line-gray {
            border-bottom: 1px solid black;
        }
        .secondary-div select.line-gray {
            padding: 15px 0 !important;
            border-radius: 0 !important;
        }
        .secondary-div  label a{
            color: black !important;
            border-bottom: 1px solid black !important;
        }
        .secondary-div input[type=checkbox].line-gray:before {
            border: 1px solid black;
        }
        .hero-contact input[type=submit] {
            background: black;
            color: white;
        }
        .hero-contact .states li h1{
            color: white;
        }
        .hero-contact .states li p {
            font-weight: 600;
            font-size: 18px;
        }
        .hero-contact input[type=submit]:hover, .hero-contact input[type=reset]:hover, .hero-contact input[type=button]:hover, .hero-contact button:hover {
            background-color: black;
            color: var(--theme-hero-color);
            border: 1px solid black;
        }
        .blog-home .item .cont{
            background-color: #ece9de;
        }
        .blog-home .item .cont .date a{
            color: #000;
            font-weight: 600;
        }
        .blog-home .item h4, .blog-home .item h4 a {
            margin-bottom: 0px;
        }
        .footer .top .item p, .footer .top .item .mail, .footer .top .item h3 span, .footer .bottom p, .footer .bottom p a{
            color: #fff;
        }
        .slide-num span{
            color: black;
        }
        .slider__progress span{
            background-color: var(--theme-hero-color);
        }
        .slider-fade .owl-theme .owl-nav [class*=owl-]{
            background: var(--theme-hero-color);
            border: 1px solid var(--theme-hero-color);
            color: #000;
        }
        .owl-theme .owl-dots .owl-dot span{
            background: black;
            border: 1px solid black;
        }
        .button-light:hover {
            color: white;
        }
        .goldern-btn-signup{
            background: var(--theme-primary-color);
            /* color: var(--theme-highlight-text-color); */
            color: white;
            border: 1px solid var(--theme-primary-color);
        }
        .goldern-btn-signup:hover{
            background-color: transparent;
            color: var(--theme-primary-color);
            border: 1px solid var(--theme-primary-color);
        }

        @media screen and (max-width: 600px) {
            .text-md-center{
                text-align: center !important;
            }
            .pt-md-0{
                padding-top: 0 !important;
            }
            .pb-md-0{
                padding-bottom: 0 !important;
            }
            .mt-md-0{
                margin-top: 0 !important;
            }
            .mb-md-0{
                margin-botton: 0 !important;
            }
            .pb-md-40{
                padding-bottom: 40px !important;
            }
        }
    </style>
    @yield('css')
</head>
