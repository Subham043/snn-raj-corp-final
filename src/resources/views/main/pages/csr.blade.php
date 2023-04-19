@extends('main.layouts.index')

@section('css')
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
