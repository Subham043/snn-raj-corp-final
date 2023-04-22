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

@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img src="{{ $banner->image_link}}" alt="" class="img-fluid"></figure>
                        <div class="caption">
                            <div class="section-title">{!!$banner->heading!!}</div>
                            <p>{{$banner->description}}</p>
                            <a href="{{$banner->button_link}}" class="button-light">{{$banner->button_text}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- About -->
    @if($about)
    <section class="lets-talk">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                        @if(!$about->image)
                            <div class="sub-title border-bot-light">About Us</div>
                        @endif
                        @if($about->image)
                        <div class="con">
                            <img src="{{$about->image_link}}" class="img-fluid" alt="">
                        </div>
                        @endif
                    </div>
                    <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                        @if($about->image)
                            <div class="sub-title border-bot-light">About Us</div>
                        @endif
                        <div class="section-title">{!!$about->heading!!}</div>
                        {!!$about->description!!}

                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Management -->
    @if(count($management)>0)
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                @if($managementHeading)
                    <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$managementHeading->sub_heading}}</div>
                    </div>
                    <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                        <div class="section-title">{!!$managementHeading->heading!!}</div>
                    </div>
                @endif
            </div>
            <div class="row mt-4">
                @foreach($management as $key=>$val)
                    @if($key==0)
                        <div class="col-md-6 animate-box" data-animate-effect="fadeInUp">
                            {!!$val->description!!}
                        </div>
                        <div class="col-md-6 animate-box" data-animate-effect="fadeInUp">
                            <div class="wrap">
                                <div class="con"> <img src="{{$val->image_link}}" class="img-fluid" alt="">
                                    <div class="info">
                                        <h4 class="name">{{$val->name}}</h4>
                                    </div>
                                </div>
                                <p>{{$val->designation}}</p>
                            </div>
                        </div>
                    @else
                        <div class="col-md-3 animate-box text-center mt-3" data-animate-effect="fadeInUp">
                            <div class="wrap">
                                <div class="con"> <img src="{{$val->image_link}}" class="img-fluid" alt="">
                                    <div class="info">
                                    </div>
                                </div>
                                <h4 class="name">{{$val->name}}</h4>
                                <p>{{$val->designation}}</p>
                            </div>
                        </div>
                        <div class="col-md-3 animate-box mt-3" data-animate-effect="fadeInUp">
                            {!!$val->description!!}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Vision -->
    @if($banner)
    <section class="lets-talk">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">Our Vision</div>
                        <div class="section-title">{!!$banner->vission!!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Staff -->
    @if(count($staffs)>0)
    <section class="team section-padding">
        <div class="container">
            <div class="row mb-4">
                @if($staffHeading)
                    <div class="col-md-4">
                        <div class="sub-title border-bot-light">{{$staffHeading->sub_heading}}</div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title">{!!$staffHeading->heading!!}</div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 owl-carousel owl-theme">
                    @foreach($staffs as $staffs)
                    <div class="wrap">
                        <div class="con"> <img src="{{$staffs->image_link}}" class="img-fluid" alt="">
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
    <section class="lets-talk">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 animate-box" data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">Our Mission</div>
                        <div class="section-title">{!!$banner->mission!!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- AWARDS -->
    {{-- <section class="section-padding">
        <div class="container">
            <div class="row mb-5 animate-box" data-animate-effect="fadeInUp">
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
    <section class="process section-padding">
        <div class="container">
            @foreach($additionalContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row">
                        <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                            <div class="img">
                                <img src="{{$val->image_link}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 valign animate-box" data-animate-effect="fadeInRight">
                            <div class="wrap">
                                <div class="number">
                                    <h1>{!!$val->heading!!}</h1>
                                </div>
                                <div class="cont">
                                    {!!$val->description!!}
                                    <a href="{{$val->button_link}}" class="button-light">{{$val->button_text}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-6 order2 valign animate-box" data-animate-effect="fadeInLeft">
                            <div class="wrap">
                                <div class="number">
                                    <h1>{!!$val->heading!!}</h1>
                                </div>
                                <div class="cont">
                                    {!!$val->description!!}
                                    <a href="{{$val->button_link}}" class="button-light">{{$val->button_text}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order1 animate-box" data-animate-effect="fadeInRight">
                            <div class="img">
                                <img src="{{$val->image_link}}" alt="">
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    @endif

    <!-- Partner -->
    @if(count($partners)>0)
    <section class="partner section-padding">
        <div class="container">
            <div class="row mb-4">
                @if($partnerHeading)
                    <div class="col-md-4">
                        <div class="sub-title border-bot-light">{{$partnerHeading->sub_heading}}</div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title">{!!$partnerHeading->heading!!}</div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 owl-carousel owl-theme">
                    @foreach($partners as $partners)
                    <div class="wrap">
                        <div class="con">
                            <img src="{{$partners->image_link}}" class="img-fluid" alt="{{$partners->image_alt}}" title="{{$partners->image_title}}">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    @include('main.includes.common_contact')

@stop
