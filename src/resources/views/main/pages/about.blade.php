@extends('main.layouts.index')

@section('css')

    <title>{{$seo->meta_title}}</title>
    <meta name="description" content="{{$seo->meta_description}}"/>
    <meta name="keywords" content="{{$seo->meta_keywords}}"/>

    <meta property="og:locale" content="en_US" />
	<meta property="og:type" content="profile" />
	<meta property="og:title" content="{{$seo->meta_title}}" />
	<meta property="og:description" content="{{$seo->meta_description}}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{{$seo->meta_title}}" />
	<meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:label1" content="{{$seo->meta_title}}" />
	<meta name="twitter:data1" content="{{$seo->meta_description}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />
    @if($banner)
    <link rel="preload" fetchpriority="high" href="{{$banner->image_link}}" as="image" type="image/webp">
    @endif

    <link rel="preload" as="script" href="{{ asset("assets/js/plugins/owl.carousel.min.js") }}">
    <link rel="preload" as="script" href="{{ asset("assets/js/plugins/swiper-bundle.min.js") }}">
    <link rel="preload" as="script" href="{{ asset("assets/js/about.js") }}">

    {!!$seo->meta_header_script!!}
    {!!$seo->meta_header_no_script!!}

    @vite(['resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css', 'resources/css/swiper-bundle.min.css'])

    <style nonce="{{ csp_nonce() }}">
        .partner .owl-dots{
            margin-top: 20px !important;
        }
        .swiper-wrapper {
            transition-timing-function: linear;
        }
        .swiper-container{
            overflow: hidden;
        }

        .modal-backdrop{
            z-index: 1 !important;
        }
        .modal-dialog-scrollable .modal-content {
            background: var(--theme-suffix-color);
        }
        .modal-body ul{
            list-style-type: circle;
        }
        .hero .button-light{
            background-color: var(--theme-primary-color);
            color: white;
            border: 1px solid var(--theme-primary-color);
        }
        .hero .button-light:hover{
            background-color: transparent;
            color: var(--theme-primary-color);
        }
        .main-team-section{
            background: #fff;
            background-color: #fff;
        }
        .main-team-section .section-title{
            color: var(--theme-footer-color);
            text-align: justify;
        }
        .main-team-section p{
            color: var(--theme-text-color);
            text-align: justify;
        }

        /* .about.main-team-section .wrap .con .info .name{
            color: white;
        } */
        .about_banner_img{
            border: 1px solid #1c1919;
            padding: 5px;
            border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;
            height: 570px;
            object-fit: cover;
        }

        .core_image{
            height: 500px;
            object-fit: cover;
            border-radius: 5px;
        }

        .about .desc-ul p{
            text-align: justify;
        }

        .section-padding, .div-padding, .process .wrap .number, [data-overlay-dark] .container, [data-overlay-light] .container {
            z-index: 0;
        }

        #team-area .owl-dots .owl-dot span{
            background: white;
        }

        #team-area .owl-dots .owl-dot.active span, #team-area .owl-dots .owl-dot:hover span{
            background: #be932d;
        }

        .process .img img{
            height: 500px;
            object-fit: cover;
        }

        .about .wrap{
            padding-left: 0;
        }

        .team .wrap{
            padding-left: 0;
            padding-bottom: 0;
        }

        .br-1{
            border-radius: 5px;
        }

        .hero{
            position: relative;
        }

        .ribbon1 {
            position: absolute;
            top: -6.1px;
            right: 10px;
        }
        .ribbon1:after {
            position: absolute;
            content: "";
            width: 0;
            height: 0;
            border-left: 65px solid transparent;
            border-right: 65px solid transparent;
            border-top: 17px solid var(--theme-primary-color);
        }
        .ribbon1 span {
            position: relative;
            display: block;
            text-align: center;
            background: var(--theme-primary-color);;
            font-size: 22px;
            color: white;
            line-height: 1;
            padding: 12px 8px 3px;
            border-top-right-radius: 8px;
            width: 130px;
            font-weight: 700;
        }
        .ribbon1 span:before, .ribbon1 span:after {
            position: absolute;
            content: "";
        }
        .ribbon1 span:before {
            height: 6px;
            width: 6px;
            left: -6px;
            top: 0;
            background: var(--theme-primary-color);
        }
        .ribbon1 span:after {
            height: 6px;
            width: 8px;
            left: -8px;
            top: 0;
            border-radius: 8px 8px 0 0;
            background: #a68b6a;
        }

        .mt-6{
            margin-top: 3.5rem;
        }

        .clr-bg-about{
            background-color: var(--theme-hero-color);
            width: 80%;
            height: 100%;
            position: absolute;
            right: 0;
            top: 0;
            z-index: -1;
            border-radius: 10px;
        }

        .about-content-padding{
            padding-left: 20px;
            padding-right: 40px;
        }

        .p-relative{
            position: relative;
        }

        .vision-mision-img{
            height: 400px;
            object-fit: cover;
        }

        .blue-title{
            color: var(--theme-highlight-text-color);
        }

        @media screen and (max-width: 600px) {
            .about_banner_img {
                height: auto;
                object-fit: contain;
            }

            .team .wrap .con{
                margin-bottom: 0;
            }

            .team .wrap{
                padding-left: 0;
                padding-bottom: 10px;
            }

            .process .wrap{
                margin-top: 10px;
                margin-bottom: 0px;
            }

            .mb-sm-5{
                margin-bottom: 3rem;
            }

            .mt-sm-5{
                margin-top: 2rem !important;
            }

            .clr-bg-about{
                width: 100%;
                /* margin-top: -30px; */
            }

            .about-content-padding{
                padding: 0;
            }

            .about.section-padding{
                padding-bottom: 1rem !important;
                padding-top: 1rem !important;
            }

            .about.section-padding .py-5{
                padding-top: 3rem !important;
            }

            .about.suffix-div{
                padding-bottom: 0 !important;
            }

            .about.secondary-div{
                padding-top: 0 !important;
            }

            .vision-mision-img{
                height: auto;
            }

        }
    </style>

