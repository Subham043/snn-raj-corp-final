@extends('main.layouts.index')

@section('css')

    <title>{!!$data->popup_button_text!!}</title>

    <meta property="og:locale" content="en_US" />
	<meta property="og:type" content="profile" />
	<meta property="og:title" content="{!!$data->popup_button_text!!}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{!!$data->popup_button_text!!}" />
	<meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:label1" content="{!!$data->popup_button_text!!}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

    <style>
        .no-line-heading.sub-title:after{
            width: 100%;
            left: 0;
        }
        .no-line-heading.sub-title {
            font-size: 20px;
        }
        .contact .phone, .contact .social a {
            color: #000;
        }

        .about_content h1, .about_content h1 span, .about_content h2, .about_content h3, .about_content h4, .about_content h5, .about_content h6{
            color: var(--theme-highlight-text-color) !important;
        }

        .about_content p {
            color: var(--theme-text-color) !important;
        }
    </style>

@stop

@section('content')

    <!-- Legal -->
    <section class="py-3">
        <div class="background bg-img bg-fixed" data-overlay-dark="6">
            <div class="container about_content">
                <div class="row align-items-center">
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <div class="desc-ul">
                            {!!$data->popup_description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')

@stop


@section('js')

    <script src="{{ asset('assets/js/plugins/intlTelInput.min.js')}}"></script>

    <script nonce="{{ csp_nonce() }}" defer>
        window.addEventListener("load", function() {
            const intlScriptId = "intl-tel-input-script-id";
            let countryData = null;
            let scriptEle = document.createElement("script");
            scriptEle.setAttribute("type", "text/javascript");
            scriptEle.setAttribute("src",
                "{{ asset('assets/js/plugins/intlTelInput.min.js')}}");
            scriptEle.setAttribute("id", intlScriptId);
            document.body.appendChild(scriptEle);
            scriptEle.addEventListener("load", () => {
                countryData = window.intlTelInput(document.querySelector("#phone"), {
                    utilsScript: "{{ asset('assets/js/plugins/intlTelInput.utils.js')}}",
                    autoInsertDialCode: true,
                    initialCountry: "in",
                    geoIpLookup: callback => {
                        fetch("https://ipapi.co/json")
                            .then(res => res.json())
                            .then(data => callback(data.country_code))
                            .catch(() => callback("in"));
                    },
                });
            });

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
                .addField('#name', [{
                        rule: 'required',
                        errorMessage: 'Name is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Name is invalid',
                    },
                ])
                .addField('#phone', [{
                        rule: 'required',
                        errorMessage: 'Phone is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Phone is invalid',
                    },
                ])
                .addField('#email', [{
                        rule: 'required',
                        errorMessage: 'Email is required',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Email is invalid!',
                    },
                ])
                .addField('#subject', [{
                        rule: 'required',
                        errorMessage: 'Subject is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Subject is invalid',
                    },
                ])
                .addField('#message', [{
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
                        formData.append('name', document.getElementById('name').value)
                        formData.append('email', document.getElementById('email').value)
                        formData.append('phone', document.getElementById('phone').value)
                        formData.append('subject', document.getElementById('subject').value)
                        formData.append('message', document.getElementById('message').value)
                        formData.append('country_code', countryData.getSelectedCountryData().dialCode)
                        formData.append('page_url', '{{ Request::url() }}')

                        const response = await axios.post('{{ route('contact_page.post') }}', formData)
                        event.target.reset();
                        uuid = response.data.uuid;
                        link = response.data.link;
                        myModal.show()

                    } catch (error) {
                        if (error?.response?.data?.errors?.name) {
                            validation.showErrors({
                                '#name': error?.response?.data?.errors?.name[0]
                            })
                        }
                        if (error?.response?.data?.errors?.email) {
                            validation.showErrors({
                                '#email': error?.response?.data?.errors?.email[0]
                            })
                        }
                        if (error?.response?.data?.errors?.phone) {
                            validation.showErrors({
                                '#phone': error?.response?.data?.errors?.phone[0]
                            })
                        }
                        if (error?.response?.data?.errors?.subject) {
                            validation.showErrors({
                                '#subject': error?.response?.data?.errors?.subject[0]
                            })
                        }
                        if (error?.response?.data?.errors?.message) {
                            validation.showErrors({
                                '#message': error?.response?.data?.errors?.message[0]
                            })
                        }
                        if (error?.response?.data?.message) {
                            errorToast(error?.response?.data?.message)
                        }
                    } finally {
                        submitBtn.value = `Send Message`
                        submitBtn.disabled = false;
                    }
                });

            // initialize the validation library
            const validationOtp = new JustValidate('#otpForm', {
                errorFieldCssClass: 'is-invalid',
            });
            // apply rules to form fields
            validationOtp
                .addField('#otp', [{
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
                        formData.append('otp', document.getElementById('otp').value)

                        const response = await axios.post(link, formData)
                        event.target.reset();
                        uuid = null;
                        link = null;
                        myModal.hide()
                        successToast(response.data.message)
                    } catch (error) {
                        if (error?.response?.data?.errors?.otp) {
                            validationOtp.showErrors({
                                '#otp': error?.response?.data?.errors?.otp[0]
                            })
                        }
                        if (error?.response?.data?.message) {
                            errorToast(error?.response?.data?.message)
                        }
                    } finally {
                        submitOtpBtn.value = `Submit`
                        submitOtpBtn.disabled = false;
                    }
                });

            document.getElementById('resendOtpBtn').addEventListener('click', async function(event) {
                if (uuid) {
                    event.target.innerText = 'Sending ...'
                    event.target.disabled = true;
                    try {
                        var formData = new FormData();
                        formData.append('uuid', uuid)
                        const response = await axios.post('{{ route('contact_page.resendOtp') }}',
                            formData)
                        successToast(response.data.message)
                    } catch (error) {
                        if (error?.response?.data?.message) {
                            errorToast(error?.response?.data?.message)
                        }
                    } finally {
                        event.target.innerText = 'Resend OTP'
                        event.target.disabled = false;
                    }
                }
            })
        });
    </script>

@stop
