@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Plan Category', 'List']])
        <!-- end page title -->

        @include('admin.includes.section_title', ['section'=>'Plan Category', 'link'=>route('campaign_heading.post', $campaign_id), 'key' => 'plan_heading', 'heading_value'=>$campaign['plan_heading']])

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Campaign Plan Category</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <a href="{{route('campaign_list.get')}}" type="button" class="btn btn-dark add-btn" id="create-btn"><i class="ri-arrow-go-back-line align-bottom me-1"></i> Go Back</a>
                                        <a href="{{route('campaign_plan_category_create.get', $campaign_id)}}" style="background:green;border-color:green;" type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-add-line align-bottom me-1"></i> Create</a>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('campaign_plan_category_list.get', $campaign_id)])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerPlan Category">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Category Name</th>
                                            <th class="sort" data-sort="date">Created Date</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">

                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->name}}</td>
                                            <td class="date">{{$item->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a href="{{route('campaign_plan_category_update.get', [$item->campaign_id, $item->id])}}" style="background:yellow;color:black;border-color:yellow;" class="btn btn-sm btn-success edit-item-btn">Edit</a>
                                                    </div>
                                                    <div class="edit">
                                                        <a href="{{route('campaign_plan_image_list.get', [$item->campaign_id, $item->id])}}" style="background:rgb(0, 72, 255);color:white;border-color:rgb(0, 72, 255);" class="btn btn-sm btn-success edit-item-btn">Plan Images</a>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" style="background:red" onclick="deleteHandler('{{route('campaign_plan_category_delete.get', [$campaign_id, $item->id])}}')">Delete</button>
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
