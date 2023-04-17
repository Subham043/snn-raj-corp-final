@extends('main.layouts.index')

@section('content')

    <!-- Slider -->
    <header id="slider-area" class="header slider-fade">
        <div class="owl-carousel owl-theme">
            <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
            <div class="text-left item bg-img" data-overlay-dark="4" data-background="{{ asset('assets/images/slider/1.jpg')}}">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Project P.01</h4>
                                <h1>Ultra-Modern House Design</h1>
                                <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artine aringianu the miss finibus viverra lacus fermen.</p>
                                <a href="project-page.html" class="button-light">View Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-left item bg-img" data-overlay-dark="3" data-background="{{ asset('assets/images/slider/2.jpg')}}">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Project P.02</h4>
                                <h1>Ultra-Luxurious Villa</h1>
                                <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artine aringianu the miss finibus viverra lacus fermen.</p>
                                <a href="project-page.html" class="button-light">View Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-left item bg-img" data-overlay-dark="4" data-background="{{ asset('assets/images/slider/3.jpg')}}">
                <div class="v-middle caption">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Project P.03</h4>
                                <h1>Modernity In The Nature</h1>
                                <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artine aringianu the miss finibus viverra lacus fermen.</p>
                                <a href="project-page.html" class="button-light">View Project</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="slide-num" id="snh-1"></div>
        <div class="slider__progress"><span></span></div>
    </header>
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-30 animate-box" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Who are we?</div>
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title"><span>About</span> ArchSan</div>
                    <p>Architecture viverra tristique justo duis vitae diaminte neque nivamus aestan ateuene artines aringianu the ateliten finibus viverra nec in the nedana. Design nila iman the finise viverra nec a lacus themo the seneoice misuscipit drana miss non sagie the fermen.</p>
                    <p>Planner inilla duiman at elit finibus viverra a lacus themo the drudea seneoice misuscipit nonie the fermen miverration tristique jusio the ivite dianne onen nivami acsestion augue artine.</p><br>
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="about-box">
                                <img src="{{ asset('assets/images/icon-1.png')}}" class="icon" alt="">
                                <h5>Architecture</h5>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="about-box">
                                <img src="{{ asset('assets/images/icon-2.png')}}" class="icon" alt="">
                                <h5>Interior</h5>
                            </div>
                        </div>
                        <div class="col col-md-4">
                            <div class="about-box">
                                <img src="{{ asset('assets/images/icon-3.png')}}" class="icon" alt="">
                                <h5>Planing</h5>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
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
                                <div class="item"> <span class="quote"><img src="{{ asset('assets/images/quot.png')}}" alt=""></span>
                                    <p>Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu the ateliten finibus viverra nec lacus. Nedana theme erodino setlie suscipe no curabit tristique. Design nila iman the finise viverra nec a lacus themo the seneoice misuscipit non sagie the fermen.</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="{{ asset('assets/images/team/1.jpg')}}" alt=""> </div>
                                        <div class="cont">
                                            <h6>Jason Brown</h6> <span>Crowne Plaza Owner</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item"> <span class="quote">
                                        <img src="{{ asset('assets/images/quot.png')}}" alt="">
                                    </span>
                                    <p>Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu the ateliten finibus viverra nec lacus. Nedana theme erodino setlie suscipe no curabit tristique. Design nila iman the finise viverra nec a lacus themo the seneoice misuscipit non sagie the fermen.</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="{{ asset('assets/images/team/2.jpg')}}" alt=""> </div>
                                        <div class="cont">
                                            <h6>Emily White</h6> <span>Armada Owner</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item"> <span class="quote">
                                        <img src="{{ asset('assets/images/quot.png')}}" alt="">
                                    </span>
                                    <p>Architecture viverra tristique justo duis vitae diam neque nivamus aestan ateuene artines aringianu the ateliten finibus viverra nec lacus. Nedana theme erodino setlie suscipe no curabit tristique. Design nila iman the finise viverra nec a lacus themo the seneoice misuscipit non sagie the fermen.</p>
                                    <div class="info">
                                        <div class="author-img"> <img src="{{ asset('assets/images/team/4.jpg')}}" alt=""> </div>
                                        <div class="cont">
                                            <h6>Jesica Smith</h6> <span>Alsa Manager</span>
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
