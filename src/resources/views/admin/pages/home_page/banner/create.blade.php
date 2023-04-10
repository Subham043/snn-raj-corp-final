@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list users')
        @include('admin.includes.breadcrumb', ['page'=>'Banner', 'page_link'=>route('home_page.banner.paginate.get'), 'list'=>['Create']])
        @endcan
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('home_page.banner.paginate.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('home_page.banner.create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Banner Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'title', 'label'=>'Title', 'value'=>old('title')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'button_link', 'label'=>'Button Link', 'value'=>old('button_link')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'description', 'label'=>'Description', 'value'=>old('description')])
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" checked>
                                                    <label class="form-check-label" for="is_draft">Project Status</label>
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
                        <div class="card-header align-items-center d-flex justify-content-between">
                            <h4 class="card-title mb-0">Banner Media</h4>
                            <div class="col-auto">
                                <div class="d-flex gap-2 align-items-center">
                                    <label class="form-check-label" for="is_banner_image">Video</label>
                                    <div>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input" type="checkbox" role="switch" id="is_banner_image" name="is_banner_image" {{old('is_banner_image') && old('is_banner_image')==false ? '' : 'checked'}}>
                                            <label class="form-check-label" for="is_banner_image">Image</label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4" id="image_row">
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.file_input', ['key'=>'banner_image', 'label'=>'Image'])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'banner_image_alt', 'label'=>'Image Alt', 'value'=>old('banner_image_alt')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.input', ['key'=>'banner_image_title', 'label'=>'Image Title', 'value'=>old('banner_image_title')])
                                    </div>

                                </div>
                                <div class="row gy-4 d-none" id="video_row">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'banner_video', 'label'=>'Video Link', 'value'=>old('banner_video')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'banner_video_title', 'label'=>'Video Title', 'value'=>old('banner_video_title')])
                                    </div>

                                </div>
                                <div class="row gy-4 mt-2">

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
  .addField('#description', [
    {
        rule: 'required',
        errorMessage: 'Description is required',
    },
  ])
  .addField('#banner_video', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#banner_video_title', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#button_link', [
    {
        validator: (value, fields) => true,
    },
  ])
  .addField('#banner_image_title', [
        {
            validator: (value, fields) => true,
        },
    ])
    .addField('#banner_image_alt', [
        {
            validator: (value, fields) => true,
        },
    ])
    .addField('#banner_image', [
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
        formData.append('is_banner_image',document.getElementById('is_banner_image').checked ? 1 : 0)
        formData.append('is_draft',document.getElementById('is_draft').checked ? 1 : 0)
        formData.append('title',document.getElementById('title').value)
        formData.append('description',document.getElementById('description').value)
        formData.append('button_link',document.getElementById('button_link').value)
        if(document.getElementById('is_banner_image').checked){
            formData.append('banner_image_title',document.getElementById('banner_image_title').value)
            formData.append('banner_image_alt',document.getElementById('banner_image_alt').value)
            if((document.getElementById('banner_image').files).length>0){
                formData.append('banner_image',document.getElementById('banner_image').files[0])
            }
        }else{
            formData.append('banner_video',document.getElementById('banner_video').value)
            formData.append('banner_video_title',document.getElementById('banner_video_title').value)
        }
        const response = await axios.post('{{route('home_page.banner.create.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();
        imageToggleHandler()
    }catch (error){
        if(error?.response?.data?.errors?.title){
            validation.showErrors({'#title': error?.response?.data?.errors?.title[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.errors?.button_link){
            validation.showErrors({'#button_link': error?.response?.data?.errors?.button_link[0]})
        }
        if(error?.response?.data?.errors?.banner_image_title){
            validation.showErrors({'#banner_image_title': error?.response?.data?.errors?.banner_image_title[0]})
        }
        if(error?.response?.data?.errors?.banner_image_alt){
            validation.showErrors({'#banner_image_alt': error?.response?.data?.errors?.banner_image_alt[0]})
        }
        if(error?.response?.data?.errors?.banner_image){
            validation.showErrors({'#banner_image': error?.response?.data?.errors?.banner_image[0]})
        }
        if(error?.response?.data?.errors?.banner_video){
            validation.showErrors({'#banner_video': error?.response?.data?.errors?.banner_video[0]})
        }
        if(error?.response?.data?.errors?.banner_video_title){
            validation.showErrors({'#banner_video_title': error?.response?.data?.errors?.banner_video_title[0]})
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

  document.querySelector('#is_banner_image').addEventListener("change", (event) => imageToggleHandler())

function imageToggleHandler(){
    if(document.getElementById("is_banner_image").checked==true){
        document.querySelector('#image_row').classList.add("d-flex")
        document.querySelector('#image_row').classList.remove("d-none")
        document.querySelector('#video_row').classList.add("d-none")
    }else{
        document.querySelector('#video_row').classList.add("d-flex")
        document.querySelector('#video_row').classList.remove("d-none")
        document.querySelector('#image_row').classList.add("d-none")
    }
}
</script>

@stop
