@extends('main.layouts.index')

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
                    <div class="row">
                        <div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
                            <div class="img">
                                <img src="{{$val->image_link}}" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 valign animate-box" data-animate-effect="fadeInRight">
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
                    <div class="row">
                        <div class="col-md-6 order2 valign animate-box" data-animate-effect="fadeInLeft">
                            <div class="wrap">
                                <div class="number">
                                    <h1>{!!$val->heading!!}</h1>
                                </div>
                                <div class="cont">
                                    {!!$val->description!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 order1 animate-box" data-animate-effect="fadeInRight">
                            <div class="img">
                                <img src="{{$val->image_link}}" alt="">
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
