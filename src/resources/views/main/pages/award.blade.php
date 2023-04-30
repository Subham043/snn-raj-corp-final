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
        .pagination-wrap{
            position: relative;z-index:10;pointer-events:all;
        }
    </style>
@stop

@section('content')

    <!-- Awards -->
    <section class="services section-padding">
        <div class="container">
            <div class="row mb-4">
                @if($awardHeading)
                    <div class="col-md-4 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$awardHeading->sub_heading}}</div>
                    </div>
                    <div class="col-md-8 " data-animate-effect="fadeInUp">
                        <div class="section-title">{!!$awardHeading->heading!!}</div>
                    </div>
                @endif
            </div>
            @if($awards->total() > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($awards->items() as $item)
                        <div class="col-md-4 div-padding " data-animate-effect="fadeInUp">
                            <div class="item">
                                <div class="con">
                                    <div class="numb">{{$item->year}}</div>
                                    <div class="con">
                                        <img src="{{$item->image_link}}" class="img-fluid mb-3" alt="">
                                    </div>
                                    <h5>{{$item->title}}</h5>
                                    <h6>{{$item->sub_title}}</h6>
                                    <p>{{$item->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{$awards->onEachSide(5)->links('main.includes.pagination')}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    @include('main.includes.common_contact')

@stop
