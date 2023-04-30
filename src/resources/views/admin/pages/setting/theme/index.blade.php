@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Theme Settings', 'page_link'=>route('theme.settings.get'), 'list'=>['Update']])
        <!-- end page title -->

        <div class="row" id="image-container">
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('theme.settings.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Theme Settings</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'background_color', 'label'=>'Background Color', 'value'=>!empty($data) ? (old('background_color') ? old('background_color') : $data->background_color) : old('background_color')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'primary_color', 'label'=>'Primary Color', 'value'=>!empty($data) ? (old('primary_color') ? old('primary_color') : $data->primary_color) : old('primary_color')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'overlay_color', 'label'=>'Overlay Color', 'value'=>!empty($data) ? (old('overlay_color') ? old('overlay_color') : $data->overlay_color) : old('overlay_color')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'lines_color', 'label'=>'Line Color', 'value'=>!empty($data) ? (old('lines_color') ? old('lines_color') : $data->lines_color) : old('lines_color')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'text_color', 'label'=>'Text Color', 'value'=>!empty($data) ? (old('text_color') ? old('text_color') : $data->text_color) : old('text_color')])
                                    </div>
                                    <div class="col-xxl-4 col-md-4">
                                        @include('admin.includes.color_input', ['key'=>'highlight_text_color', 'label'=>'Highlight Text Color', 'value'=>!empty($data) ? (old('highlight_text_color') ? old('highlight_text_color') : $data->highlight_text_color) : old('highlight_text_color')])
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
.addField('#overlay_color', [
    {
      rule: 'required',
      errorMessage: 'Overlay color is required',
    },
  ])
  .addField('#lines_color', [
    {
      rule: 'required',
      errorMessage: 'Line color is required',
    },
  ])
  .addField('#text_color', [
    {
      rule: 'required',
      errorMessage: 'Text color is required',
    },
  ])
  .addField('#highlight_text_color', [
    {
      rule: 'required',
      errorMessage: 'Highlight text color is required',
    },
  ])
  .addField('#background_color', [
    {
      rule: 'required',
      errorMessage: 'Background color is required',
    },
  ])
  .addField('#primary_color', [
    {
      rule: 'required',
      errorMessage: 'Primary color is required',
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('background_color',document.getElementById('background_color').value)
        formData.append('primary_color',document.getElementById('primary_color').value)
        formData.append('text_color',document.getElementById('text_color').value)
        formData.append('highlight_text_color',document.getElementById('highlight_text_color').value)
        formData.append('overlay_color',document.getElementById('overlay_color').value)
        formData.append('lines_color',document.getElementById('lines_color').value)

        const response = await axios.post('{{route('theme.settings.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.text_color){
            validation.showErrors({'#text_color': error?.response?.data?.errors?.text_color[0]})
        }
        if(error?.response?.data?.errors?.highlight_text_color){
            validation.showErrors({'#highlight_text_color': error?.response?.data?.errors?.highlight_text_color[0]})
        }
        if(error?.response?.data?.errors?.lines_color){
            validation.showErrors({'#lines_color': error?.response?.data?.errors?.lines_color[0]})
        }
        if(error?.response?.data?.errors?.overlay_color){
            validation.showErrors({'#overlay_color': error?.response?.data?.errors?.overlay_color[0]})
        }
        if(error?.response?.data?.errors?.background_color){
            validation.showErrors({'#background_color': error?.response?.data?.errors?.background_color[0]})
        }
        if(error?.response?.data?.errors?.primary_color){
            validation.showErrors({'#primary_color': error?.response?.data?.errors?.primary_color[0]})
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
