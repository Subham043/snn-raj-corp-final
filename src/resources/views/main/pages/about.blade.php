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

    {!!$seo->meta_header_script!!}
    {!!$seo->meta_header_no_script!!}

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
            background: #1b1919;
            background-color: #1b1919;
        }
        .main-team-section .section-title, .main-team-section p{
            color: white;
            text-align: justify;
        }

        .about.main-team-section .wrap .con .info .name{
            color: white;
        }
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
        }

        .about .desc-ul p{
            text-align: justify;
        }

        .section-padding, .div-padding, .process .wrap .number, [data-overlay-dark] .container, [data-overlay-light] .container {
            z-index: 0;
        }

        @media screen and (max-width: 600px) {
            .about_banner_img {
                height: auto;
                object-fit: contain;
            }

        }
    </style>

@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding py-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img src="{{ $banner->image_link}}" fetchpriority="low" alt="" class="img-fluid about_banner_img" width="571" height="658"></figure>
                        <div class="caption">
                            <div class="section-title">{!!$banner->heading!!}</div>
                            <p>{{$banner->description}}</p>
                            <a href="{{$banner->button_link}}" aria-label="{{$banner->button_text}}" class="button-light">{{$banner->button_text}}</a>
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
    <section class="about suffix-div mt-0">
        <div class="container">
            <div class="row justify-content-center">

            </div>
            <div class="row align-items-end">
                <div class="col-md-3" data-animate-effect="fadeInUp">
                    @if($about->image)
                    <div class="con">
                        <img data-src="{{$about->image_link}}"  width="406" height="406" fetchpriority="low" class="img-fluid lazyload" alt="">
                    </div>
                    @endif
                </div>
                <div class="col-md-9 " data-animate-effect="fadeInUp">
                    <div class="row">
                        <div class="col-md-auto mb-4" data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light"><div class="section-title m-0">{!!$about->heading!!}</div></div>

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

    <!-- Management -->
    @if(count($management)>0)
    <section class="about secondary-div mt-0 main-team-section">
        <div class="container">
            <div class="row">
                @if($managementHeading)
                    {{-- <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$managementHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-auto " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light"><div class="section-title m-0">{!!$managementHeading->heading!!}</div></div>
                    </div>
                @endif
            </div>
            <div class="row mt-4">
                @foreach($management as $key=>$val)
                    @if($key==0)
                        <div class="row mt-4">
                            <div class="col-md-6 " data-animate-effect="fadeInUp">
                                <div class="desc-ul">
                                    {!!$val->description!!}
                                </div>
                            </div>
                            <div class="col-md-6 " data-animate-effect="fadeInUp">
                                <div class="wrap">
                                    <div class="con"> <img fetchpriority="low" data-src="{{$val->image_link}}"  width="519" height="761" class="img-fluid lazyload" alt="">
                                        <div class="info">
                                            <h4 class="name">{{$val->name}}</h4>
                                        </div>
                                    </div>
                                    <p>{{$val->designation}}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6 " data-animate-effect="fadeInUp">
                            <div class="wrap">
                                <div class="con"> <img fetchpriority="low" data-src="{{$val->image_link}}" width="519" height="761" class="img-fluid lazyload" alt="">
                                    <div class="info">
                                        <h4 class="name">{{$val->name}}</h4>
                                    </div>
                                </div>
                                <p>{{$val->designation}}</p>
                            </div>
                            <div class="desc-ul">
                                {!!$val->description!!}
                            </div>
                        </div>
                        {{-- <div class="col-md-9 " data-animate-effect="fadeInUp">
                            <div class="desc-ul">
                                {!!$val->description!!}
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3  text-center mt-3" data-animate-effect="fadeInUp">
                            <div class="wrap wrap-2">
                                <div class="con"> <img src="{{$val->image_link}}" class="img-fluid" alt="">
                                    <div class="info">
                                    </div>
                                </div>
                                <h4 class="name">{{$val->name}}</h4>
                                <p>{{$val->designation}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 desc-ul mt-3" data-animate-effect="fadeInUp">
                            {!!$val->description!!}
                        </div> --}}
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Staff -->
    @if(count($staffs)>0)
    <section id="team-area" class="team section-padding pb-md-40">
        <div class="container">
            <div class="row mb-4">
                @if($staffHeading)
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light">{{$staffHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-auto">
                        <div class="sub-title border-bot-light"><div class="section-title m-0">{!!$staffHeading->heading!!}</div></div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 owl-carousel owl-theme">
                    @foreach($staffs as $staffs)
                    <div class="wrap">
                        <div class="con"> <img fetchpriority="low" width="335" height="500" data-src="{{$staffs->image_link}}" class="img-fluid core_image lazyload" alt="">
                            <div class="info">
                                <h4 class="name">{{$staffs->name}}</h4>
                            </div>
                        </div>
                        <p>{{$staffs->designation}}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mission -->
    @if($banner)
    <section class="lets-talk hero hero-contact py-5">
        <div class="background bg-img bg-fixed" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-auto mb-4" data-animate-effect="fadeInUp">
                        {{-- <div class="sub-title border-bot-light">Our Mission</div> --}}
                        <div class="sub-title border-bot-light"><div class="section-title m-0">Our <span>Mission</span></div></div>
                    </div>
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <h3 class="text-white">{!!$banner->mission!!}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ADDITIONAL CONTENT -->
    @if(count($additionalContent)>0)
    <section class="process suffix-div mt-0">
        <div class="container">
            @foreach($additionalContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row div-padding">
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
                                        <button type="button" class="button-light goldern-btn-signup mx-2" aria-label="{{$val->heading}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$val->id}}">{!!$val->popup_button_text!!}</button>
                                    @else
                                        <a href="{{$val->button_link}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup">{{$val->button_text}}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row div-padding">
                        <div class="col-md-6 order2 valign " data-animate-effect="fadeInLeft">
                            <div class="wrap">
                                <div class="number">
                                    <div class="section-title">{!!$val->heading!!}</div>
                                </div>
                                <div class="cont desc-ul">
                                    {!!$val->description!!}
                                    @if($val->activate_popup)
                                        <button type="button" class="button-light goldern-btn-signup mx-2" data-bs-toggle="modal" aria-label="{{$val->heading}}" data-bs-target="#staticBackdrop{{$val->id}}">{!!$val->popup_button_text!!}</button>
                                    @else
                                        <a href="{{$val->button_link}}" aria-label="{{$val->button_text}}" class="button-light goldern-btn-signup">{{$val->button_text}}</a>
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

    @foreach($additionalContent as $key=>$val)

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

    @endforeach


    @endif

        <!-- Vision -->
        @if($banner)
        <section class="lets-talk hero hero-contact mt-0 py-5">
            <div class="background bg-img bg-fixed" data-overlay-dark="6">
                <div class="container">
                    <div class="row align-items-center">
                        {{-- <div class="col-md-4 mb-3" data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light">Our Vision</div>
                        </div>
                        <div class="col-md-12 " data-animate-effect="fadeInUp">
                            <h2 class="section-title">{!!$banner->vission!!}</h2>
                        </div> --}}
                        <div class="col-md-auto mb-4" data-animate-effect="fadeInUp">
                            {{-- <div class="sub-title border-bot-light">Our Mission</div> --}}
                            <div class="sub-title border-bot-light"><div class="section-title m-0">Our <span>Vision</span></div></div>
                        </div>
                        <div class="col-md-12 " data-animate-effect="fadeInUp">
                            <h3 class="text-white">{!!$banner->vission!!}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif

    <!-- Partner -->
    @if(count($partners)>0)
    <section class="partner section-padding">
        <div class="container">
            <div class="row mb-4">
                @if($partnerHeading)
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light">{{$partnerHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-auto mb-4">
                        <div class="sub-title border-bot-light"> <div class="section-title m-0">{!!$partnerHeading->heading!!}</div></div>
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
    <div class="py-3"></div>
    @endif

    @include('main.includes.common_contact_modal')
    <button type="button" class="popup_btn_modal" aria-label="Enquiry Popup"  data-bs-toggle="modal" data-bs-target="#contactModal">
        <img src="{{asset('smartphone.svg')}}" alt="Enquiry Popup" width="35" height="35" style="height: 35px; width:35px;" />
    </button>

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js')}}" defer></script>
    <script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}" defer></script>

    <script nonce="{{ csp_nonce() }}" defer>
        (function () {
            "use strict";
            $(document).ready(function () {
                var swiperOptions = {
                    loop: true,
                    autoplay: {
                    delay: 1,
                    disableOnInteraction: false
                    },
                    speed: 2000,
                    grabCursor: true,
                    mousewheelControl: true,
                    keyboardControl: true,
                    navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev"
                    },
                    slidesPerView: 1,
                    spaceBetween: 10,
                    // Responsive breakpoints
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                        slidesPerView: 2,
                        spaceBetween: 20
                        },
                        // when window width is >= 480px
                        480: {
                        slidesPerView: 3,
                        spaceBetween: 30
                        },
                        // when window width is >= 640px
                        640: {
                        slidesPerView: 4,
                        spaceBetween: 40
                        },
                        // when window width is >= 990px
                        990: {
                        slidesPerView: 8,
                        spaceBetween: 40
                        }
                    }
                };
                var swiper = new Swiper("#swiper-container", swiperOptions);

                $('#team-area.team .owl-carousel').owlCarousel({
                    loop: true
                    , margin: 20
                    , mouseDrag: true
                    , autoplay: false
                    , dots: true
                    , nav: false
                    , navText: ["<span class='lnr ti-arrow-left'></span>","<span class='lnr ti-arrow-right'></span>"]
                    , autoplayHoverPause:true
                    , responsiveClass: true
                    , responsive: {
                        0: {
                            items: 1
                        , }
                        , 600: {
                            items: 2
                        }
                        , 1000: {
                            items: 3
                        }
                    }
                });
            });
        })();
    </script>

@stop
