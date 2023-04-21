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

    <link rel="icon" href="{{ asset('assets/images/favicon.png')}}" sizes="32x32" />
    <link rel="icon" href="{{ asset('assets/images/favicon.png')}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/favicon.png')}}" />

    {!!$seo->meta_header_script!!}
    {!!$seo->meta_header_no_script!!}

    <style nonce="{{ csp_nonce() }}">
        .fl-img{
            float: left;
            width: 50%;
            margin-right: 20px;
        }
        .fr-img{
            float: right;
            width: 50%;
            margin-left: 20px;
        }
        .process .wrap{
            padding: 0;
        }
        .process .wrap, .process .wrap .cont{
            display: inline;
        }
        .section-padding{
            padding-bottom: 30px;
        }
    </style>
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
                            {!!$banner->description!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ADDITIONAL CONTENT -->
    @if(count($mainContent)>0)
    <section class="process section-padding">
        <div class="container">
            @foreach($mainContent as $key=>$val)
                @if(($key+1)%2!=0)
                    <div class="row section-padding">
                        <div class="col-md-12 animate-box" data-animate-effect="fadeInRight">
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
                    <div class="row section-padding">
                        <div class="col-md-12 order2 animate-box" data-animate-effect="fadeInLeft">
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

    @include('main.includes.common_contact')

@stop
