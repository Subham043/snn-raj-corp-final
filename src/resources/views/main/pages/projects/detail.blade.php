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

    {!!$data->meta_header_script!!}
    {!!$data->meta_header_no_script!!}

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
            font-weight:normal
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
            color: var(--theme-primary-color);
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
            box-shadow: 5px 10px 10px 2px #818181;
            /* border: 6px double #ddce79; */
        }

        .project-page-banner-img{
            object-fit: cover;
            height: 85vh;
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
                height: 100%;
                display: block;
            }

            .project-page-banner-img {
                object-fit: cover;
                height: 100%;
            }

        }
    </style>

@stop

@section('content')

@if($data->use_in_banner)
    <section class="project-page suffix-div project-page-banner video-project-page mb-0 mt-0 py-0">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12 px-0">
                    <header class="p-relative header-video-container">
                        <iframe src="{{$data->video}}?autoplay=1&mute=1&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video" width="560" height="315" frameborder="0"></iframe>
                    </header>
                    <div class="row no-gutter">
                        <div class="col-md-12">
                            <div class="project-bar" style="background-color: #1b1919">
                                <div class="row project-detail-row justify-content-center align-items-center text-left text-lg-start gap-5">
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/floors.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->floor}}</h6> <span style="color: #fff">Floors</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/tower.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->tower}}</h6> <span style="color: #fff">Towers</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/acre.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->acre}}</h6> <span style="color: #fff">Acre</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/location.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->location}}</h6> <span style="color: #fff">Location</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/rera.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->rera}}</h6> <span style="color: #fff">RERA No.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/status.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->is_completed==true ? 'COMPLETED' : 'ONGOING'}}</h6> <span style="color: #fff">Status</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@else
    <section class="project-page  project-page-banner suffix-div mb-0 mt-0 py-0">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12 px-0">
                    <div class="owl-carousel owl-theme">
                        @if($data->banner_count>0)
                            @foreach($data->banner as $banner)
                                <div class="portfolio-item"> <img fetchpriority="high" class="img-fluid project-page-banner-img" src="{{$banner->image_link}}" alt="{{$banner->image_alt}}" title="{{$banner->image_title}}"> </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row no-gutter">
                        <div class="col-md-12 px-0">
                            <div class="project-bar" style="background-color:#1b1919;">
                                <div class="row project-detail-row justify-content-center align-items-center text-left text-lg-start gap-5">
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/floors.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->floor}}</h6> <span style="color: #fff">Floors</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/tower.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->tower}}</h6> <span style="color: #fff">Towers</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/acre.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->acre}}</h6> <span style="color: #fff">Acre</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/location.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->location}}</h6> <span style="color: #fff">Location</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/rera.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->rera}}</h6> <span style="color: #fff">RERA No.</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto mb-15 text-center">
                                        <div class="testimonials">
                                            <div class="wrap">
                                                <div class="item">
                                                    <div class="info">
                                                        <div class="author-img"> <img src="{{asset('assets/status.svg')}}" alt=""> </div>
                                                        <div class="cont">
                                                            <h6 style="color: #be932d">{{$data->is_completed==true ? 'COMPLETED' : 'ONGOING'}}</h6> <span style="color: #fff">Status</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<section class="suffix-div pt-0 pb-5 mt-0">
    <div class="container">
        <div class="row">

                <div class="about mb-5">
                    <div class="row">
                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light mb-3">
                                <h1 class="section-title m-0">{{$data->name}}</h1>
                            </div>
                        </div>
                        <div class="col-md-12">
                            {{-- <h2>{{$data->name}}</h2> --}}
                            {{-- <h5><span class="text-dark">RERA :</span> {{$data->rera}}</h5> --}}
                            <p>{{$data->brief_description}}</p>
                       </div>
                       <div class="col-md-12">
                            {!!$data->description!!}
                            @if($data->brochure)
                                <a aria-label="brochure" href="{{$data->brochure_link}}" class="brochure-btn" download>Download Brochure</a>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</section>

