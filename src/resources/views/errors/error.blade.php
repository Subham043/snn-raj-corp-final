@extends('main.layouts.index')

@section('content')

    <!-- 404 Section  -->
    <section class="notfound section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="number animate-box" data-animate-effect="fadeInUp">{{$exception->getStatusCode()}}</div>
                    <div class="title animate-box" data-animate-effect="fadeInUp">{{$exception->getMessage()}}!</div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')
@stop