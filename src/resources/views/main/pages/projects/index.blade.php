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
        .no-dot.sub-title:before {
            content: none;
        }
        .project_old .projects2-wrap h3 {
            font-size: 25px;
        }
        .project_old p {
            font-size: 12px;
            color: black;
        }

        .project_old p img {
            height: 20px;
            display: inline;
            width: 20px;
            margin-top: -5px;
        }
        .projects2-con{
            position: static;
            height: auto;
            background-image: none;
        }
        .projects2-wrap h3 a{
            color: var(--theme-primary-color);
        }
        .project2-link:before{
            background: var(--theme-primary-color);
        }
        .projects2-wrap {
            padding-bottom: 30px;
        }
        .font-weight-normal{
            font-weight: normal;
        }
        .sub-title:after{
            width: 100%;
            left: 0;
        }

        .projects3 .content{
            padding: 0 !important;
        }

        .projects3 .content .cont h3{
            margin-bottom: 10px;
        }

        .section-padding, .div-padding {
            padding-top: 0px;
        }

        .projects3 .img {
            border-radius: 5px;
        }

        .projects3 .img img{
            height: 350px;
            object-fit: cover;
        }

        @media screen and (max-width:600px){
            .projects3 .content{
                margin-bottom: 0 !important;
            }

            .justify-content-end{
                justify-content: unset !important;
            }
        }
    </style>
@stop

@section('content')

    <h1 class="d-none">{{$seo->page_keywords}}</h1>
    <h2 class="d-none">{{$seo->page_keywords}}</h2>

    <section class="lets-talk hero hero-contact py-2 mt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="section-title font-weight-normal mb-md-0 mt-md-0 text-center mb-0">{{$status=='completed' ? 'COMPLETED PROJECTS' : 'ONGOING PROJECTS'}}</div>
                </div>
            </div>
        </div>
    </section>

    @if(count($projects) > 0)

    @foreach($projects as $k => $v)
        @if(($k+1)%2!=0)
        <section class="projects3 py-6">
            <div class="container">
                <div class="row div-padding pb-md-0">
                    <div class="col-md-6 " data-animate-effect="fadeInUp">
                        @if($v->banner_count>0)
                            <div class="img">
                                <a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}">
                                    {{-- @if($k==0) --}}
                                    <img fetchpriority="high" loading="eager" src="{{$v->banner[0]->image_link}}" alt="{{$v->name}}" title="{{$v->name}}">
                                    {{-- @else
                                    <img fetchpriority="high" data-src="{{$v->banner[0]->image_link}}" class="lazyload" alt="{{$v->name}}" title="{{$v->name}}">
                                    @endif --}}
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 valign " data-animate-effect="fadeInUp">
                        <div class="content">
                            <div class="cont">
                                <a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="mx-0" tabindex="0"><h3>{{$v->name}}</h3></a>
                                <p>{{ Str::limit($v->brief_description, 300) }}</p>
                                <div class="more"><a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn" tabindex="0">Explore The Project</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @else

        <section class="projects3 suffix-div mt-md-0 py-6">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 order2 valign " data-animate-effect="fadeInUp">
                        <div class="content">
                            <div class="cont">
                                <a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="mx-0" tabindex="0"><h3>{{$v->name}}</h3></a>
                                <p>{{$v->brief_description}}</p>
                                <div class="more"><a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}" class="link-btn mx-0" tabindex="0">Explore The Project</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 order1 " data-animate-effect="fadeInUp">
                        @if($v->banner_count>0)
                            <div class="img">
                                <a aria-label="{{$v->name}}" href="{{route($v->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $v->slug)}}"><img fetchpriority="low" data-src="{{$v->banner[0]->image_link}}" class="lazyload" alt="{{$v->name}}" title="{{$v->name}}"></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
    @endforeach

    @endif


@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    <script type='text/javascript' nonce="{{ csp_nonce() }}">
        (function () {
        var p5 = document.createElement('script');
        p5.type = 'text/javascript';
        p5.src = 'https://src.plumb5.com/snnrajcorp_com.js';
        var p5s = document.getElementsByTagName('script')[0];
        p5s.parentNode.insertBefore(p5, p5s);
        })();
    </script>

@stop
