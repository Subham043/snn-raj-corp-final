@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list projects')
        @include('admin.includes.breadcrumb', ['page'=>'Gallery Image', 'page_link'=>route('project.gallery_image.paginate.get', $project_id), 'list'=>['Update']])
        @endcan
        <!-- end page title -->

        <div class="row" id="image-container">
            @include('admin.includes.back_button', ['link'=>route('project.gallery_image.paginate.get', $project_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project.gallery_image.update.post', [$project_id, $data->id])}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery Image Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'image', 'label'=>'Image'])
                                        <p>
                                            <code>Note: </code> Banner Size : 500 x 334
                                        </p>
                                        @if(!empty($data->image_link))
                                            <img src="{{$data->image_link}}" alt="" class="img-preview">
                                        @endif
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.select', ['key'=>'type', 'label'=>'Type'])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'image_title', 'label'=>'Image Title', 'value'=>$data->image_title])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'image_alt', 'label'=>'Image Alt', 'value'=>$data->image_alt])
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" {{$data->is_draft==false ? '' : 'checked'}}>
                                                    <label class="form-check-label" for="is_draft">Gallery Image Status</label>
                                                </div>
                                            </div>

                                        </div>
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

<script src="{{ asset('admin/js/pages/choices.min.js') }}"></script>

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

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
.addField('#image_title', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Image Title is invalid',
    },
  ])
  .addField('#image_alt', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Image Alt is invalid',
    },
  ])
  .addField('#type', [
    {
        rule: 'required',
        errorMessage: 'Type is required',
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
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('is_draft',document.getElementById('is_draft').checked ? 1 : 0)
        formData.append('image_title',document.getElementById('image_title').value)
        formData.append('image_alt',document.getElementById('image_alt').value)
        formData.append('type',document.getElementById('type').value)
        if((document.getElementById('image').files).length>0){
            formData.append('image',document.getElementById('image').files[0])
        }

        const response = await axios.post('{{route('project.gallery_image.update.post', [$project_id, $data->id])}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.type){
            validation.showErrors({'#type': error?.response?.data?.errors?.type[0]})
        }
        if(error?.response?.data?.errors?.image_title){
            validation.showErrors({'#image_title': error?.response?.data?.errors?.image_title[0]})
        }
        if(error?.response?.data?.errors?.image_alt){
            validation.showErrors({'#image_alt': error?.response?.data?.errors?.image_alt[0]})
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

  const typeChoice = new Choices('#type', {
        choices: [
            {
                value: '',
                label: 'Select a type',
                disabled: true,
            },
            @foreach($gallery_statuses as $gallery_statuses)
                {
                    value: '{{$gallery_statuses}}',
                    label: '{{str($gallery_statuses)->replace("_", " ")}}',
                    selected: {{ $gallery_statuses == $data->type ? 'true' : 'false'}}
                },
            @endforeach
        ],
        placeholderValue: 'Select a type',
        ...CHOICE_CONFIG,
        shouldSort: false,
        shouldSortItems: false,
    });
  </script>
@stop
