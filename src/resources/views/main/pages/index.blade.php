@extends('main.layouts.index')

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
                <div class="col-md-6 single-item ongoing">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/06.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.01</p>
                            <h3><a href="project-page.html">Modern Houses</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 single-item completed">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/02.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.02</p>
                            <h3><a href="project-page.html">Luxurious Villa</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 single-item ongoing">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/03.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.03</p>
                            <h3><a href="project-page.html">Ultra BlackHome</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 single-item ongoing">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/04.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.04</p>
                            <h3><a href="project-page.html">Modern Bedrooom</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 single-item completed">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/01.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.05</p>
                            <h3><a href="project-page.html">Mountain House</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 single-item completed">
                    <div class="projects2-wrap">
                        <a href="project-page.html"><img src="{{ asset('assets/images/projects/05.jpg')}}" alt=""></a>
                        <div class="projects2-con">
                            <p>Project P.06</p>
                            <h3><a href="project-page.html">Modern Food Table</a></h3>
                            <a href="project-page.html" class="project2-link"></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Testiominals -->
    @if(count($testimonials)>0)
    <section class="testimonials">
        <div class="background bg-img bg-fixed section-padding" data-background="{{ asset('assets/images/slider/a.jpg')}}" data-overlay-dark="6">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-30">
                        <h3 class="sub-title border-bot-dark">Testiominals</h3>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title">What Client's Say?</div>
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
