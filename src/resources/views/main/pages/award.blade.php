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

    @if (count($awards) > 0)
        <link rel="preload" as="image" href="{{ $awards[0]->image_link }}" type="image/webp">
    @endif

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

        .services .item{
            min-height: 496px;
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
                        @foreach ($awards as $key => $item)
                        <div class="col-md-4 " data-animate-effect="fadeInUp">
                            <div class="item">
                                <div class="con">
                                    <div class="numb">{{$item->year}}</div>
                                    <div class="con">
                                        @if($key==0)
                                        <img src="{{$item->image_link}}" class="img-fluid award-img mb-3" alt="" width="255" height="255">
                                        @else
                                        <img data-src="{{$item->image_link}}" class="img-fluid award-img mb-3 lazyload" alt="" width="255" height="255">
                                        @endif
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
    <button type="button" class="popup_btn_modal" aria-label="Enquiry Popup" data-bs-toggle="modal" data-bs-target="#contactModal">
        <img data-src="{{asset('smartphone.svg')}}" alt="Enquiry Popup" class="lazyload" style="height: 35px; width:35px;" />
    </button>
@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    @include('main.includes.common_contact_modal_script')
@stop
