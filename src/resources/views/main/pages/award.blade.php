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
        .font-weight-bold{
            font-weight: 700;
        }
        .award-img{
            object-fit: contain;
            width: auto;
        }
        .sub-title:after{
            width: 100%;
            left: 0;
        }
        .sub-title {
            font-size: 30px;
        }
        .section-title {
            font-size: 20px;
        }
    </style>
@stop

@section('content')

    <!-- Awards -->
    <section class="services section-padding pt-3">
        <div class="container">
            <div class="row mb-4 align-items-end">
                @if($awardHeading)
                    <div class="col-md-4 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$awardHeading->sub_heading}}</div>
                    </div>
                    <div class="col-md-8 " data-animate-effect="fadeInUp">
                        <div class="section-title">{!!$awardHeading->heading!!}</div>
                        <p>{!!$awardHeading->description!!}</p>
                    </div>
                @endif
            </div>

            <h1 class="d-none">{{$seo->page_keywords}}</h1>
            <h2 class="d-none">{{$seo->page_keywords}}</h2>

            @if(count($awards) > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($awards as $item)
                        <div class="col-md-4 " data-animate-effect="fadeInUp">
                            <div class="item">
                                <div class="con">
                                    <div class="numb">{{$item->year}}</div>
                                    <div class="con">
                                        <img src="{{$item->image_link}}" class="img-fluid award-img mb-3" alt="">
                                    </div>
                                    <h5 class="font-weight-bold">{!!$item->title!!}</h5>
                                    <h6>{{$item->sub_title}}</h6>
                                    <p>{{$item->description}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
    <div class="py-1"></div>

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
