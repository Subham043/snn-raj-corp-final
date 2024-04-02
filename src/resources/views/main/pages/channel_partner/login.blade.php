<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SnnRajCorp - Campaign Form</title>
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
                    <div class="form-items" id="contactFormDiv">
                        <div class="website-logo-inside">
                            <h3>Channel Partner Login.</h3>
                        </div>
                        <form id="contactForm">
                            <div>
                                <input class="form-control" type="text" name="phone" id="phone" placeholder="Channel Partner Regd. Phone" required>
                            </div>
                            <div class="form-button">
                                <button id="submitBtn" type="submit" class="ibtn">Send OTP</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-items d-none" id="otpFormDiv">
                        <div class="website-logo-inside">
                            <h3>Verify Mobile Number.</h3>
                        </div>
                        <form id="otpForm">
                            <div>
                                <input type="text" class="form-control" id="otp" name="otp" aria-describedby="otpHelp" placeholder="OTP *">
                                <div id="otpHelp" class="form-text">We have shared an OTP to your mobile via SMS.</div>
                            </div>
                            <div class="form-button">
                                <button aria-label="Submit Otp" type="submit" id="submitOtpBtn" class="btn btn-light ibtn">Verify</button>
                                <button aria-label="Resend Otp" type="button" id="resendOtpBtn" class="btn btn-danger">Resend OTP</button>
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

    let phone = null;

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

      // initialize the validation library
    const validation = new JustValidate('#contactForm', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation
      .addField('#phone', [
        {
          rule: 'required',
          errorMessage: 'Phone is required',
        },
      ])
      .onSuccess(async (event) => {
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.value = 'Sending OTP ...'
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('channel_partner_phone',document.getElementById('phone').value)

            const response = await axios.post('{{route('channel_partner_form.login_post')}}', formData)
            phone = document.getElementById('phone').value;
            document.getElementById('contactFormDiv').classList.add('d-none')
            document.getElementById('otpFormDiv').classList.remove('d-none')
            event.target.reset();
            successToast(response.data.message)

        }catch (error){
            if(error?.response?.data?.errors?.phone){
                validationVerify.showErrors({'#phone': error?.response?.data?.errors?.phone[0]})
            }
            if(error?.response?.data?.message){
                errorToast(error?.response?.data?.message)
            }
        }finally{
            submitBtn.value =  `Send OTP`
            submitBtn.disabled = false;
        }
      });

      const validationOtp = new JustValidate('#otpForm', {
              errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validationOtp
          .addField('#otp', [
            {
              rule: 'required',
              errorMessage: 'OTP is required',
            },
          ])
          .onSuccess(async (event) => {
            var submitOtpBtn = document.getElementById('submitOtpBtn')
            submitOtpBtn.value = 'Verifying ...'
            submitOtpBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('channel_partner_phone',phone)
                formData.append('otp',document.getElementById('otp').value)

                const response = await axios.post('{{route('channel_partner_form.verify_post')}}', formData)
                event.target.reset();
                phone = null;
                document.getElementById('contactFormDiv').classList.remove('d-none')
                document.getElementById('otpFormDiv').classList.add('d-none')
                successToast(response.data.message)
                setInterval(window.location.replace("{{route('channel_partner_form.data')}}"), 1500);
            }catch (error){
                if(error?.response?.data?.errors?.otp){
                    validationOtp.showErrors({'#otp': error?.response?.data?.errors?.otp[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitOtpBtn.value =  `Verify`
                submitOtpBtn.disabled = false;
            }
          });

          document.getElementById('resendOtpBtn').addEventListener('click', async function(event){
            if(phone){
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('channel_partner_phone',phone)
                    const response = await axios.post('{{route('channel_partner_form.resend_post')}}', formData)
                    successToast(response.data.message)
                }catch (error){
                    if(error?.response?.data?.message){
                        errorToast(error?.response?.data?.message)
                    }
                }finally{
                    event.target.innerText = 'Resend OTP'
                    event.target.disabled = false;
                }
            }
          })


</script>
</html>
