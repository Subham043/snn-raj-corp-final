@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Campaigns', 'page_link'=>route('campaign_list.get'), 'list'=>['Update']])
        <!-- end page title -->

        <div class="row" id="image-container">
            @include('admin.includes.back_button', ['link'=>route('campaign_list.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('campaign_update.post', $data->id)}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Campaign Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'name', 'label'=>'Campaign Name', 'value'=>old('name') ? old('name') : $data->name])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'slug', 'label'=>'Campaign Slug', 'value'=>old('slug') ? old('slug') : $data->slug])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'email', 'label'=>'Campaign Email', 'value'=>old('email') ? old('email') : $data->email])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'phone', 'label'=>'Campaign Phone', 'value'=>old('phone') ? old('phone') : $data->phone])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'address', 'label'=>'Campaign Address', 'value'=>old('address') ? old('address') : $data->address])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'srd', 'label'=>'Campaign SRD', 'value'=>old('srd') ? old('srd') : $data->srd])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.file_input', ['key'=>'header_logo', 'label'=>'Header Logo'])
                                        @if(!empty($data->header_logo_link))
                                            <img src="{{$data->header_logo_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.file_input', ['key'=>'footer_logo', 'label'=>'Footer Logo'])
                                        @if(!empty($data->footer_logo_link))
                                            <img src="{{$data->footer_logo_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>

                                    <!--end col-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRightDisabled" name="campaign_status" {{$data->campaign_status == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexSwitchCheckRightDisabled">Campaign Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckRightDisabled2" name="publish_status"  {{$data->publish_status == 1 ? 'checked' : ''}}>
                                                    <label class="form-check-label" for="flexSwitchCheckRightDisabled2">Publish Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!--end col-->

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Social Media</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'facebook', 'label'=>'Facebook', 'value'=>old('facebook') ? old('facebook') : $data->facebook])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'instagram', 'label'=>'Instagram', 'value'=>old('instagram') ? old('instagram') : $data->instagram])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'youtube', 'label'=>'Youtube', 'value'=>old('youtube') ? old('youtube') : $data->youtube])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'linkedin', 'label'=>'Linkedin', 'value'=>old('linkedin') ? old('linkedin') : $data->linkedin])
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">SEO Details</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_title', 'label'=>'Meta Title', 'value'=>old('meta_title') ? old('meta_title') : $data->meta_title])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_description', 'label'=>'Meta Description', 'value'=>old('meta_description') ? old('meta_description') : $data->meta_description])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_locale', 'label'=>'Og Locale', 'value'=>old('og_locale') ? old('og_locale') : $data->og_locale])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_type', 'label'=>'Og Type', 'value'=>old('og_type') ? old('og_type') : $data->og_type])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_description', 'label'=>'Og Description', 'value'=>old('og_description') ? old('og_description') : $data->og_description])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'og_site_name', 'label'=>'Og Site Name', 'value'=>old('og_site_name') ? old('og_site_name') : $data->og_site_name])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.file_input', ['key'=>'og_image', 'label'=>'Og Image'])
                                        @if($data->og_image)
                                            <img src="{{$data->og_image_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_header', 'label'=>'Meta Header', 'value'=>old('meta_header') ? old('meta_header') : $data->meta_header])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_footer', 'label'=>'Meta Footer', 'value'=>old('meta_footer') ? old('meta_footer') : $data->meta_footer])
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
  .addField('#name', [
    {
      rule: 'required',
      errorMessage: 'Campaign Name is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Campaign Name is invalid',
    },
  ])
  .addField('#srd', [
    {
      rule: 'required',
      errorMessage: 'Campaign SRD is required',
    },
  ])
  .addField('#slug', [
    {
      rule: 'required',
      errorMessage: 'Campaign Slug is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Campaign Slug is invalid',
    },
  ])
  .addField('#phone', [
    {
        rule: 'customRegexp',
        value: /^[0-9]*$/,
        errorMessage: 'Campaign Phone is invalid',
    },
  ])
  .addField('#address', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Campaign Address is invalid',
    },
  ])
  .addField('#facebook', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Facebook is invalid',
    },
  ])
  .addField('#instagram', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Instagram is invalid',
    },
  ])
  .addField('#youtube', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Youtube is invalid',
    },
  ])
  .addField('#linkedin', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Linkedin is invalid',
    },
  ])
  .addField('#header_logo', [
    {
        rule: 'minFilesCount',
        value: 0,
        errorMessage: 'Please select a header logo',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid header logo',
    },
  ])
  .addField('#footer_logo', [
    {
        rule: 'minFilesCount',
        value: 0,
        errorMessage: 'Please select a footer logo',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid footer logo',
    },
  ])
  .addField('#og_image', [
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'png', 'jpg', 'webp', 'avif',]
            },
        },
        errorMessage: 'Please select a valid og image',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });
</script>

<script src="{{ asset('admin/js/pages/img-previewer.min.js') }}"></script>
<script>
    const myViewer = new ImgPreviewer('#image-container',{
      // aspect ratio of image
        fillRatio: 0.9,
        // attribute that holds the image
        dataUrlKey: 'src',
        // additional styles
        style: {
            modalOpacity: 0.6,
            headerOpacity: 0,
            zIndex: 99
        },
        // zoom options
        imageZoom: {
            min: 0.1,
            max: 5,
            step: 0.1
        },
        // detect whether the parent element of the image is hidden by the css style
        bubblingLevel: 0,

    });
</script>

@stop