@if($data->additional_content_count>0)
    @foreach($data->additional_content as $key=>$val)
        @if(($key+1)%2!=0)
            <section class="additional-content-project section-padding py-5 pb-md-0">
                <div class="container">
                    <div class="row div-padding pb-md-0">
                        <div class="col-md-12 " data-animate-effect="fadeInRight">
                            <div class="img fl-img">
                                <img fetchpriority="low" src="{{$val->image_link}}" alt="">
                            </div>
                            <div class="wrap project-wrap-div">
                                <div class="number">
                                    {{-- <h1>{!!$val->heading!!}</h1> --}}
                                    <div class="row">
                                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                                            <div class="sub-title border-bot-light mb-3">
                                                <h1 class="section-title m-0">{!!$val->heading!!}</h1>
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
            <section class="suffix-div additional-content-project">
                <div class="container">
                    <div class="row div-padding">
                        <div class="col-md-12 order2 " data-animate-effect="fadeInLeft">
                            <div class="img fr-img">
                                <img fetchpriority="low" src="{{$val->image_link}}" alt="">
                            </div>
                            <div class="wrap project-wrap-div">
                                <div class="number">
                                    {{-- <h1>{!!$val->heading!!}</h1> --}}
                                    <div class="row">
                                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                                            <div class="sub-title border-bot-light mb-3">
                                                <h1 class="section-title m-0">{!!$val->heading!!}</h1>
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

@if($data->plan_count>0)
    <section class="project-page section-padding pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="row mb-5 " data-animate-effect="fadeInUp">
                    <div class="row">
                        <div class="col-md-auto " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light mb-3">
                                <h1 class="section-title m-0"><span>Floor</span> Plans</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @if($data->plan_count>0)
                            @foreach($data->plan as $plan)
                                {{-- <div class="portfolio-item"> <img class="img-fluid" src="{{$plan->image_link}}" alt="{{$plan->image_alt}}" title="{{$plan->image_title}}"> </div> --}}
                                <a aria-label="{{$plan->title}}" href="{{$plan->image_link}}" title="{{$plan->title}}" class="img-zoom">
                                    <div class="gallery-box">
                                        <div class="gallery-img"> <img fetchpriority="low" src="{{$plan->image_link}}" class="img-fluid mx-auto d-block" alt="{{$plan->alt}}" title="{{$plan->title}}"> </div>
                                        <div class="gallery-detail text-center"> <i class="ti-fullscreen"></i> </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@if(count($data->accomodation)>0)
<section class="about lets-talk hero hero-contact mt-5 py-5" style="background-color:#1b1919; border:1px solid #be932d;">
    <div class="background bg-img bg-fixed" data-overlay-dark="6">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="states">
                        <ul class="flex gap-5 align-items-center justify-content-center">
                            @foreach($data->accomodation as $accomodation)
                            <li class="accom">
                                <div class="numb valign">
                                    <h2 class="mb-1 text-white">{{$accomodation->room}}</h2>
                                </div>
                                <div class="text valign ml-1">
                                    <p style="color: #be932d">
                                        {!!$accomodation->area!!}
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

<!-- Amenities -->
@if($data->amenity_count>0)
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-auto mb-30" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light mb-5">
                        <h1 class="section-title m-0"><span>Best Of Class</span> Amenities</h1>
                    </div>
                </div>
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="row amenity-row justify-content-center">
                        @foreach($data->amenity as $amenity)
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="about-box">
                                    <img fetchpriority="low" src="{{$amenity->image_link}}" class="icon" alt="">
                                    <h5>{{$amenity->title}}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="py-5"></div>
@endif

<!--  Video Gallery -->
@if($data->gallery_video_count>0)
    <section class="secondary-div my-0">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-auto" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light mb-2">
                        <h1 class="section-title m-0"><span>Video</span> Galleria</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <!-- 2 columns -->
                @foreach($data->gallery_video as $gallery_video)
                    <div class="col-md-6 " data-animate-effect="fadeInUp">
                        <div class="vid-area mb-30">
                            <iframe loading="lazy" src="{{$gallery_video->video}}" title="{{$gallery_video->video_title}}" class="w-100" height="350" frameborder="0"></iframe>
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

