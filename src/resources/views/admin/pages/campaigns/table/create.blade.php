@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Table', 'Create']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('campaign_table_list.get', $campaign_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('campaign_table_create.post', $campaign_id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Campaign Table Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'unit', 'label'=>'Unit', 'value'=>old('unit')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'type', 'label'=>'Type', 'value'=>old('type')])
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
  .addField('#type', [
    {
      rule: 'required',
      errorMessage: 'Type is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Type is invalid',
    },
  ])
  .addField('#unit', [
    {
      rule: 'required',
      errorMessage: 'Unit is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Unit is invalid',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

@stop
