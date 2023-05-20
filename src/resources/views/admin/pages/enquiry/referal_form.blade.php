@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Referal Form Enquiry', 'page_link'=>route('enquiry.referal_form.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Referal Form Enquiry</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <a href="{{route('enquiry.referal_form.excel.get')}}" download type="button" class="btn btn-info add-btn" id="create-btn"><i class="ri-file-excel-fill align-bottom me-1"></i> Excel Download</a>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('enquiry.referal_form.paginate.get'), 'search'=>$search])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Member Name</th>
                                            <th class="sort" data-sort="customer_name">Member Email</th>
                                            <th class="sort" data-sort="customer_name">Member Phone</th>
                                            <th class="sort" data-sort="customer_name">Member Project</th>
                                            <th class="sort" data-sort="customer_name">Member Unit</th>
                                            <th class="sort" data-sort="customer_name">Referal Name</th>
                                            <th class="sort" data-sort="customer_name">Referal Email</th>
                                            <th class="sort" data-sort="customer_name">Referal Phone</th>
                                            <th class="sort" data-sort="customer_name">Referal Project</th>
                                            <th class="sort" data-sort="customer_name">Referal Relation</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{$item->member_name}}</td>
                                            <td class="customer_name">{{$item->member_email}}</td>
                                            <td class="customer_name">{{$item->member_phone}}</td>
                                            <td class="customer_name">{{$item->member_project->name}}</td>
                                            <td class="customer_name">{{$item->member_unit}}</td>
                                            <td class="customer_name">{{$item->referal_name}}</td>
                                            <td class="customer_name">{{$item->referal_email}}</td>
                                            <td class="customer_name">{{$item->referal_phone}}</td>
                                            <td class="customer_name">{{$item->referal_project->name}}</td>
                                            <td class="customer_name">{{$item->referal_relation}}</td>
                                            <td class="date">{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="d-flex gap-2">

                                                    @can('delete enquiries')
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-link="{{route('enquiry.referal_form.delete.get', $item->id)}}">Delete</button>
                                                    </div>
                                                    @endcan
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
