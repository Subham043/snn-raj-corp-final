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

    @if($banner)
    <link rel="preload" fetchpriority="high" href="{{$banner->image_link}}" as="image" type="image/webp">
    @endif

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
            height: 570px;
            object-fit: cover;
        }

        .div-padding {
            padding-top: 0px !important;
        }

        .process p {
            margin-bottom: 3px;
        }

        @media screen and (max-width:600px){
            .process.suffix-div {
                padding-bottom: 2rem !important;
            }

            .hero-main {
                padding-top: 2rem !important;
                padding-bottom: 1rem !important;
            }

            .about_banner_img {
                height: auto;
                object-fit: contain;
            }
        }
    </style>
@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img fetchpriority="high" loading="eager" src="{{ $banner->image_link}}" alt="" class="img-fluid about_banner_img" width="583" height="450"></figure>
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
                        "py-6",
                        "mt-0"
                    ])>
                        <div class="container">
                            <div class="row div-padding">
                                <div class="col-md-12 " data-animate-effect="fadeInRight">
                                    <div class="img fl-img">
                                        <img fetchpriority="low" data-src="{{$val->image_link}}" title="{!!$val->heading!!}" alt="{!!$val->heading!!}" class="lazyload" alt="" width="583" height="296">
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
                <section class="process mb-0 mt-0 py-6">
                    <div class="container">
                        <div class="row div-padding">
                            <div class="col-md-12 order2 " data-animate-effect="fadeInLeft">
                                <div class="img fr-img">
                                    <img fetchpriority="low" data-src="{{$val->image_link}}" class="lazyload" alt="">
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

    <div id="callback-popup-trigger"></div>

    @include('main.includes.common_contact_modal')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')
@stop
