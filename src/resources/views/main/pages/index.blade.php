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

    {!!$seo->meta_header_script_nonce!!}
    {!!$seo->meta_header_no_script_nonce!!}

    <style nonce="{{ csp_nonce() }}">
        .p-relative{
            position: relative;
        }
        .obj-cover{
            object-fit: cover;
        }
        .project-img-shape{
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 5px 10px 10px 2px #818181;
            border: 6px double #ddce79;
            border-style: double double none none;
        }
        .shapeee{
            border-top-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .project_old{
            background: var(--theme-header-color);
        }
        .project_old .sub-title, .project_old .section-title span {
            color: #fff;
        }
        .project_old .projects2-filter li {
            color: #fff;
        }
        .project_old .projects2-filter li.active{
            color: var(--theme-primary-color);
        }
        .project_old .projects2-con {
            left: 20px;
            top: 70px;
            background-image: none;
        }

        .project_old p {
            color: #fff;
            font-size: 15px;
        }

        .project_old p img {
            height: 20px;
            display: inline;
            width: 20px;
            margin-top: -5px;
        }
        .project_old .projects2-wrap h3 a{
            color: var(--theme-primary-color);
        }

        .project_old .projects-overlay:before {
            /* background: #000;
            opacity: 0.1; */
            /* background-image: linear-gradient(to right,rgba(27,25,25,0.1) 30%,transparent 100%); */
            background-image: linear-gradient(to right,rgba(27,25,25,0.2) 60%,transparent 100%);
        }

        .project_old .projects2-wrap h3 {
            font-size: 25px;
        }

        .testimonials .owl-theme .owl-nav {
            bottom: 10%;
            right: 0%;
        }

        .slider-fade .v-middle{
            position: relative;
            transform: none;
            top: 0;
            left: 0;
        }

        .header.slider-fade  {
            min-height: 1px;
            height: auto;
            overflow: hidden;
            background: transparent !important;
        }

        .slider-fade .slider .owl-item, .slider-fade .owl-item {
            height: auto;
            position: relative;
        }

        .slider-fade .slider .item, .slider-fade .item{
            position: static;
            background-image: none !important;
        }

        .slider-fade .owl-carousel .owl-stage:after, #slider-area:after{
            content: none;
        }

        @media screen and (max-width: 600px) {
            #slider-area img {
                opacity: 1;
            }
        }
    </style>

@stop

