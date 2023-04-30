@extends('main.layouts.index')

@section('css')

    <title>{{$data->page_name}}</title>

    <meta property="og:locale" content="en_US" />
	<meta property="og:type" content="profile" />
	<meta property="og:title" content="{{$data->page_name}}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{{$data->page_name}}" />
	<meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:label1" content="{{$data->page_name}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

@stop

@section('content')

    <!-- Legal -->
    <section class="hero section-padding">
        <div class="background bg-img bg-fixed section-padding" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$data->page_name}}</div>
                        <div class="section-title">{!!$data->heading!!}</div>
                        {!!$data->description!!}

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')

@stop
