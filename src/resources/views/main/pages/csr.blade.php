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
        .process .wrap{
            padding: 0;
        }
        .process .wrap, .process .wrap .cont{
            display: inline;
        }
        .about_banner_img {
            border: 1px solid #1c1919;
            padding: 5px;
            border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;
            height: 450px;
            object-fit: cover;
        }
    </style>
@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding py-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img fetchpriority="high" src="{{ $banner->image_link}}" alt="" class="img-fluid about_banner_img"></figure>
                        <div class="caption">
                            <div class="section-title">{!!$banner->heading!!}</div>
                            <div class="desc-ul">
                                {!!$banner->description!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <h1 class="d-none">{{$seo->page_keywords}}</h1>
    <h2 class="d-none">{{$seo->page_keywords}}</h2>

    <!-- ADDITIONAL CONTENT -->
    @if(count($mainContent)>0)
            @foreach($mainContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <section @class([
                        "process",
                        "suffix-div",
                        "mt-0" => $key==0,
                        "py-5" => $key!=0
                    ])>
                        <div class="container">
                            <div class="row div-padding">
                                <div class="col-md-12 " data-animate-effect="fadeInRight">
                                    <div class="img fl-img">
                                        <img fetchpriority="low" src="{{$val->image_link}}" alt="">
                                    </div>
                                    <div class="wrap">
                                        <div class="number">
                                            <div class="section-title">{!!$val->heading!!}</div>
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
                <section class="process section-padding mb-0 mt-0">
                    <div class="container">
                        <div class="row div-padding">
                            <div class="col-md-12 order2 " data-animate-effect="fadeInLeft">
                                <div class="img fr-img">
                                    <img fetchpriority="low" src="{{$val->image_link}}" alt="">
                                </div>
                                <div class="wrap">
                                    <div class="number">
                                        <div class="section-title">{!!$val->heading!!}</div>
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

    @include('main.includes.common_contact_modal')
    <button type="button" class="popup_btn_modal"  data-bs-toggle="modal" data-bs-target="#contactModal">
        <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <path d="m94.81 30.42a37.86 37.86 0 0 0 -10.26-11.77c-8.88-6.87-20.67-10.65-33.17-10.65s-24.3 3.78-33.18 10.65a37.81 37.81 0 0 0 -10.2 11.77 30.16 30.16 0 0 0 -3.87 14.64c0 9.27 4.42 18.15 12.25 24.93l-4.76 19.69a3 3 0 0 0 2.88 3.82 3 3 0 0 0 1.5-.42l22-13-.53.42a71.38 71.38 0 0 0 13.88 1.62c12.5 0 24.29-3.79 33.17-10.65a38 38 0 0 0 10.29-11.77 30 30 0 0 0 0-29.28zm-43.43 46.75a61.07 61.07 0 0 1 -15.07-2.45l-16.86 9.37 3.35-15.36c-8.71-6.08-13.7-14.73-13.7-23.67 0-17.71 18.96-32.06 42.28-32.06s42.27 14.4 42.27 32.11-18.96 32.06-42.27 32.06z" stroke-miterlimit="10"></path>
        </svg>
    </button>

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')
@stop
