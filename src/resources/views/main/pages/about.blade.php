@extends('main.layouts.index')

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
                <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Management</div>
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title">Our Established <span>Team</span></div>
                </div>
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
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">Creative Thinkers</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Core <span>Members</span></div>
                    <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artines ariianu the ateliten finibus viverra nec lacus in the nedana mis erodino.</p>
                </div>
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

    @include('main.includes.common_contact')

@stop
