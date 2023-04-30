@extends('admin.layouts.dashboard')

@section('css')
    <style nonce="{{ csp_nonce() }}">
        .img-prev{
            height: 500px;
            object-fit: contain
        }
    </style>
@stop

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @include('admin.includes.breadcrumb', ['page'=>'Chatbot Settings', 'page_link'=>route('chatbot.settings.get'), 'list'=>['Update']])
        <!-- end page title -->

        <div class="row" id="image-container">
            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('chatbot.settings.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Chatbot Settings</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-12 col-md-12">
                                        <p>
                                            <code>Note:</code> Right now we support only <b>Artibot</b>
                                        </p>
                                        <p>
                                            <code>Steps to integrate <b>ARTIBOT</b>:</code>
                                        </p>
                                        <ol>
                                            <li>Visit <a href="https://www.artibot.ai" target="_blank" rel="noopener noreferrer"><b>artibot</b></a> website</li><br/>
                                            <li>Register yourself</li><br/>
                                            <li>Create a chat using the available templates</li><br/>
                                            <li>Once you are ready with your chat template, click publish and copy the chatbot snippet from Embed Code in <a href="https://www.artibot.ai" target="_blank" rel="noopener noreferrer"><b>artibot</b></a>
                                                <br/>
                                                <br/>
                                                <b>
                                                    <i>Sample Chatbot Snippet from </i> <a href="https://www.artibot.ai" target="_blank" rel="noopener noreferrer"><b>artibot</b></a> : <br/>
                                                    <br/>
                                                    <img src="{{asset('admin/images/chatbot_snippet.png')}}" alt="" class="img-prev">
                                                </b>
                                                <br/>
                                                <br/>
                                            </li>
                                            <li>Paste the snippet in the textbox given below and click update!</li><br/>
                                            <li>Your chatbot will successfully be integrated into the main website.</li>
                                        </ol>
                                    </div>
                                    <div class="col-xxl-12 col-md-12">
                                        @include('admin.includes.textarea', ['key'=>'chatbot_script', 'label'=>'Chatbot Script', 'value'=>!empty($data) ? (old('chatbot_script') ? old('chatbot_script') : $data->chatbot_script) : old('chatbot_script')])
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
.addField('#chatbot_script', [
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
        formData.append('chatbot_script',document.getElementById('chatbot_script').value)

        const response = await axios.post('{{route('chatbot.settings.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        if(error?.response?.data?.errors?.chatbot_script){
            validation.showErrors({'#chatbot_script': error?.response?.data?.errors?.chatbot_script[0]})
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
