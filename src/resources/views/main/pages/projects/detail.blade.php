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
    </style>

@stop

@section('content')

@if($data->use_in_banner)
    <section class="project-page video-project-page">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <header class="p-relative header-video-container">
                        <iframe src="{{$data->video}}?autoplay=1&mute=1&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video" width="560" height="315" frameborder="0"></iframe>
                    </header>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="project-bar">
                                <div class="row project-detail-row justify-content-between align-items-center text-left text-lg-start">
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Floor</h5>
                                        <h6>{{$data->floor}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Tower</h5>
                                        <h6>{{$data->tower}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Acre</h5>
                                        <h6>{{$data->acre}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Location</h5>
                                        <h6>{{$data->location}}</h6>
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
    <section class="project-page">
        <div class="container-fluid">
        <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @if($data->banner_count>0)
                            @foreach($data->banner as $banner)
                                <div class="portfolio-item"> <img class="img-fluid" src="{{$banner->image_link}}" alt="{{$banner->image_alt}}" title="{{$banner->image_title}}"> </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="project-bar">
                                <div class="row project-detail-row justify-content-between align-items-center text-left text-lg-start">
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Floor</h5>
                                        <h6>{{$data->floor}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Tower</h5>
                                        <h6>{{$data->tower}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Acre</h5>
                                        <h6>{{$data->acre}}</h6>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-15">
                                        <h5>Location</h5>
                                        <h6>{{$data->location}}</h6>
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

<section class="section-padding pt-sm-0">
    <div class="container">
        <div class="row">

            <!-- Accomodation -->
            @if($data->accomodation_count>0)
                <div class="about mb-5">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>{{$data->name}}</h2>
                            <h5><span class="text-white">RERA :</span> {{$data->rera}}</h5>
                            <p>{{$data->brief_description}}</p><br>
                       </div>
                       <div class="col-md-12">
                            {!!$data->description!!}
                        </div>
                    </div>
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <div class="states">
                            <ul class="d-flex gap-2 align-items-center justify-content-between p-0 flex-wrap">
                                @foreach($data->accomodation as $accomodation)
                                <li class="">
                                    <div class="numb valign">
                                        <h2 class="mb-1">{{$accomodation->room}}</h2>
                                    </div>
                                    <div class="text valign ml-1">
                                        <p>
                                            {!!$accomodation->area!!}
                                        </p>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@if($data->plan_count>0)
    <section class="project-page section-padding">
        <div class="container">
            <div class="row">
                <div class="row mb-5 " data-animate-effect="fadeInUp">
                    <div class="col-md-12">
                        <div class="section-title text-center"><span>Floor</span> Plans</div>
                    </div>
                </div>
            </div>
            <!-- project slider -->
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme">
                        @if($data->plan_count>0)
                            @foreach($data->plan as $plan)
                                <div class="portfolio-item"> <img class="img-fluid" src="{{$plan->image_link}}" alt="{{$plan->image_alt}}" title="{{$plan->image_title}}"> </div>
                            @endforeach
                        @endif
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
                <div class="col-md-12 mb-30 " data-animate-effect="fadeInUp">
                    <div class="section-title text-center"><span>Worldclass</span> Amenities</div>
                </div>
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="row amenity-row">
                        @foreach($data->amenity as $amenity)
                            <div class="col-md-3 col-sm-6">
                                <div class="about-box">
                                    <img src="{{$amenity->image_link}}" class="icon" alt="">
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

<!-- Image Gallery -->
@if($data->gallery_image_count>0)
    <section class="section-padding">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">Images</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title"><span>Image</span> Gallery</div>
                </div>
            </div>
            <div class="row">
                @foreach($data->gallery_image as $gallery_image)
                    <div class="col-md-4 gallery-item " data-animate-effect="fadeInUp">
                        <a href="{{$gallery_image->image_link}}" title="{{$gallery_image->title}}" class="img-zoom">
                            <div class="gallery-box">
                                <div class="gallery-img"> <img src="{{$gallery_image->image_link}}" class="img-fluid mx-auto d-block" alt="{{$gallery_image->alt}}" title="{{$gallery_image->title}}"> </div>
                                <div class="gallery-detail text-center"> <i class="ti-fullscreen"></i> </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!--  Video Gallery -->
@if($data->gallery_video_count>0)
    <section class="section-padding">
        <div class="container">
        <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">Videos</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title"><span>Video</span> Gallery</div>
                </div>
            </div>
            <div class="row">
                <!-- 2 columns -->
                @foreach($data->gallery_video as $gallery_video)
                    <div class="col-md-6 " data-animate-effect="fadeInUp">
                        <div class="vid-area mb-30">
                            <div class="vid-icon"> <img src="https://i3.ytimg.com/vi/{{$gallery_video->video_id}}/maxresdefault.jpg" alt="YouTube">
                                <a class="video-gallery-button vid" href="https://youtu.be/{{$gallery_video->video_id}}"> <span class="video-gallery-polygon">
                                        <i class="ti-control-play"></i>
                                    </span> </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if($data->additional_content_count>0)
    <section class="section-padding">
        <div class="container">
            @foreach($data->additional_content as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row div-padding">
                        <div class="col-md-12 " data-animate-effect="fadeInRight">
                            <div class="img fl-img">
                                <img src="{{$val->image_link}}" alt="">
                            </div>
                            <div class="wrap">
                                <div class="number">
                                    <h1>{!!$val->heading!!}</h1>
                                </div>
                                <div class="cont">
                                    {!!$val->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row div-padding">
                        <div class="col-md-12 order2 " data-animate-effect="fadeInLeft">
                            <div class="img fr-img">
                                <img src="{{$val->image_link}}" alt="">
                            </div>
                            <div class="wrap">
                                <div class="number">
                                    <h1>{!!$val->heading!!}</h1>
                                </div>
                                <div class="cont">
                                    {!!$val->description!!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endif

@if(!$data->use_in_banner)
    <section class="about section-padding">
        <div class="container">
            <header class="p-relative header-video2-container">
                <iframe src="{{$data->video}}?autoplay=0&mute=0&fs=0&loop=1&rel=0&showinfo=0&iv_load_policy=3&modestbranding=0&controls=1&enablejsapi=1" class="header-video2" width="560" height="315" frameborder="0"></iframe>
            </header>
        </div>
    </section>
@endif

<section class="lets-talk">
    <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">An address to be proud of</div>
                    <div class="section-title">{!!$data->address!!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

    @include('main.includes.common_contact')

@stop