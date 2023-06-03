@extends('main.layouts.index')

@section('content')

    <!-- 404 Section  -->
    <section class="notfound section-padding py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 text-center">
                    <div class="number " data-animate-effect="fadeInUp">{{$status_code}}</div>
                    <div class="title " data-animate-effect="fadeInUp">{{$message}}!</div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')
@stop


@section('js')

    <script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

let uuid = null;
        let link = null;
        var myModal = new bootstrap.Modal(document.getElementById('staticBackdropContact'), {
            keyboard: false
        })

        // initialize the validation library
        const validation = new JustValidate('#contactForm', {
              errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validation
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
          .addField('#phone', [
            {
              rule: 'required',
              errorMessage: 'Phone is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Phone is invalid',
            },
          ])
          .addField('#email', [
            {
                rule: 'required',
                errorMessage: 'Email is required',
            },
            {
                rule: 'email',
                errorMessage: 'Email is invalid!',
            },
          ])
          .addField('#subject', [
            {
              rule: 'required',
              errorMessage: 'Subject is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Subject is invalid',
            },
          ])
          .addField('#message', [
            {
              rule: 'required',
              errorMessage: 'Message is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Message is invalid',
            },
          ])
          .onSuccess(async (event) => {
            var submitBtn = document.getElementById('submitBtn')
            submitBtn.value = 'Sending Message ...'
            submitBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('name',document.getElementById('name').value)
                formData.append('email',document.getElementById('email').value)
                formData.append('phone',document.getElementById('phone').value)
                formData.append('subject',document.getElementById('subject').value)
                formData.append('message',document.getElementById('message').value)
                formData.append('page_url','{{Request::url()}}')

                const response = await axios.post('{{route('contact_page.post')}}', formData)
                event.target.reset();
                uuid = response.data.uuid;
                link = response.data.link;
                myModal.show()

            }catch (error){
                if(error?.response?.data?.errors?.name){
                    validation.showErrors({'#name': error?.response?.data?.errors?.name[0]})
                }
                if(error?.response?.data?.errors?.email){
                    validation.showErrors({'#email': error?.response?.data?.errors?.email[0]})
                }
                if(error?.response?.data?.errors?.phone){
                    validation.showErrors({'#phone': error?.response?.data?.errors?.phone[0]})
                }
                if(error?.response?.data?.errors?.subject){
                    validation.showErrors({'#subject': error?.response?.data?.errors?.subject[0]})
                }
                if(error?.response?.data?.errors?.message){
                    validation.showErrors({'#message': error?.response?.data?.errors?.message[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitBtn.value =  `Send Message`
                submitBtn.disabled = false;
            }
          });

          // initialize the validation library
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
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'OTP is invalid',
            },
          ])
          .onSuccess(async (event) => {
            var submitOtpBtn = document.getElementById('submitOtpBtn')
            submitOtpBtn.value = 'Submitting ...'
            submitOtpBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('otp',document.getElementById('otp').value)

                const response = await axios.post(link, formData)
                event.target.reset();
                uuid = null;
                link = null;
                myModal.hide()
                successToast(response.data.message)
            }catch (error){
                if(error?.response?.data?.errors?.otp){
                    validationOtp.showErrors({'#otp': error?.response?.data?.errors?.otp[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitOtpBtn.value =  `Submit`
                submitOtpBtn.disabled = false;
            }
          });

          document.getElementById('resendOtpBtn').addEventListener('click', async function(event){
            if(uuid){
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('uuid',uuid)
                    const response = await axios.post('{{route('contact_page.resendOtp')}}', formData)
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

@stop

