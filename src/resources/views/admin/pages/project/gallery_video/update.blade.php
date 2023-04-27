@extends('admin.layouts.dashboard')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list projects')
        @include('admin.includes.breadcrumb', ['page'=>'Gallery Video', 'page_link'=>route('project.gallery_video.paginate.get', $project_id), 'list'=>['Update']])
        @endcan
        <!-- end page title -->

        <div class="row" id="video-container">
            @include('admin.includes.back_button', ['link'=>route('project.gallery_video.paginate.get', $project_id)])
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('project.gallery_video.update.post', [$project_id, $data->id])}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Gallery Video Detail</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'video', 'label'=>'Video', 'value'=>$data->video])
                                        <p>
                                            <code>Note: </code> Youtube video should follow the given format : <i>https://www.youtube.com/embed/aUIVH5qg19A</i>
                                        </p>
                                    </div>

                                    <div class="col-xxl-6 col-md-6">
                                        @include('admin.includes.input', ['key'=>'video_title', 'label'=>'Video Title', 'value'=>$data->video_title])
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mt-4 mt-md-0">
                                            <div>
                                                <div class="form-check form-switch form-check-right mb-2">
                                                    <input class="form-check-input" type="checkbox" role="switch" id="is_draft" name="is_draft" {{$data->is_draft==false ? '' : 'checked'}}>
                                                    <label class="form-check-label" for="is_draft">Gallery Video Status</label>
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

<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
.addField('#video_title', [
    {
      rule: 'required',
      errorMessage: 'Video Title is required',
    },
  ])
  .addField('#video', [
    {
      rule: 'required',
      errorMessage: 'Video is required',
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('is_draft',document.getElementById('is_draft').checked ? 1 : 0)
        formData.append('video',document.getElementById('video').value)
        formData.append('video_title',document.getElementById('video_title').value)

        const response = await axios.post('{{route('project.gallery_video.update.post', [$project_id, $data->id])}}', formData)
        successToast(response.data.message)
    }catch (error){
        if(error?.response?.data?.errors?.video_title){
            validation.showErrors({'#video_title': error?.response?.data?.errors?.video_title[0]})
        }
        if(error?.response?.data?.errors?.video){
            validation.showErrors({'#video': error?.response?.data?.errors?.video[0]})
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
