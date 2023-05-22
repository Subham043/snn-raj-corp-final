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
    @if($projectHeading)
    <section class="projects3 pt-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">{{$projectHeading->sub_heading}}</div>
                </div>
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <div class="section-title">{!!$projectHeading->heading!!}</div>
                    <p>{!!$projectHeading->description!!}</p>
                </div>
            </div>
        </div>
    </section>
    @endif
    @if(count($projects) > 0)
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 px-0">
                @foreach ($projects as $k => $v)
                    @if(($k+1)%2!=0)
                    <section class="projects3">
                        <div class="container">
                            <div class="row div-padding">
                                <div class="col-md-8 " data-animate-effect="fadeInUp">
                                    @if($v->banner_count>0)
                                        <div class="img">
                                            <a href="{{route($v->is_completed ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img fetchpriority="high" src="{{$v->banner[0]->image_link}}" alt=""></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 valign " data-animate-effect="fadeInUp">
                                    <div class="content">
                                        <div class="cont">
                                            <h3>{{$v->name}}</h3>
                                            <p>{{ Str::limit($v->brief_description, 300) }}</p>
                                            <div class="more"><a href="{{route($v->is_completed ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn" tabindex="0">View Project</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    @else

                    <section class="projects3 suffix-div">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 order2 valign " data-animate-effect="fadeInUp">
                                    <div class="content">
                                        <div class="cont">
                                            <h3>{{$v->name}}</h3>
                                            <p>{{$v->brief_description}}</p>
                                            <div class="more"><a href="{{route($v->is_completed ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn" tabindex="0">View Project</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 order1 " data-animate-effect="fadeInUp">
                                    @if($v->banner_count>0)
                                        <div class="img">
                                            <a href="{{route($v->is_completed ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img fetchpriority="high" src="{{$v->banner[0]->image_link}}" alt=""></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </section>

                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
