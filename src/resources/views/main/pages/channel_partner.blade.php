@extends('main.layouts.index')

@section('css')

    <title>{{$seo->meta_title}}</title>
    <meta name="description" content="{{$seo->meta_description}}"/>
    <meta name="keywords" content="{{$seo->meta_keywords}}"/>

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{$seo->meta_title}}" />
    <meta property="og:description" content="{{$seo->meta_description}}" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="{{$seo->meta_title}}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:label1" content="{{$seo->meta_title}}" />
    <meta name="twitter:data1" content="{{$seo->meta_description}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

    {!!$seo->meta_header_script!!}
    {!!$seo->meta_header_no_script!!}

    <style nonce="{{ csp_nonce() }}">
        .pagination-wrap {
            position: relative;
            z-index: 10;
            pointer-events: all;
        }
        .contact .phone, .contact .social a {
            color: #000;
        }
        input[type=password].line-gray, input[type=email].line-gray, input[type=text].line-gray, input[type=file].line-gray, textarea.line-gray {
            border-bottom: 1px solid black;
        }
        .no-line-heading.sub-title:after{
            width: 100%;
            left: 0;
        }
        .no-line-heading.sub-title {
            font-size: 20px;
        }
        .hero p {
            font-size: 16px;
            color: #000;
            font-weight: 500;
        }
    </style>
@stop

@section('content')

<section class="hero hero-main section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 " data-animate-effect="fadeInUp">
                <div class="hero">
                    <figure><img src="{{asset('admin/images/maintenance.png')}}" fetchpriority="high" alt="" class="img-fluid about_banner_img"></figure>
                    <div class="caption">
                        <h1 class="section-title">Get associated with <span>SNN</span> Group</h1>
                        <p>At Prestige Group, we value our relationship with our Channel Partners and look forward to building a long term association with mutual benefits.</p>
                        <p>As a Channel Partner you get priority updates on offers and new launches, marketing support and training, invites to exclusive events, attractive commission schemes, timely pay-outs, and much more! Join us today to become an Esteemed Partner and reap the benefits of partnering with Prestige Group.</p>
                        <p>To register as a Channel Partner, reach out to us at channelpartner@prestigeconstructions.com, with the scanned copy of the filled and signed Empanelment Form, along with documents required, or please follow the steps below to register online.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    @include('main.includes.common_contact')


@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

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
