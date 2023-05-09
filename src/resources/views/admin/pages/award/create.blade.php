@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list awards')
        @include('admin.includes.breadcrumb', ['page'=>'Award', 'page_link'=>route('award.paginate.get'), 'list'=>['Create']])
        @endcan
        <!-- end page title -->

        <div class="row">
            @include('admin.includes.back_button', ['link'=>route('award.paginate.get')])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('award.create.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Award Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'title', 'label'=>'Title', 'value'=>old('title')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'sub_title', 'label'=>'Sub Title', 'value'=>old('sub_title')])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.select', ['key'=>'year', 'label'=>'Year'])
                                    </div>
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.file_input', ['key'=>'image', 'label'=>'Image'])
                                        <p>
                                            <code>Note: </code> Banner Size : 300 x 300
                                        </p>
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'description', 'label'=>'Description', 'value'=>old('description')])
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" checked>
                                                    <label class="form-check-label" for="is_draft">Award Status</label>
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
<script src="{{ asset('admin/js/pages/choices.min.js') }}"></script>

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
  .addField('#sub_title', [
    {
      rule: 'required',
      errorMessage: 'Sub Title is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Sub Title is invalid',
    },
  ])
  .addField('#year', [
    {
        rule: 'required',
        errorMessage: 'Year is required',
    },
    {
        rule: 'minNumber',
        value: 1000,
    },
    {
        rule: 'maxNumber',
        value: 3000,
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
  .addField('#description', [
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
        formData.append('title',document.getElementById('title').value)
        formData.append('sub_title',document.getElementById('sub_title').value)
        formData.append('year',document.getElementById('year').value)
        formData.append('description',document.getElementById('description').value)
        if((document.getElementById('image').files).length>0){
            formData.append('image',document.getElementById('image').files[0])
        }

        const response = await axios.post('{{route('award.create.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.title){
            validation.showErrors({'#title': error?.response?.data?.errors?.title[0]})
        }
        if(error?.response?.data?.errors?.sub_title){
            validation.showErrors({'#sub_title': error?.response?.data?.errors?.sub_title[0]})
        }
        if(error?.response?.data?.errors?.description){
            validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
        }
        if(error?.response?.data?.errors?.year){
            validation.showErrors({'#year': error?.response?.data?.errors?.year[0]})
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

  const yearChoice = new Choices('#year', {
        choices: [
            {
                value: '',
                label: 'Select a year',
                selected: {{empty(old('year')) ? 'true' : 'false'}},
            },
            @for($i=date('Y'); $i>=1970; $i--)
                {
                    value: '{{$i}}',
                    label: '{{$i}}',
                    selected: {{$i==old('year') ? 'true' : 'false'}},
                },
            @endfor
        ],
        placeholderValue: 'Select a year',
        ...CHOICE_CONFIG,
        shouldSort: false,
        shouldSortItems: false,
    });

</script>

@stop
