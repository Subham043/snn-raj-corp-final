@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Banner']])
        <!-- end page title -->

        <div class="row" id="image-container">
            @include('admin.includes.back_button', ['link'=>route('campaign_list.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('campaign_thank.post', $campaign_id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Campaign Thank You Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'meta_header', 'label'=>'Meta Header', 'value'=>!empty($data) ? (old('meta_header') ? old('meta_header') : $data->meta_header) : old('meta_header')])
                                    </div>

                                    <!--end col-->
                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Save</button>
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
  .addField('#meta_header', [
    {
      rule: 'required',
      errorMessage: 'Meta Header is required',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>


@stop
