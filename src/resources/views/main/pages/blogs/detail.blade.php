@extends('main.layouts.index')

@section('css')

    <title>{{$data->meta_title}}</title>
    <meta name="description" content="{{$data->meta_description}}"/>
    <meta name="keywords" content="{{$data->meta_keywords}}"/>

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{$data->meta_title}}" />
    <meta property="og:description" content="{{$data->meta_description}}" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="{{$data->meta_title}}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:label1" content="{{$data->meta_title}}" />
    <meta name="twitter:data1" content="{{$data->meta_description}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

    {!!$data->meta_header_script!!}
    {!!$data->meta_header_no_script!!}

    <style nonce="{{ csp_nonce() }}">
        .process .wrap{
            padding: 0;
        }
        .process .wrap, .process .wrap .cont{
            display: inline;
        }
        .contact .phone, .contact .social a {
            color: #000;
        }

        .duru-header {
            position: fixed;
        }

        .suffix-div{
            background: white;
            padding: 0 !important;
        }

        .blog_image_banner{
            width: 100%;
            height: auto;
        }

        .blog_image_banner img{
            width: 100%;
            height: 100dvh;
            object-fit: cover;
        }

        .blog_content h1, .blog_content h2, .blog_content h3, .blog_content h4, .blog_content h5, .blog_content h6{
            color: var(--theme-highlight-text-color) !important;
        }

        .blog_content p {
            color: var(--theme-text-color) !important;
        }

        @media screen and (max-width: 600px) {
            .blog_image_banner img{
                height: 100%;
            }

            .post h2{
                font-size: 25px;
            }
        }
    </style>

@stop

@section('content')

<h1 class="d-none">{{$data->page_keywords}}</h1>
<h2 class="d-none">{{$data->page_keywords}}</h2>

<!-- Post  -->
<section class="post suffix-div mt-0">
    <div class="blog_image_banner">
        <img data-src="{{$data->image_link}}" class="img-responsive lazyload" alt="{{$data->heading}}" title="{{$data->heading}}">
    </div>
    <div class="container pt-5 pb-5 blog_content">
        <div class="row">
            <div class="col-md-12 " data-animate-effect="fadeInUp">
                <div class="date"> <span class="ti-time"></span> {{$data->created_at->format('M d, Y h:i A')}}</div>
                <h2>{!!$data->heading!!}</h2>
                <div class="desc-ul">
                    {!!$data->description!!}
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Prev-Next -->
@if($next || $prev)
<div class="prev-next">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-sm-flex align-items-center justify-content-between">
                    @if($next)
                    <div class="prev-next-left">
                        <a aria-label="{{$next->name}}" href="{{route('blogs_detail.get', $next->slug)}}"> <i class="ti-arrow-left"></i> {{$next->name}}</a>
                    </div>
                    @endif
                    <a aria-label="blogs" href="{{route('blogs.get')}}"><i class="ti-layout-grid3-alt"></i></a>
                    @if($prev)
                    <div class="prev-next-right">
                        <a aria-label="{{$prev->name}}" href="{{route('blogs_detail.get', $prev->slug)}}"> {{$prev->name}} <i class="ti-arrow-right"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

    @include('main.includes.common_contact')

@stop

@section('js')

    {!!$data->meta_footer_script_nonce!!}
    {!!$data->meta_footer_no_script_nonce!!}

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
