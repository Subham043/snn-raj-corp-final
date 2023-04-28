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
        .video-gallery-polygon{
            color: #fff !important;
            bottom: -40px;
            left: 0;
            font-size: 30px;
        }
    </style>

@stop

@section('content')

    <!-- Slider -->
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
    <!-- About -->
    @if($about)
    <section class="about section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                    @if(!$about->image)
                        <div class="sub-title border-bot-light">{{$about->sub_heading}}</div>
                    @endif
                    @if($about->image)
                    <div class="con">
                        <img src="{{$about->image_link}}" class="img-fluid" alt="">
                    </div>
                    @endif
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    @if($about->image)
                        <div class="sub-title border-bot-light">{{$about->sub_heading}}</div>
                    @endif
                    <div class="section-title">{!!$about->heading!!}</div>
                    {!!$about->description!!}

                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Counter -->
    @if(count($counters)>0)
    <section class="about lets-talk">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row">
                    @if($counterHeading)
                        <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                            <div class="sub-title border-bot-light">{{$counterHeading->sub_heading}}</div>
                        </div>
                        <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                            <div class="section-title">{!!$counterHeading->heading!!}</div>
                        </div>
                    @endif
                    <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
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

    <!-- Projects 2 -->
    <div class="projects2 section-padding">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Discover</div>
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title">Creative <span>Projects</span></div>
                    <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artines ariianu the ateliten finibus viverra nec lacus in the nedana mis erodino. Design nila iman the finise viverra nec a lacus miss viventa in the setlien suscipe no curabit tristue the seneoice misuscipit non sagie the fermen.</p>
                </div>
            </div>
            <div class="row text-center animate-box" data-animate-effect="fadeInUp">
                <ul class="projects2-filter">
                    <li class="active" data-filter="*">All</li>
                    <li data-filter=".ongoing">Ongoing Projects</li>
                    <li data-filter=".completed">Completed Projects</li>
                </ul>
            </div>
            <div class="row projects2-items animate-box" data-animate-effect="fadeInUp">
                @foreach($projects as $k => $v)
                    <div class="col-md-6 single-item {{$v->is_completed==true ? 'completed' : 'ongoing'}}">
                        <div class="projects2-wrap">
                            @if($v->banner_count>0)
                                <a href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img src="{{ $v->banner[0]->image_link }}" alt=""></a>
                            @endif
                            <div class="projects2-con">
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
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row">
                    @if($testimonialHeading)
                        <div class="col-md-4 mb-30">
                            <h3 class="sub-title border-bot-dark">{{$testimonialHeading->sub_heading}}</h3>
                        </div>
                    @endif
                    <div class="col-md-8">
                        @if($testimonialHeading)
                            <div class="section-title">{{$testimonialHeading->heading}}</div>
                        @endif
                        <div class="wrap">
                            <div class="owl-carousel owl-theme">

                                @foreach($testimonials as $testimonials)
                                <div class="item"> <span class="quote"><img src="{{ asset('assets/images/quot.png')}}" alt=""></span>
                                    <p>{{$testimonials->message}}</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="{{$testimonials->image_link}}" alt=""> </div>
                                        <div class="cont">
                                            <h6>{{$testimonials->name}}</h6> <span>{{$testimonials->designation}}</span>
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

    @include('main.includes.referal')

    <!-- Blog -->
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
            <div class="col-md-4">
                <div class="item">
                    <div class="post-img">
                        <a href="post.html"><div class="img"> <img src="{{ asset('assets/images/blog/1.jpg')}}" alt=""> </div></a>
                    </div>
                    <div class="cont">
                        <h4><a href="post.html">5 Best Villa ideas in 2023</a></h4>
                        <div class="info"> <a href="blog.html"><span>Exterior Design</span></a> <a href="blog.html">Dec, 24</a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item">
                    <div class="post-img">
                        <a href="post.html"><div class="img"> <img src="{{ asset('assets/images/blog/2.jpg')}}" alt=""> </div></a>
                    </div>
                    <div class="cont">
                        <h4><a href="#0">Luxury kitchen ideas</a></h4>
                        <div class="info"> <a href="blog.html"><span>Interior Design</span></a> <a href="blog.html">Dec, 21</a> </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="item">
                    <div class="post-img">
                        <a href="post.html"><div class="img"> <img src="{{ asset('assets/images/blog/3.jpg')}}" alt=""> </div></a>
                    </div>
                    <div class="cont">
                        <h4><a href="#0">Home Decorating Inspiration</a></h4>
                        <div class="info"> <a href="blog.html"><span>Interior Design</span></a> <a href="blog.html">Dec, 18</a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