@section('content')

    <!-- Slider -->
    @if($about->use_in_banner)
        <header class="p-relative header-video-container">
            <iframe src="{{$about->video}}?autoplay=1&mute=1&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video" width="560" height="315" frameborder="0"></iframe>
        </header>
    @else
        @if(count($banners)>0)
        <header id="slider-area" class="header slider-fade">
            <div class="owl-carousel owl-theme">
                <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                @foreach($banners as $banners)
                    <div class="text-left item bg-img" data-overlay-dark="4" data-background="{{$banners->banner_image_link}}">
                        <div class="v-middle caption">
                            <a href="{{$banners->button_link ? $banners->button_link : '#'}}">
                                <img src="{{$banners->banner_image_link}}" alt="{{$banners->banner_image_alt}}" title="{{$banners->banner_image_title}}" fetchpriority="high">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slide-num" id="snh-1"></div>
            <div class="slider__progress"><span></span></div>
        </header>
        @endif
    @endif
    <!-- About -->
    @if($about)
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    {{-- @if(!$about->image)
                    @endif --}}
                    <div class="sub-title border-bot-light">{{$about->sub_heading}}</div>
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    {{-- @if($about->image)
                        <div class="sub-title border-bot-light">{{$about->sub_heading}}</div>
                    @endif --}}
                    <div class="section-title">{!!$about->heading!!}</div>

                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    @if($about->image)
                    <div class="con">
                        <img src="{{$about->image_link}}" fetchpriority="high" class="img-fluid shapeee" alt="">
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

    <!-- Counter -->
    @if(count($counters)>0)
    <section class="about lets-talk hero hero-contact py-5">
        <div class="background bg-img bg-fixed" data-overlay-dark="6">
            <div class="container">
                <div class="row">
                    @if($counterHeading)
                        <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light">{{$counterHeading->sub_heading}}</div>
                        </div>
                        <div class="col-md-8 " data-animate-effect="fadeInUp">
                            <div class="section-title">{!!$counterHeading->heading!!}</div>
                        </div>
                    @endif
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <div class="states">
                            <ul class="flex gap-2 align-items-center justify-content-between">
                                @foreach($counters as $counters)
                                <li class="flex">
                                    <div class="numb valign">
                                        <h1>{{$counters->counter}}</h1>
                                    </div>
                                    <div class="text valign">
                                        <p>
                                            {!!$counters->title!!}
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

    {{-- @if(!$about->use_in_banner)
        <section class="about section-padding">
            <div class="container">
                <header class="p-relative header-video2-container">
                    <iframe src="{{$about->video}}?autoplay=0&mute=0&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video2" width="560" height="315" frameborder="0"></iframe>
                </header>
            </div>
        </section>
    @endif --}}

    <!-- Projects 2 -->
    <div class="projects2 project_old  subject-div mt-0">
        <div class="container">
            <div class="row mb-4">
                @if($projectHeading)
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">{{$projectHeading->sub_heading}}</div>
                </div>
                @endif
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    @if($projectHeading)
                    <div class="section-title">{!!$projectHeading->heading!!}</div>
                    <p>{!!$projectHeading->description!!}</p>
                    @endif
                    <div class="row " data-animate-effect="fadeInUp">
                        <ul class="projects2-filter">
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".ongoing">Ongoing Projects</li>
                            <li data-filter=".completed">Completed Projects</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row projects2-items " data-animate-effect="fadeInUp">
                @php
                    $height = 0;
                    $symbol = "greater";
                @endphp
                @foreach($projects as $k => $v)

                    @php
                        if($symbol == "greater"){
                            $newHeight = rand(500,600);
                            $height = $newHeight > $height ? $newHeight : $height;
                            $symbol = "lesser";
                        }else{
                            $newHeight = rand(300,400);
                            $height = $newHeight < $height ? $newHeight : $height;
                            $symbol = "greater";
                        }
                    @endphp

                    <div class="col-md-6 single-item {{$v->is_completed==true ? 'completed' : 'ongoing'}}">
                        <div class="projects2-wrap p-relative" style="z-index: 5">
                            @if($v->banner_count>0)
                                <a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}">
                                    <div class="projects-overlay">
                                        <img src="{{ $v->banner[0]->image_link }}" class="h-100 obj-cover" style="height: {{$height}}px !important;" fetchpriority="low" alt="">
                                    </div>
                                </a>
                            @endif
                            <div class="projects2-con" style="z-index: 5">
                                <h3><a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}">{{$v->name}}</a></h3>
                                <p><img src="{{asset('assets/location.svg')}}" alt=""> {{Str::limit($v->location, 30)}}</p>
                                <p><img src="{{asset('assets/status.svg')}}" alt=""> {{$v->is_completed==true ? 'COMPLETED' : 'ONGOING'}}</p>
                                <a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="project2-link"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <!-- Testiominals -->
    @if(count($testimonials)>0)
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding">
            <div class="container">
                <div class="row">
                    @if($testimonialHeading)
                        <div class="col-md-4">
                            <h3 class="sub-title border-bot-light">{{$testimonialHeading->sub_heading}}</h3>
                        </div>
                    @endif
                    <div class="col-md-8">
                        @if($testimonialHeading)
                        <div class="section-title">{!!$testimonialHeading->heading!!}</div>
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="wrap">
                            <div class="owl-carousel owl-theme">

                                @foreach($testimonials as $testimonials)
                                <div class="row">
                                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                                        <div class="vid-area mb-30">
                                            <iframe loading="lazy" src="{{$testimonials->video}}" class="w-100" height="350" title="{{$testimonials->video_title}}" frameborder="0"></iframe>
                                            <h3 class="sub-title">{{$testimonials->video_title}}</h3>
                                            {{-- <div class="vid-icon"> <img src="https://i3.ytimg.com/vi/{{$testimonials->video_id}}/maxresdefault.jpg" alt="YouTube">
                                                <a class="video-gallery-button vid" href="https://youtu.be/{{$testimonials->video_id}}"> <span class="video-gallery-polygon">
                                                        <i class="ti-control-play"></i>
                                                    </span> </a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Blog -->
    @if(count($blogs) > 0)
    <section class="blog-home suffix-div mt-0">
        <div class="container">
            <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="sub-title border-bot-light">Blog</div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title"><span>Latest</span> News</div>
                    </div>
            </div>
            <div class="row">
                @foreach ($blogs as $k => $v)
                    <div class="col-md-4">
                        <div class="item mb-5">
                            <div class="post-img">
                                <a href="{{route('blogs_detail.get', $v->slug)}}"><div class="img"> <img src="{{$v->image_link}}" alt="" fetchpriority="low"> </div></a>
                            </div>
                            <div class="cont">
                                <h4><a href="{{route('blogs_detail.get', $v->slug)}}">{{$v->name}}</a></h4>
                                <div class="date"><a href="{{route('blogs_detail.get', $v->slug)}}"><span class="ti-time"></span>&nbsp;&nbsp;<span>{{$v->created_at->diffForHumans()}}</span></a> </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @include('main.includes.referal')
    <div class="py-5"></div>

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
