@extends('admin.layouts.dashboard')

@section('css')

<style nonce="{{ csp_nonce() }}">
    .no-box-shadow{
        box-shadow: none;
    }
</style>

@stop


@section('content')

<div class="page-content">
    <div class="container-fluid">

        @include('admin.includes.breadcrumb', ['page'=>'Dashboard', 'page_link'=>route('dashboard.get'), 'list'=>['SNN RAJ CORP']])

        <div class="row project-wrapper">
            <div class="col-xxl-12">
                @can('view application analytics on dashboard')
                    <div class="row">

                        @if (count($health?->storedCheckResults ?? []))

                            <div class="col-xl-12">
                                <div class="card card-height-100">
                                    <div class="card-header align-items-center border-0 d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Application Health Analytics</h4>
                                        <div class="flex-shrink-0">
                                            <ul class="nav justify-content-end nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a type="button" href="{{route('dashboard.get')}}?fresh" class="btn btn-success btn-label"><i class="ri-restart-line label-icon align-middle fs-16 me-2"></i> Refresh</a>
                                                </li>
                                            </ul><!-- end ul -->
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        @if ($lastRanAt)
                                            <div class="p-3 {{ $lastRanAt->diffInMinutes() > 5 ? 'bg-soft-danger' : 'bg-soft-success' }}">
                                                <div class="float-end ms-2">
                                                    <h6 class="{{ $lastRanAt->diffInMinutes() > 5 ? 'text-danger' : 'text-success' }} mb-0"><span class="text-dark">Last Updated : </span>{{ $lastRanAt->diffForHumans() }}</h6>
                                                </div>
                                                <h6 class="mb-0 {{ $lastRanAt->diffInMinutes() > 5 ? 'text-danger' : 'text-success' }}">Application Status</h6>
                                            </div>
                                        @endif
                                        <div class="p-3">
                                            <div class="row">
                                                @foreach ($health->storedCheckResults as $result)
                                                    <div class="col-xl-4">
                                                        <div class="card card-animate no-box-shadow">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm flex-shrink-0">
                                                                        @if($result->status == 'ok')
                                                                            <span class="avatar-title bg-soft-success text-success rounded-2 fs-2">
                                                                                <i class="ri-check-double-line text-success"></i>
                                                                            </span>
                                                                        @elseif($result->status == 'warning')
                                                                            <span class="avatar-title bg-soft-warning text-warning rounded-2 fs-2">
                                                                                <i class="ri-error-warning-line text-warning"></i>
                                                                            </span>
                                                                        @elseif($result->status == 'crashed')
                                                                            <span class="avatar-title bg-soft-primary text-primary rounded-2 fs-2">
                                                                                <i class="ri-group-line text-primary"></i>
                                                                            </span>
                                                                        @elseif($result->status == 'failed')
                                                                            <span class="avatar-title bg-soft-danger text-danger rounded-2 fs-2">
                                                                                <i class="ri-close-line text-danger"></i>
                                                                            </span>
                                                                        @else
                                                                            <!-- Question mark icon -->
                                                                            <span class="avatar-title bg-soft-dark text-dark rounded-2 fs-2">
                                                                                <i class="ri-bug-line text-dark"></i>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div class="d-flex align-items-center">
                                                                            <h4 class="fs-4 flex-grow-1 mb-0"><span class="counter-value text-uppercase">{{ $result->label }}</span></h4>
                                                                        </div>
                                                                        <p class="text-muted mb-0">
                                                                            @if (!empty($result->notificationMessage))
                                                                                {{ $result->notificationMessage }}
                                                                            @else
                                                                                {{ $result->shortSummary }}
                                                                            @endif
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div><!-- end card body -->
                                                        </div>
                                                    </div><!-- end col -->
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                @endcan
            </div>
        </div>
    </div>
    <!-- container-fluid -->
</div><!-- End Page-content -->

@stop