@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding py-4 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img src="{{ $banner->image_link}}" fetchpriority="high" loading="eager" alt="" class="img-fluid about_banner_img" width="583" height="570"></figure>
                        <div class="caption">
                            <div class="section-title">{!!$banner->heading!!}</div>
                            <p>{{$banner->description}}</p>
                            {{-- <a href="{{$banner->button_link}}" aria-label="{{$banner->button_text}}" class="button-light">{{$banner->button_text}}</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <h1 class="d-none">{{$seo->page_keywords}}</h1>
    <h2 class="d-none">{{$seo->page_keywords}}</h2>

    @if($about)
    <section class="about suffix-div py-6 pb-6 mt-5 mb-sm-5 mt-sm-5">
        <div class="container py-5">
            <div class="row justify-content-center">

            </div>
            <div class="row align-items-center">
                <div class="col-md-4" data-animate-effect="fadeInUp">
                    @if($about->image)
                    <div class="con">
                        <img data-src="{{$about->image_link}}"  width="406" height="406" fetchpriority="low" class="img-fluid lazyload" alt="">
                    </div>
                    @endif
                </div>
                <div class="col-md-8 px-3" data-animate-effect="fadeInUp">
                    <div class="row">
                        <div class="col-md-auto" data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light pb-0"><div class="section-title m-0 mb-3">{!!$about->heading!!}</div></div>

                        </div>
                    </div>
                    <div class="desc-ul">
                        {!!$about->description!!}
                    </div>

                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mission -->
    <!-- Vision -->
    {{-- @if($banner)
    <section class="mt-0 py-5 pb-3">
        <div class="container">
            <div class="row justify-content-between h-100">
                <div class="col-md-6 col-sm-12 p-2 h-100 mb-sm-5" data-animate-effect="fadeInUp">
                    <div class="hero w-100 h-100 mb-0 p-1 br-1">
                        <span class="ribbon1"><span>Our Mission</span></span>
                        <div class="col-md-12 mt-6" data-animate-effect="fadeInUp">
                            <p class="text-black text-center" style="color: black !important">{!!$banner->mission!!}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 p-2 h-100" data-animate-effect="fadeInUp">
                    <div class="hero w-100 h-100 mb-0 p-1 br-1">
                        <span class="ribbon1"><span>Our Vision</span></span>
                        <div class="col-md-12 mt-6" data-animate-effect="fadeInUp">
                            <p class="text-black text-center" style="color: black !important">{!!$banner->vission!!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif --}}

    <!-- Management -->
    @if(count($management)>0)
    <section class="about secondary-div mt-0 main-team-section pt-5 pb-5" id="callback-popup-trigger">
        <div class="container">
            <div class="row">
                @foreach($management as $key=>$val)
                    @if($key==0)
                        <div class="row mt-4 mb-4">
                            <div class="col-md-6 " data-animate-effect="fadeInUp">
                                @if($managementHeading)
                                <div class="sub-title border-bot-light pt-0 mt-0"><div class="section-title m-0">{!!$managementHeading->heading!!}</div></div>
                                @endif
                                <div class="desc-ul">
                                    {!!$val->description!!}
                                </div>
                            </div>
                            <div class="col-md-6 " data-animate-effect="fadeInUp">
                                <div class="wrap">
                                    <div class="con mb-1"> <img fetchpriority="low" data-src="{{$val->image_link}}"  width="519" height="761" class="img-fluid lazyload br-1" alt="">
                                    </div>
                                    <h4 class="name text-center m-0">{{$val->name}}</h4>
                                    <p>{{$val->designation}}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 " data-animate-effect="fadeInUp">
                            <div class="wrap">
                                <div class="con mb-1"> <img fetchpriority="low" data-src="{{$val->image_link}}" width="519" height="761" class="img-fluid lazyload br-1" alt="">
                                </div>
                                <h4 class="name text-center m-0">{{$val->name}}</h4>
                                <p>{{$val->designation}}</p>
                            </div>
                            <div class="desc-ul">
                                {!!$val->description!!}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Staff -->
    @if(count($staffs)>0)
    <section id="team-area" class="team section-padding pb-4 pt-3">
        <div class="container">
            <div class="row mb-3 justify-content-center">
                @if($staffHeading)
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light pb-0">{{$staffHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-auto">
                        <div class="sub-title border-bot-light pb-0"><div class="section-title text-center m-0 mb-3">{!!$staffHeading->heading!!}</div></div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 owl-carousel owl-theme">
                    @foreach($staffs as $staffs)
                    <div class="wrap">
                        <div class="con mb-1"> <img fetchpriority="low" width="335" height="500" data-src="{{$staffs->image_link}}" class="img-fluid core_image lazyload" alt="">
                            {{-- <div class="info">
                                <h4 class="name">{{$staffs->name}}</h4>
                            </div> --}}
                        </div>
                        <h4 class="name text-center m-0">{{$staffs->name}}</h4>
                        <p>{{$staffs->designation}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mission -->
    <!-- Vision -->
    @if ($banner)
        <section class="about section-padding pt-6 pb-6">
            <div class="container p-relative py-5">
                <div class="clr-bg-about"></div>
                <div class="row align-items-center">
                    <div class="col-lg-5 col-md-6 col-sm-12" data-animate-effect="fadeInUp">
                        <div class="con">
                            <img src="{{ asset('assets/mission.webp') }}" fetchpriority="high" loading="eager" width="373"
                                height="375" class="img-fluid shapeee br-1 vision-mision-img" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 about-content-padding" data-animate-effect="fadeInUp">
                        <div class="row">
                            <div class="col-md-auto" data-animate-effect="fadeInUp">
                                <div class="sub-title border-bot-light pb-0 mb-2">
                                    <h3 class="section-title blue-title m-0">OUR MISSON</h3>
                                </div>
                            </div>
                        </div>
                        <div class="desc-ul">
                            {!!$banner->mission!!}
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-auto" data-animate-effect="fadeInUp">
                                <div class="sub-title border-bot-light pb-0 mb-2">
                                    <h3 class="section-title blue-title m-0">OUR VISION</h3>
                                </div>
                            </div>
                        </div>
                        <div class="desc-ul">
                            {!!$banner->vission!!}
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ADDITIONAL CONTENT -->
    @if(count($additionalContent)>0)
    <section class="process about mt-0 pt-2">
        <div class="container">
            @foreach($additionalContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row pt-4 pb-5">
                        <div class="col-md-6 " data-animate-effect="fadeInLeft">
                            <div class="img">
                                <img fetchpriority="low" data-src="{{$val->image_link}}" width="571" height="651" class="lazyload" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 valign " data-animate-effect="fadeInRight">
                            <div class="wrap">
                                <div class="number">
                                    <div class="section-title">{!!$val->heading!!}</div>
                                </div>
                                <div class="cont desc-ul">
                                    {!!$val->description!!}
                                    @if($val->activate_popup)
                                        {{-- <button type="button" class="button-light goldern-btn-signup mx-2 mt-3" aria-label="{{$val->heading}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$val->id}}">{!!$val->popup_button_text!!}</button> --}}
                                        <a href="{{route('about_page.slug', $val->popup_button_slug)}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup mt-3">{!!$val->popup_button_text!!}</a>
                                    @else
                                        <a href="{{$val->button_link}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup mt-3">{{$val->button_text}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row pt-4 pb-4">
                        <div class="col-md-6 order2 valign " data-animate-effect="fadeInLeft">
                            <div class="wrap">
                                <div class="number">
                                    <div class="section-title">{!!$val->heading!!}</div>
                                </div>
                                <div class="cont desc-ul">
                                    {!!$val->description!!}
                                    @if($val->activate_popup)
                                        {{-- <button type="button" class="button-light goldern-btn-signup mx-2 mt-3" data-bs-toggle="modal" aria-label="{{$val->heading}}" data-bs-target="#staticBackdrop{{$val->id}}">{!!$val->popup_button_text!!}</button> --}}
                                        <a href="{{route('about_page.slug', $val->popup_button_slug)}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup mt-3">{!!$val->popup_button_text!!}</a>
                                    @else
                                        <a href="{{$val->button_link}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup mt-3">{{$val->button_text}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order1 " data-animate-effect="fadeInRight">
                            <div class="img">
                                <img fetchpriority="low" data-src="{{$val->image_link}}" width="571" height="651" class="lazyload" alt="">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- @foreach($additionalContent as $key=>$val)

        @if($val->activate_popup)
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{$val->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="row justify-content-end">
                                    <button  aria-label="Close Popup" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            {!!$val->popup_description!!}
                            <div class="text-center">
                                <button type="button"  aria-label="Close Popup" class="btn btn-secondary" aria-label="Close" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endforeach --}}


    @endif

    <!-- Partner -->
    @if(count($partners)>0)
    <section class="partner section-padding pt-3 pb-5">
        <div class="container">
            <div class="row mb-4 justify-content-center">
                @if($partnerHeading)
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light pb-0">{{$partnerHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-auto mb-0">
                        <div class="sub-title border-bot-light pb-0"> <div class="section-title text-center m-0 mb-3">{!!$partnerHeading->heading!!}</div></div>
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div id="swiper-container" class="row swiper-container">
                <div class="col-md-12 swiper-wrapper">
                    @foreach($partners as $partners)
                    <div class="wrap swiper-slide">
                        <div class="con">
                            <img data-src="{{$partners->image_link}}" width="114" height="114" class="img-fluid lazyload" alt="{{$partners->image_alt}}" title="{{$partners->image_title}}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    @include('main.includes.common_contact_modal')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/about.js')}}" defer></script>

@stop
