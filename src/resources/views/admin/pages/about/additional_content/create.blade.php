@extends('admin.layouts.dashboard')

@section('css')
<link href="{{ asset('admin/libs/quill/quill.snow.css' ) }}" rel="stylesheet" type="text/css" />

<style nonce="{{ csp_nonce() }}">
    #description_quill{
        min-height: 200px;
    }

    #popup_description_quill{
        min-height: 200px;
    }
</style>
@stop

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list about additional content')
        @include('admin.includes.breadcrumb', ['page'=>'Additional Content', 'page_link'=>route('about.additional_content.paginate.get'), 'list'=>['Create']])
        @endcan
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('about.additional_content.paginate.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('about.additional_content.create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Additional Content Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'heading', 'label'=>'Heading', 'value'=>old('heading')])
                                        <p>
                                            <code>Note: </code> Put the text in between span tags to make it highlighted
                                        </p>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'image', 'label'=>'Image'])
                                        <p>
                                            <code>Note: </code> Banner Size : 350 x 450
                                        </p>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'button_text', 'label'=>'Button Text', 'value'=>old('button_text')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'button_link', 'label'=>'Button Link', 'value'=>old('button_link')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.quill', ['key'=>'description', 'label'=>'Description', 'value'=>old('description')])
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" checked>
                                                    <label class="form-check-label" for="is_draft">Additional Content Status</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Additional Popup</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'popup_button_text', 'label'=>'Popup Button Text', 'value'=>old('popup_button_text')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'popup_button_slug', 'label'=>'Popup Button Slug', 'value'=>old('popup_button_slug')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.quill', ['key'=>'popup_description', 'label'=>'Popup Description', 'value'=>old('popup_description')])
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="activate_popup" name="activate_popup" >
                                                    <label class="form-check-label" for="activate_popup">Activate Popup</label>
                                                </div>
                                            </div>

                                        </div>
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
<script src="{{ asset('admin/libs/quill/quill.min.js' ) }}"></script>

@include('admin.includes.quill_Image_script')

<script type="text/javascript" nonce="{{ csp_nonce() }}">

var quillDescription = new Quill('#description_quill', {
    theme: 'snow',
    modules: {
        toolbar: QUILL_TOOLBAR_OPTIONS
    },
});

quillDescription.on('text-change', function(delta, oldDelta, source) {
  if (source == 'user') {
    document.getElementById('description').value = quillDescription.root.innerHTML
  }
});


var quillPopupDescription = new Quill('#popup_description_quill', {
    theme: 'snow',
    modules: {
        toolbar: {
            container: QUILL_TOOLBAR_OPTIONS_WITH_IMAGE,
            handlers: { image: quillImageHandler },
        },
    },
});

quillPopupDescription.on('text-change', function(delta, oldDelta, source) {
  if (source == 'user') {
    document.getElementById('description').value = quillPopupDescription.root.innerHTML
  }
});

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
  .addField('#popup_button_text', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Popup Button Text is invalid',
    },
  ])
  .addField('#button_text', [
    {
      rule: 'required',
      errorMessage: 'Button Text is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Button Text is invalid',
    },
  ])
  .addField('#button_link', [
    {
      rule: 'required',
      errorMessage: 'Button Link is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Button Link is invalid',
    },
  ])
  .addField('#image', [
    {
      rule: 'required',
      errorMessage: 'Image is required',
    },
    {
        rule: 'minFilesCount',
        value: 1,
        errorMessage: 'Image is required',
    },
    {
        rule: 'maxFilesCount',
        value: 1,
        errorMessage: 'Only One Image is required',
    },
    {
        rule: 'files',
        value: {
            files: {
                extensions: ['jpeg', 'jpg', 'png', 'webp'],
                maxSize: 500000,
                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'],
            },
        },
        errorMessage: 'Images with jpeg,jpg,png,webp extensions are allowed! Image size should not exceed 500kb!',
    },
  ])
  .addField('#description', [
    {
      rule: 'required',
      errorMessage: 'Description is required',
    },
  ])
  .addField('#popup_description', [
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
        formData.append('is_draft',document.getElementById('is_draft').checked ? 1 : 0)
        formData.append('activate_popup',document.getElementById('activate_popup').checked ? 1 : 0)
        formData.append('heading',document.getElementById('heading').value)
        formData.append('popup_button_text',document.getElementById('popup_button_text').value)
        formData.append('popup_button_slug',document.getElementById('popup_button_slug').value)
        formData.append('button_text',document.getElementById('button_text').value)
        formData.append('button_link',document.getElementById('button_link').value)
        formData.append('description',quillDescription.root.innerHTML)
        formData.append('description_unfiltered',quillDescription.getText())
        formData.append('popup_description',quillPopupDescription.root.innerHTML)
        formData.append('popup_description_unfiltered',quillPopupDescription.getText())
        if((document.getElementById('image').files).length>0){
            formData.append('image',document.getElementById('image').files[0])
        }

        const response = await axios.post('{{route('about.additional_content.create.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();
        quillDescription.root.innerHTML = '';
    }catch (error){
        if(error?.response?.data?.errors?.heading){
            validation.showErrors({'#heading': error?.response?.data?.errors?.heading[0]})
        }
        if(error?.response?.data?.errors?.button_text){
            validation.showErrors({'#button_text': error?.response?.data?.errors?.button_text[0]})
        }
        if(error?.response?.data?.errors?.popup_button_text){
            validation.showErrors({'#popup_button_text': error?.response?.data?.errors?.popup_button_text[0]})
        }
        if(error?.response?.data?.errors?.popup_button_slug){
            validation.showErrors({'#popup_button_slug': error?.response?.data?.errors?.popup_button_slug[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.errors?.popup_description){
            validation.showErrors({'#popup_description': error?.response?.data?.errors?.popup_description[0]})
        }
        if(error?.response?.data?.errors?.button_link){
            validation.showErrors({'#button_link': error?.response?.data?.errors?.button_link[0]})
        }
        if(error?.response?.data?.errors?.image){
            validation.showErrors({'#image': error?.response?.data?.errors?.image[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Create
            `
        submitBtn.disabled = false;
    }
  });

</script>

@stop
