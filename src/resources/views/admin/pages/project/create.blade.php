@extends('admin.layouts.dashboard')

@section('content')

@section('css')
<link href="{{ asset('admin/libs/quill/quill.snow.css' ) }}" rel="stylesheet" type="text/css" />

<style nonce="{{ csp_nonce() }}">
    #description_quill{
        min-height: 200px;
    }
</style>
@stop

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list projects')
        @include('admin.includes.breadcrumb', ['page'=>'Project', 'page_link'=>route('project.paginate.get'), 'list'=>['Create']])
        @endcan
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('project.paginate.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project.create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Project Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'name', 'label'=>'Name', 'value'=>old('name')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'slug', 'label'=>'Slug', 'value'=>old('slug')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'rera', 'label'=>'Rera', 'value'=>old('rera')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'map_location_link', 'label'=>'Map Location Link', 'value'=>old('map_location_link')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'location', 'label'=>'Location', 'value'=>old('location')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'floor', 'label'=>'Floor', 'value'=>old('floor')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'acre', 'label'=>'Acre', 'value'=>old('acre')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'tower', 'label'=>'Tower', 'value'=>old('tower')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'brochure', 'label'=>'Brochure (PDF)'])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.select_multiple', ['key'=>'amenity', 'label'=>'Amenities'])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'address', 'label'=>'Address', 'value'=>old('address')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'brief_description', 'label'=>'Brief Description', 'value'=>old('brief_description')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.quill', ['key'=>'description', 'label'=>'Description', 'value'=>old('description')])
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" checked>
                                                    <label class="form-check-label" for="is_draft">Project Publish</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_completed" name="is_completed" checked>
                                                    <label class="form-check-label" for="is_completed">Project Status</label>
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
                            <h4 class="card-title mb-0 flex-grow-1">Project Video</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.input', ['key'=>'video', 'label'=>'Video', 'value'=>old('video')])
                                        <p>
                                            <code>Note: </code> Youtube video should follow the given format : <i>https://www.youtube.com/embed/aUIVH5qg19A</i>
                                        </p>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="use_in_banner" name="use_in_banner">
                                                    <label class="form-check-label" for="use_in_banner">Use the above video link in project page banner ?</label>
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
                            <h4 class="card-title mb-0 flex-grow-1">Project Seo Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.textarea', ['key'=>'page_keywords', 'label'=>'Page Keywords', 'value'=>old('page_keywords')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.textarea', ['key'=>'meta_title', 'label'=>'Meta Title', 'value'=>old('meta_title')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.textarea', ['key'=>'meta_keywords', 'label'=>'Meta Keywords', 'value'=>old('meta_keywords')])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.textarea', ['key'=>'meta_description', 'label'=>'Meta Description', 'value'=>old('meta_description')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_header_script', 'label'=>'Meta Header Script', 'value'=>old('meta_header_script')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_footer_script', 'label'=>'Meta Footer Script', 'value'=>old('meta_footer_script')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_header_no_script', 'label'=>'Meta Header No Script', 'value'=>old('meta_header_no_script')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.textarea', ['key'=>'meta_footer_no_script', 'label'=>'Meta Footer No Script', 'value'=>old('meta_footer_no_script')])
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
<script src="{{ asset('admin/js/pages/choices.min.js') }}"></script>

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

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#amenity', [
    {
      rule: 'required',
      errorMessage: 'Amenity is required',
    },
  ])
  .addField('#name', [
    {
      rule: 'required',
      errorMessage: 'Name is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Name is invalid',
    },
  ])
  .addField('#slug', [
    {
      rule: 'required',
      errorMessage: 'Slug is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Slug is invalid',
    },
  ])
  .addField('#rera', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Rera is invalid',
    },
  ])
  .addField('#location', [
    {
      rule: 'required',
      errorMessage: 'Location is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Location is invalid',
    },
  ])
  .addField('#floor', [
    {
      rule: 'required',
      errorMessage: 'Floor is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Floor is invalid',
    },
  ])
  .addField('#acre', [
    {
      rule: 'required',
      errorMessage: 'Acre is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Acre is invalid',
    },
  ])
  .addField('#tower', [
    {
      rule: 'required',
      errorMessage: 'Tower is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Tower is invalid',
    },
  ])
  .addField('#address', [
    {
      rule: 'required',
      errorMessage: 'Address is required',
    },
  ])
  .addField('#brief_description', [
    {
      rule: 'required',
      errorMessage: 'Brief description is required',
    },
  ])
  .addField('#description', [
    {
        rule: 'required',
        errorMessage: 'Description is required',
    },
  ])
  .addField('#brochure', [
    {
        rule: 'minFilesCount',
        value: 0,
    },
    {
        rule: 'maxFilesCount',
        value: 1,
    },
    {
        rule: 'files',
        value: {
        files: {
            extensions: ['pdf'],
            maxSize: 5000000,
            minSize: 1000,
        },
        },
    },
  ])
  .addField('#map_location_link', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_title', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_keywords', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#page_keywords', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_description', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_header_script', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_footer_script', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_header_no_script', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#meta_footer_no_script', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#video', [
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
        formData.append('use_in_banner',document.getElementById('use_in_banner').checked ? 1 : 0)
        formData.append('is_draft',document.getElementById('is_draft').checked ? 1 : 0)
        formData.append('is_completed',document.getElementById('is_completed').checked ? 1 : 0)
        formData.append('video',document.getElementById('video').value)
        formData.append('name',document.getElementById('name').value)
        formData.append('slug',document.getElementById('slug').value)
        formData.append('rera',document.getElementById('rera').value)
        formData.append('map_location_link',document.getElementById('map_location_link').value)
        formData.append('location',document.getElementById('location').value)
        formData.append('floor',document.getElementById('floor').value)
        formData.append('acre',document.getElementById('acre').value)
        formData.append('tower',document.getElementById('tower').value)
        formData.append('address',document.getElementById('address').value)
        formData.append('description',quillDescription.root.innerHTML)
        formData.append('description_unfiltered',quillDescription.getText())
        formData.append('brief_description',document.getElementById('brief_description').value)
        formData.append('meta_title',document.getElementById('meta_title').value)
        formData.append('meta_keywords',document.getElementById('meta_keywords').value)
        formData.append('page_keywords',document.getElementById('page_keywords').value)
        formData.append('meta_description',document.getElementById('meta_description').value)
        formData.append('meta_header_script',document.getElementById('meta_header_script').value)
        formData.append('meta_footer_script',document.getElementById('meta_footer_script').value)
        formData.append('meta_header_no_script',document.getElementById('meta_header_no_script').value)
        formData.append('meta_footer_no_script',document.getElementById('meta_footer_no_script').value)
        if((document.getElementById('brochure').files).length>0){
            formData.append('brochure',document.getElementById('brochure').files[0])
        }
        if(document.getElementById('amenity')?.length>0){
            for (let index = 0; index < document.getElementById('amenity').length; index++) {
                formData.append('amenity[]',document.getElementById('amenity')[index].value)
            }
        }

        const response = await axios.post('{{route('project.create.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.name){
            validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
        }
        if(error?.response?.data?.errors?.slug){
            validation.showErrors({'#slug': error?.response?.data?.errors?.slug[0]})
        }
        if(error?.response?.data?.errors?.rera){
            validation.showErrors({'#rera': error?.response?.data?.errors?.rera[0]})
        }
        if(error?.response?.data?.errors?.map_location_link){
            validation.showErrors({'#map_location_link': error?.response?.data?.errors?.map_location_link[0]})
        }
        if(error?.response?.data?.errors?.location){
            validation.showErrors({'#location': error?.response?.data?.errors?.location[0]})
        }
        if(error?.response?.data?.errors?.floor){
            validation.showErrors({'#floor': error?.response?.data?.errors?.floor[0]})
        }
        if(error?.response?.data?.errors?.acre){
            validation.showErrors({'#acre': error?.response?.data?.errors?.acre[0]})
        }
        if(error?.response?.data?.errors?.tower){
            validation.showErrors({'#tower': error?.response?.data?.errors?.tower[0]})
        }
        if(error?.response?.data?.errors?.address){
            validation.showErrors({'#address': error?.response?.data?.errors?.address[0]})
        }
        if(error?.response?.data?.errors?.brief_description){
            validation.showErrors({'#brief_description': error?.response?.data?.errors?.brief_description[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.errors?.year){
            validation.showErrors({'#year': error?.response?.data?.errors?.year[0]})
        }
        if(error?.response?.data?.errors?.amenity){
            validation.showErrors({'#amenity': error?.response?.data?.errors?.amenity[0]})
        }
        if(error?.response?.data?.errors?.video){
            validation.showErrors({'#video': error?.response?.data?.errors?.video[0]})
        }
        if(error?.response?.data?.errors?.brochure){
            validation.showErrors({'#brochure': error?.response?.data?.errors?.brochure[0]})
        }
        if(error?.response?.data?.errors?.meta_title){
            validation.showErrors({'#meta_title': error?.response?.data?.errors?.meta_title[0]})
        }
        if(error?.response?.data?.errors?.meta_keywords){
            validation.showErrors({'#meta_keywords': error?.response?.data?.errors?.meta_keywords[0]})
        }
        if(error?.response?.data?.errors?.page_keywords){
            validation.showErrors({'#page_keywords': error?.response?.data?.errors?.page_keywords[0]})
        }
        if(error?.response?.data?.errors?.meta_header_script){
            validation.showErrors({'#meta_header_script': error?.response?.data?.errors?.meta_header_script[0]})
        }
        if(error?.response?.data?.errors?.meta_header_no_script){
            validation.showErrors({'#meta_header_no_script': error?.response?.data?.errors?.meta_header_no_script[0]})
        }
        if(error?.response?.data?.errors?.meta_description){
            validation.showErrors({'#meta_description': error?.response?.data?.errors?.meta_description[0]})
        }
        if(error?.response?.data?.errors?.meta_footer_script){
            validation.showErrors({'#meta_footer_script': error?.response?.data?.errors?.meta_footer_script[0]})
        }
        if(error?.response?.data?.errors?.meta_footer_no_script){
            validation.showErrors({'#meta_footer_no_script': error?.response?.data?.errors?.meta_footer_no_script[0]})
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

  const amenityChoice = new Choices('#amenity', {
        choices: [
            @foreach($amenity as $amenity)
                {
                    value: '{{$amenity->id}}',
                    label: '{{$amenity->title}}',
                },
            @endforeach
        ],
        placeholderValue: 'Select amenities',
        ...CHOICE_CONFIG,
        shouldSort: false,
        shouldSortItems: false,
    });

</script>

@stop
