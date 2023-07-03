<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SnnRajCorp - Free Ad Form</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/logo.png') }}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iofrm-style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iofrm-theme27.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iziToast.min.css')}}" rel="stylesheet" type="text/css" />
    <style nonce="{{ csp_nonce() }}">
       .form-holder .form-content{
        z-index: 9999;
       }
       .website-logo-inside {
            margin-bottom: 10px;
        }
        .img-holder .info-holder img {
            width: auto;
            max-width: 375px;
            height: 200px;
        }
        .form-content, body, .form-body {
            background-color: #1c1919;
        }
        .form-content .form-button .ibtn {
            background-color: #fff;
            color: #1c1919;
        }
        .form-content input, .form-content .dropdown-toggle.btn-default {
            border: 0;
            background-color: #fff;
            font-weight: 700;
            color: #1c1919;
        }
        .just-validate-error-label{
            margin-bottom: 10px;
        }
        @media (max-width: 765px){
            .img-holder {
                min-height: 1px;
                height: auto;
            }
        }

        select.form-control, select.form-control:focus{
            background: white;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder col-lg-4 col-md-6 col-sm-12">
                <div class="bg"></div>
                <div class="info-holder">
                    <a href="{{route('home_page.get')}}">
                        <div class="logo">
                            <img class="logo-size" src="{{ asset('admin/images/logo.png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
            <div class="form-holder col-lg-8 col-md-6 col-sm-12">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <h3>Free Ad Form.</h3>
                        </div>
                        <form id="verifyForm">
                            <div>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Name" required>
                            </div>
                            <div>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email">
                            </div>
                            <div>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="Phone" required>
                            </div>
                            <div class="form-button">
                                <button id="submitBtnVerify" type="submit" class="ibtn">Verify</button>
                            </div>
                        </form>
                        <form id="contactForm" style="display: none">
                            <div>
                                <select class="form-control" name="project" id="project" required>
                                    <option value="">Project</option>
                                    @foreach($projects as $p)
                                        <option value="{{$p->name}}">{{$p->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input class="form-control" type="text" name="source" id="source" placeholder="Source" required>
                            </div>
                            <div>
                                <input class="form-control" type="text" name="executive_name" id="executive_name" placeholder="Executive Name" required>
                            </div>
                            <div class="form-button">
                                <button id="submitBtn" type="submit" class="ibtn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/iziToast.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
<script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

    const errorToast = (message) =>{
        iziToast.error({
            title: 'Error',
            message: message,
            position: 'bottomCenter',
            timeout:7000
        });
    }
    const successToast = (message) =>{
        iziToast.success({
            title: 'Success',
            message: message,
            position: 'bottomCenter',
            timeout:6000
        });
    }

    let nameValue = null;
    let emailValue = null;
    let phoneValue = null;


    // initialize the validation library
    const validationVerify = new JustValidate('#verifyForm', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validationVerify
      .addField('#name', [
        {
          rule: 'required',
          errorMessage: 'Name is required',
        },
      ])
      .addField('#phone', [
        {
          rule: 'required',
          errorMessage: 'Phone is required',
        },
      ])
      .addField('#email', [
        {
            rule: 'email',
            errorMessage: 'Email is invalid!',
        },
      ])
      .onSuccess(async (event) => {
        var submitBtn = document.getElementById('submitBtnVerify')
        submitBtn.value = 'Verifying ...'
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('name').value)
            formData.append('email',document.getElementById('email').value)
            formData.append('phone',document.getElementById('phone').value)

            const response = await axios.post('{{route('free_ad_form.verify')}}', formData)
            successToast(response.data.message)
            event.target.reset();

        }catch (error){
            if(error?.response?.data?.errors?.name){
                validationVerify.showErrors({'#name': error?.response?.data?.errors?.name[0]})
            }
            if(error?.response?.data?.errors?.email){
                validationVerify.showErrors({'#email': error?.response?.data?.errors?.email[0]})
            }
            if(error?.response?.data?.errors?.phone){
                validationVerify.showErrors({'#phone': error?.response?.data?.errors?.phone[0]})
            }
            if(error?.response?.data?.message){
                errorToast(error?.response?.data?.message)
                nameValue = document.getElementById('name').value;
                if(document.getElementById('email').value.length>0){
                    emailValue = document.getElementById('email').value;
                }
                phoneValue = document.getElementById('phone').value;
                event.target.style.display = "none";
                event.target.reset();
                document.getElementById('contactForm').style.display = "block";
            }
        }finally{
            submitBtn.value =  `Verify`
            submitBtn.disabled = false;
        }
      });

      // initialize the validation library
    const validation = new JustValidate('#contactForm', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation
      .addField('#project', [
        {
          rule: 'required',
          errorMessage: 'Project is required',
        },
      ])
      .addField('#source', [
        {
          rule: 'required',
          errorMessage: 'Source is required',
        },
      ])
      .addField('#executive_name', [
        {
          rule: 'required',
          errorMessage: 'Executive Name is required',
        },
      ])
      .onSuccess(async (event) => {
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.value = 'Submitting ...'
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',nameValue)
            formData.append('email',emailValue)
            formData.append('phone',phoneValue)
            formData.append('project',document.getElementById('project').value)
            formData.append('source',document.getElementById('source').value)
            formData.append('executive_name',document.getElementById('executive_name').value)

            const response = await axios.post('{{route('free_ad_form.post')}}', formData)
            event.target.reset();
            nameValue = null;
            emailValue = null;
            phoneValue = null;
            event.target.style.display = "none";
            document.getElementById('verifyForm').style.display = "block";
            successToast(response.data.message)

        }catch (error){
            if(error?.response?.data?.errors?.project){
                validation.showErrors({'#project': error?.response?.data?.errors?.project[0]})
            }
            if(error?.response?.data?.errors?.executive_name){
                validation.showErrors({'#executive_name': error?.response?.data?.errors?.executive_name[0]})
            }
            if(error?.response?.data?.errors?.source){
                validation.showErrors({'#source': error?.response?.data?.errors?.source[0]})
            }
            if(error?.response?.data?.message){
                errorToast(error?.response?.data?.message)
            }
        }finally{
            submitBtn.value =  `Submit`
            submitBtn.disabled = false;
        }
      });


</script>
</html>
