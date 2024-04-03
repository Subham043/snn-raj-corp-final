@extends('admin.layouts.dashboard')



@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Projects', 'page_link'=>route('project.paginate.get'), 'list'=>['List']])
        <!-- end page title -->

        <div class="row" id="image-container">
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project.heading.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Partner Heading</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'heading', 'label'=>'Heading', 'value'=>!empty($projectHeading) ? (old('heading') ? old('heading') : $projectHeading->heading) : old('heading')])
                                        <p>
                                            <code>Note: </code> Put the text in between span tags to make it highlighted
                                        </p>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'sub_heading', 'label'=>'Sub Heading', 'value'=>!empty($projectHeading) ? (old('sub_heading') ? old('sub_heading') : $projectHeading->sub_heading) : old('sub_heading')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'description', 'label'=>'Description', 'value'=>!empty($projectHeading) ? (old('description') ? old('description') : $projectHeading->description) : old('description')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Update</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <!--end col-->
        </div>

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
                                            <td class="date">{{$item->created_at->format('M d, Y h:i A')}}</td>
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
                                                        <a href="{{route('project.plan_category.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Plan Category</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.gallery_image.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Gallery Images</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.gallery_video.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Gallery Videos</a>
                                                    </div>

                                                    <div class="edit">
                                                        <a href="{{route('project.additional_content.paginate.get', $item->id)}}" class="btn btn-sm btn-secondary edit-item-btn">Additional Contents</a>
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



@section('javascript')

<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
.addField('#heading', [
    {
      rule: 'required',
      errorMessage: 'Heading is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Heading is invalid',
    },
  ])
.addField('#sub_heading', [
    {
      rule: 'required',
      errorMessage: 'Sub Heading is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Sub Heading is invalid',
    },
  ])
  .addField('#description', [
    {
        validator: (value, fields) => true,
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('heading',document.getElementById('heading').value)
        formData.append('sub_heading',document.getElementById('sub_heading').value)
        formData.append('description',document.getElementById('description').value)

        const response = await axios.post('{{route('project.heading.post')}}', formData)
        successToast(response.data.message)
    }catch (error){
        if(error?.response?.data?.errors?.heading){
            validation.showErrors({'#heading': error?.response?.data?.errors?.heading[0]})
        }
        if(error?.response?.data?.errors?.sub_heading){
            validation.showErrors({'#sub_heading': error?.response?.data?.errors?.sub_heading[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Update
            `
        submitBtn.disabled = false;
    }
  });
</script>
@stop
