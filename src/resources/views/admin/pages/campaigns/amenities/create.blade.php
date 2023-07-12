@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Amenities', 'Create']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('campaign_amenities_list.get', $campaign_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('campaign_amenities_create.post', $campaign_id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Campaign Amenities Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'title', 'label'=>'Title', 'value'=>old('title')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'icon_image', 'label'=>'Icon Image'])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Create</button>
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
        <!--end row-->



    </div> <!-- container-fluid -->
</div><!-- End Page-content -->



@stop


@section('javascript')


<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#title', [
    {
      rule: 'required',
      errorMessage: 'Title is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Title is invalid',
    },
  ])
  .addField('#icon_image', [
    {
        rule: 'minFilesCount',
        value: 1,
        errorMessage: 'Please select a icon image',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid icon image',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

@stop
