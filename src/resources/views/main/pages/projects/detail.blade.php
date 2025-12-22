@extends('main.layouts.index')

@section('css')

    <title>{{$data->meta_title}}</title>
    <meta name="description" content="{{$data->meta_description}}"/>
    <meta name="keywords" content="{{$data->meta_keywords}}"/>

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{$data->meta_title}}" />
    <meta property="og:description" content="{{$data->meta_description}}" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="{{$data->meta_title}}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:label1" content="{{$data->meta_title}}" />
    <meta name="twitter:data1" content="{{$data->meta_description}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

    @if ($data->banner_count > 0)
    <link rel="preload" fetchPriority="high" as="image" href="{{ $data->banner[0]->image_link }}" type="image/webp">
    @endif

    <link rel="stylesheet" href="{{ asset('campaign/css/tabs.css')}}">

    <link rel="preload" as="script" href="{{ asset("assets/js/plugins/owl.carousel.min.js") }}">
    <link rel="preload" as="script" href="{{ asset("assets/js/plugins/img-previewer.min.js") }}">
    <link rel="preload" as="script" href="{{ asset("assets/js/project.js") }}">

    {!!$data->meta_header_script!!}
    {!!$data->meta_header_no_script!!}

    @vite(['resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css', 'resources/css/image-previewer.css'])

    <style nonce="{{ csp_nonce() }}">
        .process .wrap{
            padding: 0;
        }
        .process .wrap, .process .wrap .cont{
            display: inline;
        }
        .address-title{
            font-size: 20px;
            text-transform: none;
            font-weight:normal;
            color: #a68b5d !important;
        }
        .address-title span{
            font-size: 18px;
        }
        .no-gutter{
            --bs-gutter-x:0;
        }
        .project-bar .project-detail-row .testimonials .wrap .item .info .author-img{
            border-radius: 0;
            border: none;
            height: auto;
            width: 40px;
        }
        .project-bar .project-detail-row .testimonials .wrap .item .info .author-img img{
            border-radius: 0;
            margin-top: 8px;
        }
        .project-bar .project-detail-row .testimonials .wrap .item .info h6{
            color: black;
            font-size: 16px;
        }

        .project-bar .project-detail-row .testimonials .wrap .item .info .cont{
            margin-left: 50px;
        }

        .about .states li h2{
            font-size: 20px;
        }

        .project-page .owl-nav {
            position: absolute;
            bottom: 10%;
            right: 2%;
            z-index: inherit;
        }

        .brochure-btn {
            font-size: 16px;
            font-weight: 700;
            font-family: Barlow,sans-serif;
            background: var(--theme-primary-color);
            border: 1px solid var(--theme-primary-color);
            color: white;
            padding: 10px 30px;
            margin: 0;
            position: relative;
            border-radius: 50px;
            text-decoration: none;
        }

        .brochure-btn:hover{
            background: transparent;
            color: white;
            border: 1px solid white;
        }

        .brochure-btn-2:hover{
            background: transparent;
            color: var(--theme-primary-color);
            border: 1px solid var(--theme-primary-color);
        }

        .project-wrap-div{
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            justify-content: center;
        }

        .about .states {
            padding-top: 0px;
        }

        .map-shape{
            /* border-top-left-radius: 20px;
            border-bottom-right-radius: 20px; */
            /* box-shadow: 5px 10px 10px 2px #818181; */
            /* border: 6px double #ddce79; */
            border: 3px double #cea467;
            border-radius: 5px;
        }

        .project-page-banner-img{
            object-fit: cover;
            height: 100dvh;
        }

        .project-bar .project-detail-row .testimonials .wrap .item .info h6{
            font-size: 18px;
        }

        .testimonials .wrap .item .info span{
            font-size: 15px;
        }

        .gap-10{
            gap: 5rem!important;
        }

        .additional-content-project .sub-title:before, .additional-content-project .sub-title:after{
            display: none;
        }

        .owl-theme .owl-nav.disabled+.owl-dots {
            margin-top: 0px !important;
        }

        .duru-header {
            position: fixed;
        }

        .counter-main {
            font-size: 2.5rem;
            line-height: 60px;
            color: transparent;
            -webkit-text-stroke: 1px var(--theme-primary-color);
            opacity: .8;
            font-family: Barlow, sans-serif;
        }

        @media screen and (max-width: 600px) {
            .project-detail-row>*{
                width: 45% !important;
            }

            .project-detail-row .col-sm-6{
                margin-bottom: 10px;
            }

            .accom-row{
                justify-content: center !important;
            }

            .accom-row .accom{
                margin-right: 0 !important;
                width: 45%;
            }

            .project-wrap-div{
                height: unset;
                display: block;
            }

            .project-page-banner-img {
                object-fit: cover;
                height: 100%;
            }

        }

        #pills-tabContent .tab-regular{
            background: #c9c9c9;
            padding: 0;
            border-radius: unset;
        }
        #pills-tabContent .tab-regular .slider .owl-item, #pills-tabContent .tab-regular .slider-fade .owl-item{
            height: auto;
        }

        ul#pills-tab, ul#gallery-tab {
            display: flex;
            /* flex-direction: column; */
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        ul#pills-tab li button.active, ul#gallery-tab li button.active {
            color: #fff;
            background: #bda588;
        }
        ul#pills-tab li button:hover, ul#gallery-tab li button:hover {
            color: #fff;
            background: #bda588;
        }
        ul#pills-tab li button, ul#gallery-tab li button {
            background: #183e62;
            color: #fff;
            text-align: center;
            font-weight: 500;
            border-radius: 10px;
            padding: 6px 10px;
            min-width: 100px;
        }
        .project-page #pills-tabContent .owl-nav {
            /* bottom: 0;
            right: 0; */
            background: white;
            gap: 10px;
        }
        .project-page #pills-tabContent .owl-nav .owl-prev, .project-page #pills-tabContent .owl-nav .owl-next {
            background: #bda588;
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .contact-holder {
            width: 100%;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 150px 0;
        }

        .contact-holder {
            background-image: linear-gradient(45deg, rgb(114 138 158 / 54%), rgb(23 63 99)), url('{{$data->brochure_bg_image_link}}');
        }

        .contact-holder .contact-col {
            text-align: center;
            color: #fff;
        }

        .contact-holder .contact-col h2 {
            font-weight: 800;
            color: #fff;
        }

        .table-about{
            border-left: 2px solid #e1e1e1;
        }

        .about table{
            table-layout: fixed;
            width: 100%;
            border: none;
        }

        .about table tr{
            border: none;
        }

        .about table tbody th{
            /* background: #183e62; */
            text-align: left;
            width: 36%;
            border: none;
        }

        .about table tbody td{
            /* background: #fff; */
            width: 80%;
            border: none;
        }

        .about table tbody th h6{
            margin: 0;
            font-size: 1rem;
            color: #1b1919;
            font-weight: 900;
        }

        .about table tbody th h6 span{
            color: #1b1919 !important;
        }

        .about table tbody th img{
            width: 30px;
            height: 30px;
        }

        .about table tbody td h6{
            margin: 0;
            font-size: 1rem;
            word-wrap: break-word;
            color: #66717a !important;
        }

        .suffix-div{
            /* background: var(--theme-header-color); */
            margin-top: 0px !important;
        }

        .section-padding, .div-padding {
            padding-top: inherit;
            position: relative;
            z-index: 9;
        }

        .address-panel{
            background: var(--theme-hero-color);;
            /* padding: 10px 15px; */
            border-radius: 10px;
        }

        .ribbon {
            /* height: 188px; */
            position: relative;
            margin-bottom: 15px;
            /* background: url(https://html5book.ru/wp-content/uploads/2015/10/snow-road.jpg);
            background-size: cover;
            text-transform: uppercase; */
            color: white;
        }

        .ribbon5 {
            display: block;
            width: calc(100% + 20px);
            /* height: 50px;
            line-height: 50px; */
            text-align: center;
            margin-left: -10px;
            margin-right: -10px;
            background: #cea467;
            position: relative;
            top: 10px;
            padding: 5px 10px;
            font-family: Barlow, sans-serif;
            text-transform: capitalize;
            letter-spacing: 1px;
            font-weight: 500;
            font-size: 1.3rem;
        }
        .ribbon5:before, .ribbon5:after {
            content: "";
            position: absolute;
        }
        .ribbon5:before {
            height: 0;
            width: 0;
            bottom: -10px;
            left: 0;
            border-top: 10px solid #cd8d11;
            border-left: 10px solid transparent;
        }
        .ribbon5:after {
            height: 0;
            width: 0;
            right: 0;
            bottom: -10px;
            border-top: 10px solid #cd8d11;
            border-right: 10px solid transparent;
        }

        @media screen and (max-width: 600px) {
            .project-cntr-info-col, .project-page .project-detail-row>*{
                width: 100% !important;
            }
        }

        .about .states li{
            margin-right: 0 !important;
        }

        #pills-tabContent .tab-regular, #pills-tabContent .tab-regular img{
            min-height: 40vh;
            background-color: transparent !important;
            width: 100%;
            /* height: 100%; */
        }

        #pills-tabContent .tab-regular img{
            position: relative;
            z-index: 3;
        }

        #pills-tabContent .tab-regular .slider-img{
            position: relative;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        #pills-tabContent .owl-nav{
            top: 50%;
            left: 50%;
            bottom: unset;
            right: unset;
            transform: translate(-50%, -50%);
            justify-content: space-between;
            background-color: transparent !important;
        }

        #pills-tabContent .owl-nav .owl-prev{
            margin-left: -20px;
        }

        #pills-tabContent .owl-nav .owl-next{
            margin-right: -20px;
        }

        #gallery-tab-panels.tab-panels .panel{
            background-color: transparent !important;
            min-height: 70vh;
        }

        .br-1{
            border-radius: 5px;
        }

        .bg-beige{
            background: #f7f2ee;
        }

        .content-img{
            height: 500px;
            object-fit: cover;
        }

        #pills-tabContent .slider .owl-item{
            height: auto;
        }

        @media screen and (max-width: 600px){
            .table-about{
                border-top: 2px solid #e1e1e1;
                border-right: 2px solid #e1e1e1;
            }

            .about table tbody th, .about table tbody td{
                border-bottom: 2px solid #e1e1e1;
            }

            #pills-tabContent .tab-regular, #pills-tabContent .tab-regular img{
                min-height: auto;
                height: auto;
            }

            .map-frame{
                height: 450px !important;
            }
        }
    </style>

