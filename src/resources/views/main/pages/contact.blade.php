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
    </style>
@stop

@section('content')


    <h1 class="d-none">{{$seo->page_keywords}}</h1>
    <h2 class="d-none">{{$seo->page_keywords}}</h2>

    <!-- Contact -->
    <div class="contact secondary-div mt-0">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="no-line-heading sub-title border-bot-light">Contact</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Get in <span>touch</span></div>
                    <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line and we’ll get back to you shortly.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <!-- Contact Info -->
                    <p>{{ empty($generalSetting) ? '' : $generalSetting->address}}</p>
                    <a aria-label="phone" href="tel:{{ empty($generalSetting) ? '' : $generalSetting->phone}}" class="phone">{{ empty($generalSetting) ? '' : $generalSetting->phone}}</a>
                    <a aria-label="email" href="mailto:{{ empty($generalSetting) ? '' : $generalSetting->email}}" class="mail">{{ empty($generalSetting) ? '' : $generalSetting->email}}</a>
                    <div class="social mt-2">
                        <a aria-label="facebook" href="{{ empty($generalSetting) ? '' : $generalSetting->facebook}}"><i class="ti-facebook"></i></a>
                        <a aria-label="instagram" href="{{ empty($generalSetting) ? '' : $generalSetting->instagram}}"><i class="ti-instagram"></i></a>
                        <a aria-label="linkedin" href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin}}"><i class="ti-linkedin"></i></a>
                        <a aria-label="youtube" href="{{ empty($generalSetting) ? '' : $generalSetting->youtube}}"><i class="ti-youtube"></i></a>
                    </div>
                </div>
                <!-- form -->
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="name" id="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="email" id="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="phone" id="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="subject" id="subject" type="text" placeholder="Subject *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="line-gray" name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="col-md-12 mt-3 mb-5">
                                    <input type="checkbox" class="line-gray">
                                    <label>I authorize SNN Raj Corp and its representatives to call, SMS, email, or WhatsApp me about its products and offers, this consent overrides any registration for DNC / NDNC</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input name="submit" id="submitBtn" type="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Verify Mobile Number</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="otpForm" method="post">
                        <div class="mb-3">
                          <input type="text" class="form-control" id="otp" name="otp" aria-describedby="otpHelp" placeholder="OTP *">
                          <div id="otpHelp" class="form-text">We have shared an OTP to your mobile via SMS.</div>
                        </div>
                        <button type="submit" id="submitOtpBtn" class="btn btn-dark">Submit</button>
                        <button type="button" id="resendOtpBtn" class="btn btn-danger">Resend OTP</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @include('main.includes.referal')

    <div class="py-3"></div>

    <!-- Maps -->
    {{-- <div class="google-maps">
        <iframe id="gmap_canvas"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13419.032130422971!2d-79.94077173022463!3d32.772154400000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88fe7a1ae84ff639%3A0xe5c782f71924a526!2s24%20King%20St%2C%20Charleston%2C%20SC%2029401%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1665070628853!5m2!1str!2str"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> --}}


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
