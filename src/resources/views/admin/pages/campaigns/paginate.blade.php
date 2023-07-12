@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Campaigns</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="{{route('campaign_create.get')}}" style="background:green;border-color:green;" type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-add-line align-bottom me-1"></i> Create</a>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('campaign_list.get')])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Campaign Name</th>
                                            <th class="sort" data-sort="customer_name">Campaign Slug</th>
                                            <th class="sort" data-sort="status">Campaign Status</th>
                                            <th class="sort" data-sort="status">Publish Status</th>
                                            <th class="sort" data-sort="date">Created Date</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="customer_name">{{$item->slug}}</td>
                                            @if($item->campaign_status == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Completed</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-danger text-uppercase">Upcoming</span></td>
                                            @endif
                                            @if($item->publish_status == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-danger text-uppercase">Draft</span></td>
                                            @endif
                                            <td class="date">{{$item->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{route('campaign_update.get', $item->id)}}" style="background:yellow;color:black;border-color:yellow;" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_banner.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Banner Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_about.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">About Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_table_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Table Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_gallery_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Gallery Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_specification_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Specification Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_plan_category_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Plan Category Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_location.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Location Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_connectivity_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Connectivity Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_amenities_list.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Amenities Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_thank.get', $item->id)}}" class="btn btn-sm btn-info edit-item-btn">Thank You Section</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_preview.get', $item->id)}}" target="_blank" style="background:purple;color:white;border-color:purple;" class="btn btn-sm btn-success edit-item-btn">Preview</a>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" style="background:red" onclick="deleteHandler('{{route('campaign_delete.get', $item->id)}}')">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @else
                                    @include('admin.includes.no_result')
                                @endif
                            </div>

                            {{$data->onEachSide(5)->links('admin.includes.pagination')}}
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
</div>

@stop
