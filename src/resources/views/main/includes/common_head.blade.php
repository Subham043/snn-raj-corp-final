<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @cspMetaTag(App\Http\Policies\ContentSecurityPolicy::class)

    <link rel="dns-prefetch" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link rel="dns-prefetch" href="https://src.plumb5.com/snnrajcorp_com.js">

    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://src.plumb5.com/snnrajcorp_com.js">

    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/jq.min.js')}}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/bootstrap.min.js')}}">
    <link rel="preload" as="script" href="{{ asset('admin/js/pages/just-validate.production.min.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/lazysizes.min.js') }}">
    {{-- <link rel="preload" as="script" href="{{ asset('assets/js/plugins/intlTelInput.min.js') }}"> --}}
    <link rel="preload" as="script" href="{{ asset('assets/js/common_script.js') }}">

    <link rel="preload" type="image/webp" fetchpriority="high" href="{{ asset('assets/black-logo.webp') }}" as="image">
    <link rel="preload" as="image" href="{{ asset('smartphone.svg') }}">

    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;1,300;1,400&amp;family=Oswald:wght@300;400&amp;display=swap"> --}}
    @vite(['resources/css/bootstrap.min.css', 'resources/css/themify-icons.css', 'resources/css/iziToast.min.css', 'resources/css/intlTelInput.css', 'resources/css/app.css'])
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

            --theme-header-color: #f6f6f6;
            --theme-footer-color: #183e62;
            --theme-primary-color: #bda588;
            /* --theme-hero-color: #e5d1c6; */
            /* --theme-hero-color: #faf3df; */
            --theme-hero-color: #f7f2ee;
            --theme-secondary-color: #ece9de;
            --theme-subject-color: #f6f6f4;
            --theme-suffix-color: #f7f2ee;
            --theme-hero-title-color: #fff;
            --theme-hero-title-span-color: #1b1919;
            --theme-text-color: #000;
            --theme-highlight-text-color: #183e62;
            /* --theme-lines-color:#3d3b3b0f; */
            --theme-lines-color:#a68b5d;
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
            /* background: var(--theme-header-color); */
            background: #183e62;
        }
        .duru-menu>ul>li>a, .duru-menu ul ul li a{
            color: #fff;
        }
        .duru-header, .duru-header.scrolled {
            /* background: var(--theme-header-color); */
            /* background: #fff; */
            background: transparent;
            border-bottom: 1px solid transparent;
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
            color: #183e62;
        }
        .hero .section-title span {
            color: #bda588;
        }
        .hero-main .section-title span {
            color: var(--theme-primary-color);
        }
        .hero .sub-title:before{
            /* background-color: white; */
        }
        .hero .sub-title:after{
            background-color: white;
        }
        .hero .sub-title.border-bot-light {
            /* border-bottom: 1px solid white; */
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
            /* background: var(--theme-secondary-color); */
            background: var(--theme-hero-color);
            /* padding: 125px 0; */
            padding: 50px 0;
            margin-top: 60px;
        }
        .subject-div{
            background: var(--theme-subject-color);
            /* padding: 125px 0; */
            padding: 50px 0;
            margin-top: 60px;
        }
        .suffix-div{
            background: var(--theme-suffix-color);
            /* padding: 125px 0; */
            padding: 50px 0;
            margin-top: 60px;
        }
        .hero-contact{
            /* padding: 125px 0; */
            padding: 50px 0;
            /* margin-top: 60px; */
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
            margin: 0;
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

        .testimonials .testimonial-name.sub-title:after{
            background-color: transparent;
        }

        .pt-4{
            padding-top: 2rem !important;
        }

        .pb-4{
            padding-bottom: 2rem !important;
        }

        .py-4{
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }

        .footer{
            padding: 0 !important;
        }

        .footer-bg{
            background-image: url('{{asset("assets/footer_bg_1.webp")}}');
            padding: 150px 0px 10px 0px;
            background-repeat: no-repeat;
            display: grid;
            place-content: center;
            background-position: bottom;
            background-size: cover;
        }

        .py-6{
            padding-top: 4rem !important;
            padding-bottom: 4rem !important;
        }

        .pt-6{
            padding-top: 4rem !important;
        }

        .pb-6{
            padding-bottom: 4rem !important;
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
        .duru-header.scrolled{
            background: #fff;
        }
        .modal-img{
            height: 70px;
            object-fit: contain;
            margin-right: auto;
            width: auto;
        }
        .modal-open { overflow-y: auto !important; padding-right: 0px !important; }
        .duru-nav-toggle.active i:before{
            background: white !important;
        }
        .duru-nav-toggle.active i:after{
            background: white !important;
        }

        .duru-header.scrolled .duru-nav-toggle.active i:before{
            background: black !important;
        }
        .duru-header.scrolled  .duru-nav-toggle.active i:after{
            background: black !important;
        }
    </style>
    @yield('css')
</head>