<!-- Image Galleria -->
@if($data->gallery_image_count>0)
    <section class="section-padding mb-5">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-auto" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light mb-2">
                        <h1 class="section-title m-0"><span>Image</span> Galleria</h1>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($data->gallery_image as $gallery_image)
                    <div class="col-md-4 gallery-item " data-animate-effect="fadeInUp">
                        <a aria-label="{{$gallery_image->title}}" href="{{$gallery_image->image_link}}" title="{{$gallery_image->title}}" class="img-zoom">
                            <div class="gallery-box">
                                <div class="gallery-img"> <img fetchpriority="low" src="{{$gallery_image->image_link}}" class="img-fluid mx-auto d-block" alt="{{$gallery_image->alt}}" title="{{$gallery_image->title}}"> </div>
                                <div class="gallery-detail text-center"> <i class="ti-fullscreen"></i> </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section class="lets-talk hero hero-contact my-0 py-5">
    <div class="background bg-img bg-fixed" data-overlay-dark="6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <div class="no-stretch-line sub-title border-bot-light">An address to be proud of</div>
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <div class="section-title address-title text-white m-0">{!!$data->address!!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($data->map_location_link)
<section class="suffix-div py-5 mt-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" data-animate-effect="fadeInUp">
                <div>
                    <iframe loading="lazy" src="{{$data->map_location_link}}" class="w-100 map-shape" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
@endif


{{-- @if(!$data->use_in_banner)
    <section class="about section-padding">
        <div class="container">
            <header class="p-relative header-video2-container">
                <iframe src="{{$data->video}}?autoplay=0&mute=0&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video2" width="560" height="315" frameborder="0"></iframe>
            </header>
        </div>
    </section>
@endif --}}

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$data->meta_footer_script_nonce!!}
    {!!$data->meta_footer_no_script_nonce!!}

    <script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

        let uuid = null;
        let link = null;
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdropContact'), {
            keyboard: false
        })

        // initialize the validation library
        const validation = new JustValidate('#contactForm', {
              errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validation
          .addField('#name', [
            {
              rule: 'required',
              errorMessage: 'Name is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Name is invalid',
            },
          ])
          .addField('#phone', [
            {
              rule: 'required',
              errorMessage: 'Phone is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Phone is invalid',
            },
          ])
          .addField('#email', [
            {
                rule: 'required',
                errorMessage: 'Email is required',
            },
            {
                rule: 'email',
                errorMessage: 'Email is invalid!',
            },
          ])
          .addField('#subject', [
            {
              rule: 'required',
              errorMessage: 'Subject is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Subject is invalid',
            },
          ])
          .addField('#message', [
            {
              rule: 'required',
              errorMessage: 'Message is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Message is invalid',
            },
          ])
          .onSuccess(async (event) => {
            var submitBtn = document.getElementById('submitBtn')
            submitBtn.value = 'Sending Message ...'
            submitBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('name',document.getElementById('name').value)
                formData.append('email',document.getElementById('email').value)
                formData.append('phone',document.getElementById('phone').value)
                formData.append('subject',document.getElementById('subject').value)
                formData.append('message',document.getElementById('message').value)
                formData.append('page_url','{{Request::url()}}')

                const response = await axios.post('{{route('contact_page.post')}}', formData)
                event.target.reset();
                uuid = response.data.uuid;
                link = response.data.link;
                myModal.show()

            }catch (error){
                if(error?.response?.data?.errors?.name){
                    validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
                }
                if(error?.response?.data?.errors?.email){
                    validation.showErrors({'#email': error?.response?.data?.errors?.email[0]})
                }
                if(error?.response?.data?.errors?.phone){
                    validation.showErrors({'#phone': error?.response?.data?.errors?.phone[0]})
                }
                if(error?.response?.data?.errors?.subject){
                    validation.showErrors({'#subject': error?.response?.data?.errors?.subject[0]})
                }
                if(error?.response?.data?.errors?.message){
                    validation.showErrors({'#message': error?.response?.data?.errors?.message[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitBtn.value =  `Send Message`
                submitBtn.disabled = false;
            }
          });

          // initialize the validation library
        const validationOtp = new JustValidate('#otpForm', {
              errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validationOtp
          .addField('#otp', [
            {
              rule: 'required',
              errorMessage: 'OTP is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'OTP is invalid',
            },
          ])
          .onSuccess(async (event) => {
            var submitOtpBtn = document.getElementById('submitOtpBtn')
            submitOtpBtn.value = 'Submitting ...'
            submitOtpBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('otp',document.getElementById('otp').value)
                formData.append('page_url','{{Request::url()}}')
                formData.append('project_id', '{{$data->id}}')

                const response = await axios.post(link, formData)
                event.target.reset();
                uuid = null;
                link = null;
                myModal.hide()
                successToast(response.data.message)
            }catch (error){
                if(error?.response?.data?.errors?.otp){
                    validationOtp.showErrors({'#otp': error?.response?.data?.errors?.otp[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitOtpBtn.value =  `Submit`
                submitOtpBtn.disabled = false;
            }
          });

          document.getElementById('resendOtpBtn').addEventListener('click', async function(event){
            if(uuid){
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('uuid',uuid)
                    const response = await axios.post('{{route('contact_page.resendOtp')}}', formData)
                    successToast(response.data.message)
                }catch (error){
                    if(error?.response?.data?.message){
                        errorToast(error?.response?.data?.message)
                    }
                }finally{
                    event.target.innerText = 'Resend OTP'
                    event.target.disabled = false;
                }
            }
          })


    </script>


@stop
