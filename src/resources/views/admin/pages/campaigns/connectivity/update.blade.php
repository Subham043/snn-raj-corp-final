@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Connectivity', 'Update']])
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('campaign_connectivity_list.get', $data->campaign_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('campaign_connectivity_update.post', [$campaign_id, $data->id])}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Campaign Connectivity Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.input', ['key'=>'title', 'label'=>'Title', 'value'=>old('title') ? old('title') : $data->title])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'points', 'label'=>'Points', 'value'=>old('points') ? old('points') : $data->points])
                                        <p>
                                            <code>Note : </code> Use | seperated points. eg: <i> test1| test2 </i>
                                        </p>
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
  .addField('#points', [
    {
      rule: 'required',
      errorMessage: 'Points is required',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

@stop
