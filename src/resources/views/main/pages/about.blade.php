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
        }

        .about.main-team-section .wrap .con .info .name{
            color: white;
        }
    </style>

@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img src="{{ $banner->image_link}}" fetchpriority="high" alt="" class="img-fluid"></figure>
                        <div class="caption">
                            <h1 class="section-title">{!!$banner->heading!!}</h1>
                            <p>{{$banner->description}}</p>
                            <a href="{{$banner->button_link}}" aria-label="{{$banner->button_text}}" class="button-light">{{$banner->button_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- <!-- About -->
    @if($about)
    <section class="lets-talk">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp">
                        @if(!$about->image)
                            <div class="sub-title border-bot-light">About Us</div>
                        @endif
                        @if($about->image)
                        <div class="con">
                            <img src="{{$about->image_link}}" class="img-fluid" alt="">
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8 " data-animate-effect="fadeInUp">
                        @if($about->image)
                            <div class="sub-title border-bot-light">About Us</div>
                        @endif
                        <div class="section-title">{!!$about->heading!!}</div>
                        <div class="desc-ul">
                            {!!$about->description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif --}}

    @if($about)
    <section class="about suffix-div mt-0">
        <div class="container">
            <div class="row">
                {{-- <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp"> --}}
                    {{-- @if(!$about->image)
                    @endif --}}
                    {{-- <div class="sub-title border-bot-light">About Us</div>
                </div> --}}
                <div class="col-md-6 " data-animate-effect="fadeInUp">
                    {{-- @if($about->image)
                        <div class="sub-title border-bot-light">{{$about->sub_heading}}</div>
                    @endif --}}
                    <div class="sub-title border-bot-light"><h2 class="section-title m-0">{!!$about->heading!!}</h2></div>

                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4" data-animate-effect="fadeInUp">
                    @if($about->image)
                    <div class="con">
                        <img src="{{$about->image_link}}"  fetchpriority="low"class="img-fluid" alt="">
                    </div>
                    @endif
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
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
                    <div class="col-md-5 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light"><h2 class="section-title m-0">{!!$managementHeading->heading!!}</h2></div>
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
                                    <div class="con"> <img fetchpriority="low" src="{{$val->image_link}}" class="img-fluid" alt="">
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
                                <div class="con"> <img fetchpriority="low" src="{{$val->image_link}}" class="img-fluid" alt="">
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
    <section class="team section-padding pb-md-40">
        <div class="container">
            <div class="row mb-4">
                @if($staffHeading)
                    {{-- <div class="col-md-4">
                        <div class="sub-title border-bot-light">{{$staffHeading->sub_heading}}</div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="sub-title border-bot-light"><h2 class="section-title m-0">{!!$staffHeading->heading!!}</h2></div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 owl-carousel owl-theme">
                    @foreach($staffs as $staffs)
                    <div class="wrap">
                        <div class="con"> <img fetchpriority="low" src="{{$staffs->image_link}}" class="img-fluid" alt="">
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
                    <div class="col-md-3 mb-1" data-animate-effect="fadeInUp">
                        {{-- <div class="sub-title border-bot-light">Our Mission</div> --}}
                        <div class="sub-title border-bot-light"><h2 class="section-title m-0">Our <span>Mission</span></h2></div>
                    </div>
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <h3 class="text-white">{!!$banner->mission!!}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- AWARDS -->
    {{-- <section class="section-padding">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">AWARDS</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title mb-5">Awards & <span>Recognition</span></div>
                    <ul class="accordion-box clearfix">
                        <li class="accordion block">
                            <div class="acc-btn">Modern Architectural Structures</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu atelit finibus viverra nec lacus. Nedana theme erodino setlie suscipe no tristique.</div>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">Modern Building Structures</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu atelit finibus viverra nec lacus. Nedana theme erodino setlie suscipe no tristique.</div>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">Modern Design Structures</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu atelit finibus viverra nec lacus. Nedana theme erodino setlie suscipe no tristique.</div>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">Modern Urban Structures</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu atelit finibus viverra nec lacus. Nedana theme erodino setlie suscipe no tristique.</div>
                                </div>
                            </div>
                        </li>
                        <li class="accordion block">
                            <div class="acc-btn">Modern Interior Structures</div>
                            <div class="acc-content">
                                <div class="content">
                                    <div class="text">Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu atelit finibus viverra nec lacus. Nedana theme erodino setlie suscipe no tristique.</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- ADDITIONAL CONTENT -->
    @if(count($additionalContent)>0)
    <section class="process suffix-div mt-0">
        <div class="container">
            @foreach($additionalContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row div-padding">
                        <div class="col-md-6 " data-animate-effect="fadeInLeft">
                            <div class="img">
                                <img fetchpriority="low" src="{{$val->image_link}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 valign " data-animate-effect="fadeInRight">
                            <div class="wrap">
                                <div class="number">
                                    <h2 class="section-title">{!!$val->heading!!}</h2>
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
                                    <h2 class="section-title">{!!$val->heading!!}</h2>
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
                                <img fetchpriority="low" src="{{$val->image_link}}" alt="">
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            </div>
                            {!!$val->popup_description!!}
                            <div class="text-center">
                                <button type="button" class="btn btn-secondary" aria-label="Close" data-bs-dismiss="modal">Close</button>
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
                        <div class="col-md-3 mb-1" data-animate-effect="fadeInUp">
                            {{-- <div class="sub-title border-bot-light">Our Mission</div> --}}
                            <div class="sub-title border-bot-light"><h2 class="section-title m-0">Our <span>Vision</span></h2></div>
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
                    <div class="col-md-6">
                        <div class="sub-title border-bot-light"> <h2 class="section-title m-0">{!!$partnerHeading->heading!!}</h2></div>
                    </div>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row swiper-container">
                <div class="col-md-12 swiper-wrapper">
                    @foreach($partners as $partners)
                    <div class="wrap swiper-slide">
                        <div class="con">
                            <img src="{{$partners->image_link}}" class="img-fluid" alt="{{$partners->image_alt}}" title="{{$partners->image_title}}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <div class="py-5"></div>
    @endif

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
