@extends('main.layouts.index')

@section('css')

    <title>{{ $seo->meta_title }}</title>
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta name="keywords" content="{{ $seo->meta_keywords }}" />

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{ $seo->meta_title }}" />
    <meta property="og:description" content="{{ $seo->meta_description }}" />
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:site_name" content="{{ $seo->meta_title }}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png') }}" />
    <meta name="twitter:label1" content="{{ $seo->meta_title }}" />
    <meta name="twitter:data1" content="{{ $seo->meta_description }}" />

    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="32x32" />
    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}" />

    <link rel="preload" type="image/webp" fetchpriority="high" href="{{ asset('assets/land.webp') }}" as="image">

    {!! $seo->meta_header_script !!}
    {!! $seo->meta_header_no_script !!}

    <style nonce="{{ csp_nonce() }}">
        .pagination-wrap {
            position: relative;
            z-index: 10;
            pointer-events: all;
        }

        .contact .phone,
        .contact .social a {
            color: #000;
        }

        input[type=password].line-gray,
        input[type=email].line-gray,
        input[type=text].line-gray,
        input[type=file].line-gray,
        textarea.line-gray {
            border-bottom: 1px solid black;
        }

        .no-line-heading.sub-title:after {
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

        .about_banner_img {
            border: 1px solid #1c1919;
            padding: 5px;
            border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;
            object-fit: cover;
        }

        .hero .wrap ol li {
            margin-bottom: 10px;
        }
    </style>
@stop

@section('content')

    <section class="hero hero-main section-padding pt-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12" data-animate-effect="fadeInUp">
                    <div class="img fr-img" data-animate-effect="fadeInUp">
                        <img src="{{ asset('assets/land.webp') }}" fetchpriority="high" alt=""
                            class="img-fluid about_banner_img" width="583" height="240">
                    </div>
                    <div class="wrap">
                        {{-- <h1 class="section-title">Dear [ <span style="color: black; text-transform:capitalize">Land Owner</span> ]</h1> --}}
                        <p>We are always on the lookout for good land parcels for residential and commercial development. We
                            would be delighted to receive more information about the land you have available.</p>
                        <p>To better evaluate the land, we kindly request you to provide us with the following details:
                        </p>
                        <ol>
                            <li>
                                Location of the land by providing the Google coordinates. This will allow us to assess the
                                area and its potential.
                            </li>
                            <li>
                                Information about the land, such as its size (in acres or square meters), zoning status
                                (residential, commercial, mixed-use, etc.), any existing structures or developments on the
                                land, and any other relevant details.
                            </li>
                            <li>
                                Terms : Please specify whether the land is available for joint venture (JV) or for sale. If
                                it is for sale, kindly mention the asking price or your expectations regarding the land's
                                value. Additionally, if there are any specific terms and conditions associated with the
                                land, such as development restrictions or legal considerations, please include those as
                                well.
                            </li>
                        </ol>
                        <p>
                            Once we receive the above information, our team will thoroughly evaluate the land's potential
                            and its alignment with our development goals. If we find it suitable, we will get in touch with
                            you to discuss the next steps and negotiate any necessary agreements.
                        </p>
                        <p>
                            Thank you once again for considering us as potential partners for your land development. We look
                            forward to receiving the details and exploring the opportunity further as well.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <h1 class="d-none">{{ $seo->page_keywords }}</h1>
    <h2 class="d-none">{{ $seo->page_keywords }}</h2>

    <div class="contact secondary-div mt-0 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title"><span>Land Owner</span></div>
                    {{-- <p>If you’re looking for a career with us, drop us a line and we’ll get back to you shortly.</p> --}}
                </div>
                <!-- form -->
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="name" id="name" type="text"
                                    placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="email" id="email" type="email"
                                    placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="phone" id="phone" type="text"
                                    placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <select class="line-gray" name="subject" id="subject">
                                    <option value="">Subject</option>
                                    <option value="Land For Joint Development">Land For Joint Development</option>
                                    <option value="Land For Out Rate Purchase">Land For Out Rate Purchase</option>
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="line-gray" name="property_location" id="property_location" cols="30" rows="4"
                                    placeholder="Property Location *" required></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input name="submit" id="submitBtn" type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('js')

    {!! $seo->meta_footer_script_nonce !!}
    {!! $seo->meta_footer_no_script_nonce !!}

    <script nonce="{{ csp_nonce() }}" defer>
        window.addEventListener("load", function() {
            const intlScriptId = "intl-tel-input-script-id";
            let countryData = null;
            let scriptEle = document.createElement("script");
            scriptEle.setAttribute("type", "text/javascript");
            scriptEle.setAttribute("src",
                "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js");
            scriptEle.setAttribute("id", intlScriptId);
            document.body.appendChild(scriptEle);
            scriptEle.addEventListener("load", () => {
                countryData = window.intlTelInput(document.querySelector("#phone"), {
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
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
                }, ])
                .addField('#property_location', [{
                        rule: 'required',
                        errorMessage: 'Property Location is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Property Location is invalid',
                    },
                ])
                .onSuccess(async (event) => {
                    var submitBtn = document.getElementById('submitBtn')
                    submitBtn.value = 'Submitting ...'
                    submitBtn.disabled = true;
                    try {
                        var formData = new FormData();
                        formData.append('name', document.getElementById('name').value)
                        formData.append('email', document.getElementById('email').value)
                        formData.append('phone', document.getElementById('phone').value)
                        formData.append('subject', document.getElementById('subject').value)
                        formData.append('country_code', countryData.getSelectedCountryData().dialCode)
                        formData.append('property_location', document.getElementById('property_location')
                            .value)

                        const response = await axios.post('{{ route('land_owner.post') }}', formData)
                        event.target.reset();
                        successToast(response.data.message)

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
                        if (error?.response?.data?.errors?.property_location) {
                            validation.showErrors({
                                '#property_location': error?.response?.data?.errors
                                    ?.property_location[0]
                            })
                        }
                        if (error?.response?.data?.message) {
                            errorToast(error?.response?.data?.message)
                        }
                    } finally {
                        submitBtn.value = `Submit`
                        submitBtn.disabled = false;
                    }
                });
        });
    </script>

@stop
