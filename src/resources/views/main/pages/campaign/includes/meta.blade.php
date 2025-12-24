<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2, user-scalable=yes">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{$data->meta_title}}</title>
    <meta name="description" content="{{$data->meta_description}}"/>

    <meta property="og:locale" content="{{$data->og_locale}}" />
	<meta property="og:type" content="{{$data->og_type}}" />
	<meta property="og:title" content="{{$data->og_title}}" />
	<meta property="og:description" content="{{$data->og_description}}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{{$data->og_site_name}}" />
	<meta property="og:image" content="{{empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link}}" />
	<meta name="twitter:card" content="{{$data->header_logo_link}}" />
	<meta name="twitter:label1" content="{{$data->og_title}}" />
	<meta name="twitter:data1" content="{{$data->og_description}}" />

    <link rel="icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" sizes="32x32" />
    <link rel="icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($data->og_image) ? asset('campaign/images/favicon.png') : $data->og_image_link }}" />

    <link rel="preconnect" href="https://kit.fontawesome.com">


    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/jq.min.js')}}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/bootstrap.min.js')}}">
    <link rel="preload" as="script" href="{{ asset('admin/js/pages/just-validate.production.min.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/lazysizes.min.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/owl.carousel.min.js') }}">
    <link rel="preload" as="script" href="{{ asset("assets/js/plugins/owl.carousel.min.js") }}">
    <link rel="preload" as="script" href="{{ asset("campaign/js/slick.js") }}">
    <link rel="preload" as="script" href="{{ asset('campaign/js/main.js') }}">

    <link rel="preload" as="image" href="{{ asset('smartphone.svg') }}">
    <link rel="preload" fetchpriority="high" href="{{ $data->header_logo_link }}" as="image">
    @if($data->CampaignBanner)
    <link rel="preload" href="{{ $data->CampaignBanner->banner_image_link }}" as="image" fetchpriority="high">
    @endif

    @vite(['resources/css/bootstrap.min.css', 'resources/css/themify-icons.css', 'resources/css/iziToast.min.css', 'resources/css/intlTelInput.css', 'resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css', 'resources/css/tabs.css', 'resources/css/slick.css', 'resources/css/campaign_styles.css'])
    <!-- Main Style CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('campaign/css/iziToast.min.css')}}"> --}}

    <style>
        .iti {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .contact-holder {
            background-image: linear-gradient(45deg,rgba(245,70,66,.75),rgba(8,83,156,.75)),url('{{$data->brochure_bg_image_link}}');
        }
        .popup_btn_modal {
            background-color: #183e62 !important;
            border-radius: 30px!important;
            border: none 0!important;
            box-shadow: 1px 1px 2px #a6a29a!important;
            color: #fff!important;
            cursor: pointer!important;
            height: 60px!important;
            outline: 0!important;
            position: fixed!important;
            text-align: center!important;
            transition: .2s background-color ease!important;
            width: 60px!important;
            z-index: 2000000000!important;
            bottom: 24px!important;
            right: 24px!important;
        }
        .modal-img {
            height: 70px;
            object-fit: contain;
            margin-right: auto;
            width: auto;
        }
        .modal-title {
            margin-bottom: 0;
            color: #ffc820;
        }
        #contactModal input[type=password], #contactModal input[type=email], #contactModal input[type=text], #contactModal input[type=file], #contactModal select, #contactModal textarea {
            max-width: 100%;
            margin-bottom: 12px;
            padding: 15px 0;
            height: auto;
            background-color: transparent;
            -webkit-box-shadow: none;
            box-shadow: none;
            border-width: 0 0 1px;
            border-style: solid;
            display: block;
            width: 100%;
            line-height: 1.5em;
            font-family: Barlow,sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #222;
            background-image: none;
            border-bottom: 1px solid #ffc820;
            border-color: ease-in-out .15s,box-shadow ease-in-out .15s;
            border-radius: 0;
            outline: none;
        }
        #phoneModal{
            padding-left: 50px !important;
        }
        @media screen and (min-width: 576px) {
            #contactModal .modal-header {
                background-color: #f6f6f4;
            }

            #contactModal .modal-dialog {
                margin-right: unset;
            }

            #contactModal .modal-content{
                position: absolute;
                bottom: 70px;
                width: 60%;
                right: 25px;
            }

            #contactModal .modal-content::before{
                position: absolute;
                bottom: -10px;
                right:18px;
                /* margin-left: -10px; */
                content:"";
                display:block;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-top: 10px solid white;
            }
        }
    </style>
    {!!$data->meta_header_nonce!!}
</head>
