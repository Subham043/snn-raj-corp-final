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

    <!-- Blogs -->
    <section class="blog-home section-padding">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Blogs</div>
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <div class="section-title">LATEST NEWS</div>
                </div>
            </div>
            @if($blogs->total() > 0)
                <div class="row">
                    @foreach ($blogs->items() as $k => $v)
                        <div class="col-md-4 div-padding">
                            <div class="item mb-5">
                                <div class="post-img">
                                    <a href="{{route('blogs_detail.get', $v->slug)}}"><div class="img"> <img src="{{$v->image_link}}" alt=""> </div></a>
                                </div>
                                <div class="cont">
                                    <h4><a href="{{route('blogs_detail.get', $v->slug)}}">{{$v->name}}</a></h4>
                                    <div class="date"><a href="{{route('blogs_detail.get', $v->slug)}}"><span class="ti-time"></span>&nbsp;&nbsp;<span>{{$v->created_at->diffForHumans()}}</span></a> </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-5">
                        {{$blogs->onEachSide(5)->links('main.includes.pagination')}}
                    </div>
                </div>
            @endif
        </div>
    </section>

    @include('main.includes.common_contact')

@stop