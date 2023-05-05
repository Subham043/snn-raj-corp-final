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
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h1>{{$banners->title}}</h1>
                                        <p>{{$banners->description}}</p>
                                        @if($banners->button_link)
                                            <a href="{{$banners->button_link}}" class="button-light">View Detail</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
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
                <div class="col-md-4 mb-30 " data-animate-effect="fadeInUp">
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
                        <img src="{{$about->image_link}}" class="img-fluid" alt="">
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
    <div class="projects2  secondary-div">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Discover</div>
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <div class="section-title">Creative <span>Projects</span></div>
                </div>
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artines ariianu the ateliten finibus viverra nec lacus in the nedana mis erodino. Design nila iman the finise viverra nec a lacus miss viventa in the setlien suscipe no curabit tristue the seneoice misuscipit non sagie the fermen.</p>
                </div>
            </div>
            <div class="row text-center " data-animate-effect="fadeInUp">
                <ul class="projects2-filter">
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".ongoing">Ongoing Projects</li>
                    <li data-filter=".completed">Completed Projects</li>
                </ul>
            </div>
            <div class="row projects2-items " data-animate-effect="fadeInUp">
                @foreach($projects as $k => $v)
                    <div class="col-md-6 single-item {{$v->is_completed==true ? 'completed' : 'ongoing'}}">
                        <div class="projects2-wrap p-relative" style="z-index: 5">
                            @if($v->banner_count>0)
                                <a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}">
                                    <div class="projects-overlay" style="height: {{rand(300, 600)}}px">
                                        <img src="{{ $v->banner[0]->image_link }}" class="h-100 obj-cover" alt="">
                                    </div>
                                </a>
                            @endif
                            <div class="projects2-con" style="z-index: 5">
                                <p>Project P.{{$k+1}}</p>
                                <h3><a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}">{{$v->name}}</a></h3>
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
                        <div class="col-md-4 mb-30">
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
                                            <iframe src="{{$testimonials->video}}" class="w-100" height="350" title="{{$testimonials->video_title}}" frameborder="0"></iframe>
                                            <h4>{{$testimonials->video_title}}</h4>
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

        <!-- Counter -->
        @if(count($counters)>0)
        <section class="about lets-talk hero hero-contact">
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

    <!-- Blog -->
    @if(count($blogs) > 0)
    <section class="blog-home section-padding">
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
                                <a href="{{route('blogs_detail.get', $v->slug)}}"><div class="img"> <img src="{{$v->image_link}}" alt=""> </div></a>
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
