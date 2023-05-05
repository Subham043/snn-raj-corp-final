@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Banner', 'page_link'=>route('about.banner.get'), 'list'=>['Update']])
        <!-- end page title -->

        <div class="row" id="image-container">
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('about.banner.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Banner Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'heading', 'label'=>'Heading', 'value'=>!empty($data) ? (old('heading') ? old('heading') : $data->heading) : old('heading')])
                                        <p>
                                            <code>Note: </code> Put the text in between span tags to make it highlighted
                                        </p>
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'image', 'label'=>'Image'])
                                        @if(!empty($data->image_link))
                                            <img src="{{$data->image_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'button_text', 'label'=>'Button Text', 'value'=>!empty($data) ? (old('button_text') ? old('button_text') : $data->button_text) : old('button_text')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'button_link', 'label'=>'Button Link', 'value'=>!empty($data) ? (old('button_link') ? old('button_link') : $data->button_link) : old('button_link')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'description', 'label'=>'Description', 'value'=>!empty($data) ? (old('description') ? old('description') : $data->description) : old('description')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'mission', 'label'=>'Mission', 'value'=>!empty($data) ? (old('mission') ? old('mission') : $data->mission) : old('mission')])
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'vission', 'label'=>'Vission', 'value'=>!empty($data) ? (old('vission') ? old('vission') : $data->vission) : old('vission')])
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
  ])
  .addField('#description', [
    {
        rule: 'required',
        errorMessage: 'Description Link is required',
    },
  ])
  .addField('#mission', [
    {
        rule: 'required',
        errorMessage: 'Misiion is required',
    },
  ])
  .addField('#vission', [
    {
        rule: 'required',
        errorMessage: 'Vission is required',
    },
  ])
  .addField('#image', [
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
            extensions: ['jpeg', 'jpg', 'png', 'webp'],
            maxSize: 500000,
            minSize: 1000,
            types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'],
        },
        },
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('heading',document.getElementById('heading').value)
        formData.append('button_link',document.getElementById('button_link').value)
        formData.append('button_text',document.getElementById('button_text').value)
        formData.append('mission',document.getElementById('mission').value)
        formData.append('vission',document.getElementById('vission').value)
        formData.append('description',document.getElementById('description').value)
        if((document.getElementById('image').files).length>0){
            formData.append('image',document.getElementById('image').files[0])
        }

        const response = await axios.post('{{route('about.banner.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.heading){
            validation.showErrors({'#heading': error?.response?.data?.errors?.heading[0]})
        }
        if(error?.response?.data?.errors?.button_link){
            validation.showErrors({'#button_link': error?.response?.data?.errors?.button_link[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.errors?.button_text){
            validation.showErrors({'#button_text': error?.response?.data?.errors?.button_text[0]})
        }
        if(error?.response?.data?.errors?.mission){
            validation.showErrors({'#mission': error?.response?.data?.errors?.mission[0]})
        }
        if(error?.response?.data?.errors?.vission){
            validation.showErrors({'#vission': error?.response?.data?.errors?.vission[0]})
        }
        if(error?.response?.data?.errors?.image){
            validation.showErrors({'#image': error?.response?.data?.errors?.image[0]})
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
