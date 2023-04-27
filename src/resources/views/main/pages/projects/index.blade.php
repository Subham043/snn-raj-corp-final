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
    <section class="projects3 section-padding">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">Our Creations</div>
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title">{{$status=='completed' ? 'COMPLETED PROJECTS' : 'ONGOING PROJECTS'}}</div>
                </div>
            </div>
            @if($projects->total() > 0)
            <div class="row">
                <div class="col-md-12">
                    @foreach ($projects->items() as $k => $v)
                        @if(($k+1)%2!=0)
                            <div class="row">
                                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                                    @if($v->banner_count>0)
                                        <div class="img">
                                            <a href="{{route($status=='completed' ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img src="{{$v->banner[0]->image_link}}" alt=""></a>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-4 valign animate-box" data-animate-effect="fadeInUp">
                                    <div class="content">
                                        <div class="cont">
                                            <h3>{{$v->name}}</h3>
                                            <p>{{$v->brief_description}}</p>
                                            <div class="more"><a href="{{route($status=='completed' ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn" tabindex="0">View Project</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row mt-120">
                                <div class="col-md-4 order2 valign animate-box" data-animate-effect="fadeInUp">
                                    <div class="content">
                                        <div class="cont">
                                            <h3>{{$v->name}}</h3>
                                            <p>{{$v->brief_description}}</p>
                                            <div class="more"><a href="{{route($status=='completed' ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn" tabindex="0">View Project</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8 order1 animate-box" data-animate-effect="fadeInUp">
                                    @if($v->banner_count>0)
                                        <div class="img">
                                            <a href="{{route($status=='completed' ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img src="{{$v->banner[0]->image_link}}" alt=""></a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="mt-5">
                        {{$projects->onEachSide(5)->links('main.includes.pagination')}}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>

    @include('main.includes.common_contact')

@stop
