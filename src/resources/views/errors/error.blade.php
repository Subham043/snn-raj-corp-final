@extends('main.layouts.index')

@section('content')

    <!-- 404 Section  -->
    <section class="notfound section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="number " data-animate-effect="fadeInUp">{{$status_code}}</div>
                    <div class="title " data-animate-effect="fadeInUp">{{$message}}!</div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')
@stop
