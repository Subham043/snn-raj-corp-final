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
    </style>
@stop

@section('content')

    @if($banner)
    <!-- Hero -->
    <section class="hero hero-main section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="hero">
                        <figure><img src="{{ $banner->image_link}}" alt="" class="img-fluid"></figure>
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
                                        <img src="{{$val->image_link}}" alt="">
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
                                    <img src="{{$val->image_link}}" alt="">
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

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
