@extends('main.layouts.index')

@section('css')
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
                <div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
                    <div class="sub-title border-bot-light">AWARDS & RECOGNITION</div>
                </div>
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <div class="section-title"><span>Our</span> Achievements</div>
                    <p>Our creations have won accolades (and hearts).</p>
                </div>
            </div>
            @if($awards->total() > 0)
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($awards->items() as $item)
                        <div class="col-md-4 mb-5 animate-box" data-animate-effect="fadeInUp">
                            <div class="item">
                                <div class="con">
                                    <div class="numb">{{$item->year}}</div>
                                    <div class="con">
                                        <img src="{{$item->image_link}}" class="img-fluid" alt="">
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
