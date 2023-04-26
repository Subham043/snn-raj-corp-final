@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Projects</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        @can('create projects')
                                        <a href="{{route('project.create.get')}}" type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-add-line align-bottom me-1"></i> Create</a>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-sm">
                                    @include('admin.includes.search_list', ['link'=>route('project.paginate.get'), 'search'=>$search])
                                </div>
                            </div>
                            <div class="table-responsive table-card mt-3 mb-1">
                                @if($data->total() > 0)
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="sort" data-sort="customer_name">Name</th>
                                            <th class="sort" data-sort="customer_name">Slug</th>
                                            <th class="sort" data-sort="customer_name">Rera</th>
                                            <th class="sort" data-sort="customer_name">Description</th>
                                            <th class="sort" data-sort="customer_name">Project Status</th>
                                            <th class="sort" data-sort="customer_name">Publish Status</th>
                                            <th class="sort" data-sort="date">Created On</th>
                                            <th class="sort" data-sort="action">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($data->items() as $item)
                                        <tr>
                                            <td class="customer_name">{{ $item->name }}</td>
                                            <td class="customer_name">{{ $item->slug }}</td>
                                            <td class="customer_name">{{$item->rera}}</td>
                                            <td class="customer_name">{{ Str::limit($item->description_unfiltered, 20) }}</td>
                                            @if($item->is_completed == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Completed</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-warning text-uppercase">Ongoing</span></td>
                                            @endif
                                            @if($item->is_draft == 1)
                                            <td class="status"><span class="badge badge-soft-success text-uppercase">Active</span></td>
                                            @else
                                            <td class="status"><span class="badge badge-soft-danger text-uppercase">Draft</span></td>
                                            @endif
                                            <td class="date">{{$item->created_at->diffForHumans()}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    @can('edit projects')
                                                    <div class="edit">
                                                        <a href="{{route('project.update.get', $item->id)}}" class="btn btn-sm btn-primary edit-item-btn">Edit</a>
                                                    </div>
                                                    @endcan

                                                    <div class="edit">
                                                        <a href="{{route('project.banner.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Banner</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.accomodation.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Accomodation</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.plan.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Plans</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.amenity.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Amenities</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.gallery_image.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Gallery Images</a>
                                                    </div>

                                                    @can('delete projects')
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" data-link="{{route('project.delete.get', $item->id)}}">Delete</button>
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
