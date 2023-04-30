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

<!-- Post  -->
<section class="post section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-animate-effect="fadeInUp">
                <img src="{{$data->image_link}}" class="img-responsive mb-5" alt="">
                <div class="date"> <span class="ti-time"></span> {{$data->created_at->diffForHumans()}}</div>
                <h2>{!!$data->heading!!}</h2>
                <div class="desc-ul">
                    {!!$data->description!!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prev-Next -->
<div class="prev-next">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    @if($next)
                    <div class="prev-next-left">
                        <a href="{{route('blogs_detail.get', $next->slug)}}"> <i class="ti-arrow-left"></i> {{$next->name}}</a>
                    </div>
                    @endif
                    <a href="{{route('blogs.get')}}"><i class="ti-layout-grid3-alt"></i></a>
                    @if($prev)
                    <div class="prev-next-right">
                        <a href="{{route('blogs_detail.get', $prev->slug)}}"> {{$prev->name}} <i class="ti-arrow-right"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    @include('main.includes.common_contact')

@stop