@stop

@section('content')

<h1 class="d-none">{{$data->page_keywords}}</h1>
<h2 class="d-none">{{$data->page_keywords}}</h2>

@if($data->use_in_banner)
    <section class="project-page suffix-div project-page-banner video-project-page mb-0 mt-0 py-0">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12 px-0">
                    <header class="p-relative header-video-container">
                        <iframe data-src="{{$data->video}}?autoplay=1&mute=1&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video lazyload" width="560" height="315" frameborder="0"></iframe>
                    </header>
                </div>
            </div>
        </div>
    </section>
@else
    <section id="project-page-banner" class="project-page  project-page-banner suffix-div mb-0 mt-0 py-0">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12 px-0">
                    <div class="owl-carousel owl-theme">
                        @if($data->banner_count>0)
                            @foreach($data->banner as $k => $banner)
                                @if($k==0)
                                <div class="portfolio-item"> <img fetchpriority="high" loading="eager" class="img-fluid project-page-banner-img" src="{{$banner->image_link}}" alt="{{$banner->image_alt}}" title="{{$banner->image_title}}"> </div>
                                @else
                                <div class="portfolio-item"> <img fetchpriority="low" class="img-fluid project-page-banner-img lazyload" data-src="{{$banner->image_link}}" alt="{{$banner->image_alt}}" title="{{$banner->image_title}}"> </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="pt-5 pb-5 mt-0">
    <div class="container">
        <div class="row align-items-center">

                <div class="about col-lg-9 col-md-6">
                    <div class="row">
                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light pb-0 mb-3">
                                <div class="section-title m-0"><span>{{$data->name}}</span></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{-- <h2>{{$data->name}}</h2> --}}
                            {{-- <h5><span class="text-dark">RERA :</span> {{$data->rera}}</h5> --}}
                            <p>{{$data->brief_description}}</p>
                       </div>
                       <div class="col-md-12">
                            {!!$data->description!!}
                            {{-- @if($data->brochure)
                                <a aria-label="brochure" href="{{$data->brochure_link}}" class="brochure-btn" download>Download Brochure</a>
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="table-about about col-lg-3 col-md-6">
                    <table class="w-100">
                        <tbody class="w-100">
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/floors.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">Floors</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->floor}}</h6>
                                </td>
                            </tr>
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/tower.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">Towers</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->tower}}</h6>
                                </td>
                            </tr>
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/acre.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">Acre</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->acre}}</h6>
                                </td>
                            </tr>
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/status.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">Status</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->is_completed==true ? 'COMPLETED' : 'ONGOING'}}</h6>
                                </td>
                            </tr>
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/location.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">Location</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->location}}</h6>
                                </td>
                            </tr>
                            <tr class="w-100">
                                <th>
                                    {{-- <div class="author-img"> <img src="{{asset('assets/rera.svg')}}" width="40" height="40" fetchpriority="high" loading="eager" alt="Floors"> </div> --}}
                                    <h6 style="color: #be932d"><span style="color: #fff">RERA No.</span>
                                </th>
                                <td>
                                    <h6 style="color: #be932d">{{$data->rera}}</h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</section>

@if(count($data->accomodation)>0)
<section class="about lets-talk hero hero-contact pt-4 pb-4">
    <div class="background bg-img bg-fixed" data-overlay-dark="6">
        <div class="container">
            <div class="row">
                <div class="col-md-12" data-animate-effect="fadeInUp">
                    <div id="purecounter" class="states">
                        <ul class="align-items-center justify-content-center flex flex-wrap">
                            @foreach ($data->accomodation as $accomodation)
                                {{-- <li class="flex"> --}}
                                <li class="col-md-4 col-sm-12 mx-0 p-2 text-center">
                                    <div class="numb valign justify-content-center">
                                        <div class="counter-main m-0"><span class="purecounter">{{ $accomodation->room }}</span></div>
                                    </div>
                                    <div class="text valign justify-content-center">
                                        <p>
                                            {!! $accomodation->area !!}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@if($data->additional_content_count>0)
    @foreach($data->additional_content as $key=>$val)
        @if(($key+1)%2!=0)
            <section class=" additional-content-project section-padding pt-6 {{$val->attatch_map ? "suffix-div pb-6" : ""}} {{($data->additional_content_count-1)==($key+1) && ($key+1) != 1 && !$val->attatch_map ? "pb-6" : ""}}">
                <div class="container">
                    <div class="row div-padding">
                        <div class="col-md-12 " data-animate-effect="fadeInRight">
                            <div class="img fl-img {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                @if($val->attatch_map)
                                    <div class="ribbons-wrapper {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                        <div class="address-panel {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                        {{-- <div class="address-panel map-shape"> --}}
                                            {{-- <div class="ribbon">
                                                <span class="ribbon5">
                                                    <marquee width="100%" direction="left" behavior="scroll" scrollamount="4">
                                                        {!!$data->address!!}</span>
                                                    </marquee>
                                            </div> --}}
                                            @if($data->map_location_link)
                                            <div class="p-1 {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                                <iframe loading="lazy" data-src="{{$data->map_location_link}}" class="w-100 lazyload {{$val->attatch_map ? "h-100 br-1 map-frame" : ""}}" height="450" allowfullscreen="" title="Map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <img fetchpriority="low" width="583" height="587" data-src="{{$val->image_link}}" class="lazyload content-img" title="{!!$val->heading!!}" alt="{!!$val->heading!!}">
                                @endif
                            </div>
                            <div class="wrap project-wrap-div {{$val->attatch_map ? "bg-white p-2 br-1 px-3" : ""}}">
                                <div class="number">
                                    {{-- <h1>{!!$val->heading!!}</h1> --}}
                                    <div class="row">
                                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                                            <div class="sub-title border-bot-light pb-0 mb-3">
                                                <div class="section-title m-0">{!!$val->heading!!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cont desc-ul">
                                    {!!$val->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="additional-content-project pt-6 {{$val->attatch_map ? "suffix-div pb-6" : ""}} {{($data->additional_content_count-1)==($key+1) && ($key+1) != 1 && !$val->attatch_map ? "pb-6" : ""}}">
                <div class="container">
                    <div class="row div-padding">
                        <div class="col-md-12 order2 " data-animate-effect="fadeInLeft">
                            <div class="img fr-img {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                @if($val->attatch_map)
                                    <div class="ribbons-wrapper {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                        <div class="address-panel {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                        {{-- <div class="address-panel map-shape"> --}}
                                            {{-- <div class="ribbon">
                                                <span class="ribbon5">
                                                    <marquee width="100%" direction="left" behavior="scroll" scrollamount="5">
                                                        {!!$data->address!!}</span>
                                                    </marquee>
                                                </span>
                                            </div> --}}
                                            @if($data->map_location_link)
                                            <div class="p-1 {{$val->attatch_map ? "h-100 map-frame" : ""}}">
                                                <iframe loading="lazy" data-src="{{$data->map_location_link}}" class="w-100 lazyload {{$val->attatch_map ? "h-100 br-1 map-frame" : ""}}" height="450" allowfullscreen="" title="Map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <img fetchpriority="low" width="583" height="587" data-src="{{$val->image_link}}" class="lazyload content-img" title="{!!$val->heading!!}" alt="{!!$val->heading!!}">
                                @endif
                            </div>
                            <div class="wrap project-wrap-div {{$val->attatch_map ? "bg-white p-2 br-1 px-3" : ""}}">
                                <div class="number">
                                    {{-- <h1>{!!$val->heading!!}</h1> --}}
                                    <div class="row">
                                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                                            <div class="sub-title border-bot-light pb-0 mb-3">
                                                <div class="section-title m-0">{!!$val->heading!!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cont desc-ul">
                                    {!!$val->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    @endforeach
@endif

<div id="callback-popup-trigger"></div>

@if($data->plan_category_count>0)
    <section class="project-page section-padding pt-5 pb-0">
        <div class="container">
            <div class="row">
                <div class="row mb-0 " data-animate-effect="fadeInUp">
                    <div class="row justify-content-center">
                        <div class="col-md-12 " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light pb-0 mb-4">
                                <div class="section-title text-center m-0"><span>Floor Plans</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                        @foreach ($data->plan_category as $k=>$v)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{$k==0 ? 'active' : ''}}" id="pills-tab-{{$k}}" data-bs-toggle="pill" data-bs-target="#pills-{{$k}}" type="button" role="tab" aria-controls="pills-{{$k}}" aria-selected="{{$k==0 ? 'true' : 'false'}}">{{$v->title}}</button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach ($data->plan_category as $k=>$v)
                            <div class="tab-pane fade {{$k==0 ? 'show active' : ''}} " id="pills-{{$k}}" role="tabpanel" aria-labelledby="pills-tab-{{$k}}">
                                @if($v->plan->count() > 0)
                                    <div class="tab-regular slider owl-carousel">
                                        @foreach ($v->plan as $item)
                                            <div class="slider-img">
                                                <img data-src="{{ $item->image_link }}" width="968" height="645" class="w-100 lazyload"
                                                title="Plan Image {{$item->id}}" alt="Plan Image {{$item->id}}">
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    {{-- <div class="text-center mt-5">
                        <button aria-label="Brochure Popup" type="button" data-bs-toggle="modal" data-bs-target="#contactModal" class="brochure-btn brochure-btn-2" aria-label="Download Brouchure">Download Brochure</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Amenities -->
@if($data->amenity_count>0)
    <section class="section-padding pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light pb-0 mb-4">
                        <div class="section-title text-center m-0"><span>Best Of Class Amenities</span></div>
                    </div>
                </div>
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="row amenity-row justify-content-center">
                        @foreach($data->amenity as $amenity)
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="about-box">
                                    <img fetchpriority="low" data-src="{{$amenity->image_link}}" class="icon lazyload" width="273" height="70" alt="{{$amenity->title}}" title="{{$amenity->title}}">
                                    <h5>{{$amenity->title}}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

{{-- <section class="about section-padding pt-5 pb-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 " data-animate-effect="fadeInUp">
                <div class="sub-title border-bot-light pb-0 mb-0">
                    <div class="section-title text-center m-0">An <span>address</span> to be proud of</div>
                </div>
            </div>
            <div class="col-md-12 " data-animate-effect="fadeInUp">
                <div class="ribbons-wrapper">
                    <div class="address-panel map-shape">
                        <div class="ribbon">
                            <span class="ribbon5">{!!$data->address!!}</span>
                        </div>
                        @if($data->map_location_link)
                        <div class="p-1">
                            <iframe loading="lazy" data-src="{{$data->map_location_link}}" class="w-100 lazyload" height="450" allowfullscreen="" title="Map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<!--  Video Gallery -->
@if($data->gallery_video_count>0)
    <section class="secondary-div my-0 pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center" data-animate-effect="fadeInUp">
                <div class="col-md-auto" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light pb-0 mb-3">
                        <div class="section-title text-center m-0"><span>Video Galleria</span></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- 2 columns -->
                @foreach($data->gallery_video as $gallery_video)
                    <div class="col-md-6 " data-animate-effect="fadeInUp">
                        <div class="vid-area mb-30">
                            <iframe loading="lazy" data-src="{{$gallery_video->video}}" title="{{$gallery_video->video_title}}" class="w-100 lazyload" height="350" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                            {{-- <div class="vid-icon"> <img src="https://i3.ytimg.com/vi/{{$gallery_video->video_id}}/maxresdefault.jpg" alt="YouTube">
                                <a class="video-gallery-button vid" href="https://youtu.be/{{$gallery_video->video_id}}"> <span class="video-gallery-polygon">
                                        <i class="ti-control-play"></i>
                                    </span> </a>
                            </div> --}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="mb-0">
    <div class="contact-holder" id="contact-section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8 col-md-6 col-sm-12 contact-col">
                    <h2>GET COST SHEET & BROCHURE</h2>
                    <p class="text-light">Click Below To Download Floorplans & Cost Sheet of {{$data->name}} & Register for special offers.</p>
                    <button type="button" aria-label="Floor Plan Popup" data-bs-toggle="modal" data-bs-target="#contactModal" class="brochure-btn" aria-label="Download Brouchure">Download Now</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Image Galleria -->
@if($data->gallery_image_count>0)
    <section class="section-padding pt-5 pb-5">
        <div class="container">
            <div class="row justify-content-center" data-animate-effect="fadeInUp">
                <div class="col-md-auto" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light pb-0 mb-3">
                        <div class="section-title text-center m-0"><span>Image Galleria</span></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" id="image-container">
                <div class="col-12">
                    <ul class="nav nav-pills mb-3" id="gallery-tab" role="tablist">
                        @foreach ($gallery_statuses as $k=>$v)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{$k==0 ? 'active' : ''}}" id="gallery-tab-{{$k}}" data-bs-toggle="pill" data-bs-target="#gallery-{{$k}}" type="button" role="tab" aria-controls="gallery-{{$k}}" aria-selected="{{$k==0 ? 'true' : 'false'}}">{{str($v)->replace('_', ' ')}}</button>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="gallery-tabContent">
                        @foreach ($gallery_statuses as $k=>$v)
                            <div class="tab-pane fade {{$k==0 ? 'show active' : ''}} " id="gallery-{{$k}}" role="tabpanel" aria-labelledby="gallery-tab-{{$k}}">
                                <div class="row justify-content-center">
                                    @foreach($data->gallery_image as $gallery_image)
                                        @if($gallery_image->type == $v)
                                            <div class="col-md-4 gallery-item " data-animate-effect="fadeInUp">
                                                <div class="gallery-box">
                                                    <div class="gallery-img">
                                                        <img fetchpriority="low" data-src="{{$gallery_image->image_link}}" width="372" height="372" class="img-fluid mx-auto d-block lazyload" alt="{{$gallery_image->alt}}" title="{{$gallery_image->title}}">
                                                    </div>
                                                    <div class="gallery-detail text-center"> <i class="ti-fullscreen"></i> </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

{{-- @if($data->map_location_link)
<section class="suffix-div py-5 mt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" data-animate-effect="fadeInUp">
                <div>
                    <iframe loading="lazy" data-src="{{$data->map_location_link}}" class="w-100 map-shape lazyload" height="450" allowfullscreen="" title="Map" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endif --}}


{{-- @if(!$data->use_in_banner)
    <section class="about section-padding">
        <div class="container">
            <header class="p-relative header-video2-container">
                <iframe src="{{$data->video}}?autoplay=0&mute=0&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video2" width="560" height="315" frameborder="0"></iframe>
            </header>
        </div>
    </section>
@endif --}}

    {{-- @include('main.includes.common_contact') --}}

    @include('main.includes.common_contact_modal')

@stop

@section('js')
    <script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/plugins/img-previewer.min.js' ) }}" defer></script>
    <script src="{{ asset('assets/js/project.js') }}" defer></script>

    {!!$data->meta_footer_script_nonce!!}
    {!!$data->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')


@stop
