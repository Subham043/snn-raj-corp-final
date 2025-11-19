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

    <link rel="preload" as="script" href="{{ asset('assets/js/plugins/owl.carousel.min.js') }}">
    <link rel="preload" as="script" href="{{ asset('assets/js/referral.js') }}">

    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="32x32" />
    <link rel="icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}"
        sizes="192x192" />
    <link rel="apple-touch-icon"
        href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link }}" />
    @if (count($banner) > 0)
        <link rel="preload" as="image" href="{{ $banner[0]->image_link }}" type="image/webp">
    @endif

    {!! $seo->meta_header_script_nonce !!}
    {!! $seo->meta_header_no_script_nonce !!}

    @vite(['resources/css/owl.carousel.min.css', 'resources/css/owl.theme.default.min.css'])

    <style nonce="{{ csp_nonce() }}">

        .slider-fade .v-middle {
            position: relative;
            transform: none;
            top: 0;
            left: 0;
        }

        .header.slider-fade {
            min-height: 1px;
            height: auto;
            overflow: hidden;
            background: transparent !important;
        }

        .slider-fade .slider .owl-item,
        .slider-fade .owl-item {
            height: auto;
            position: relative;
        }

        .slider-fade .slider .item,
        .slider-fade .item {
            position: static;
            background-image: none !important;
        }

        .slider-fade .owl-carousel .owl-stage:after,
        #slider-area:after {
            content: none;
        }

        @media screen and (max-width: 600px) {
            #slider-area img {
                opacity: 1;
            }
        }

        .duru-header {
            position: fixed;
        }

        .owl-carousel .owl-item img {
            display: block;
            width: 100%;
            height: 100dvh;
            object-fit: cover;
        }

        #slider-area {
            min-height: 644px;
        }

        .contact .phone, .contact .social a {
            color: #000;
        }

        @media screen and (max-width: 600px) {
            #slider-area {
                min-height: auto;
            }

            .owl-carousel .owl-item img{
                height: 100%;
            }
        }

    </style>

@stop

@section('content')

    @if (count($banner) > 0)
        <header id="slider-area" class="header slider-fade">
            <div class="owl-carousel owl-theme">
                <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                @foreach ($banner as $k => $banner)
                    @if ($k == 0)
                        <div class="text-left item bg-img" data-overlay-dark="4">
                            <div class="v-middle caption">
                                <img src="{{ $banner->image_link }}" class="lazyload"
                                    alt="{{ $banner->image_alt }}" title="{{ $banner->image_title }}"
                                    width="1415" height="640" fetchpriority="high">
                            </div>
                        </div>
                    @else
                        <div class="text-left item bg-img" data-overlay-dark="4">
                            <div class="v-middle caption">
                                <img data-src="{{ $banner->image_link }}" class="lazyload"
                                    alt="{{ $banner->image_alt }}" title="{{ $banner->image_title }}"
                                    width="1415" height="640" fetchpriority="low">
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="slide-num" id="snh-1"></div>
            <div class="slider__progress"><span></span></div>
        </header>
    @endif

    <h1 class="d-none">{{ $seo->page_keywords }}</h1>
    <h2 class="d-none">{{ $seo->page_keywords }}</h2>

    <!-- Contact -->
    <div class="contact secondary-div mt-0">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="no-line-heading sub-title border-bot-light pb-0">REFERRAL PROGRAM</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Existing Customer Details</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <!-- Contact Info -->
                    <p>{{ empty($generalSetting) ? '' : $generalSetting->address }}</p>
                    <a aria-label="phone" href="tel:{{ empty($generalSetting) ? '' : $generalSetting->phone }}"
                        class="phone">{{ empty($generalSetting) ? '' : $generalSetting->phone }}</a>
                    <a aria-label="email" href="mailto:{{ empty($generalSetting) ? '' : $generalSetting->email }}"
                        class="mail">{{ empty($generalSetting) ? '' : $generalSetting->email }}</a>
                    <div class="social mt-2">
                        <a aria-label="facebook" target="_blank" href="{{ empty($generalSetting) ? '' : $generalSetting->facebook }}"><i
                                class="ti-facebook"></i></a>
                        <a aria-label="instagram" target="_blank" href="{{ empty($generalSetting) ? '' : $generalSetting->instagram }}"><i
                                class="ti-instagram"></i></a>
                        <a aria-label="linkedin" target="_blank" href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin }}"><i
                                class="ti-linkedin"></i></a>
                        <a aria-label="youtube" target="_blank" href="{{ empty($generalSetting) ? '' : $generalSetting->youtube }}"><i
                                class="ti-youtube"></i></a>
                    </div>
                </div>
                <!-- form -->
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="member_name" id="member_name" type="text"
                                    placeholder="Name *" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="member_email" id="member_email" type="email"
                                    placeholder="Email *" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="member_phone" id="member_phone" type="text"
                                    placeholder="Phone *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <select class="line-gray" name="member_project_id" id="member_project_id" aria-label="Project Name"
                                    required>
                                    <option value="">Project Name *</option>
                                    @foreach ($projects as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="member_unit" id="member_unit" type="text"
                                    placeholder="Unit *" required>
                            </div>
                            <div class="section-title my-5">REFERENCE OF NEW BUYER</div>
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="referal_name" id="referal_name" type="text"
                                    placeholder="Name *" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="referal_email" id="referal_email" type="email"
                                    placeholder="Email *" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <input class="line-gray" name="referal_phone" id="referal_phone" type="text"
                                    placeholder="Phone *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="referal_relation" id="referal_relation"
                                    type="text" placeholder="Relation *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <select class="line-gray" name="referal_project_id" id="referal_project_id" aria-label="Project Name"
                                    required>
                                    <option value="">Project Name *</option>
                                    @foreach ($projects as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="col-md-12 mt-3 mb-5">
                                    <input type="checkbox" class="line-gray" id="consent">
                                    <label for="consent">I agree with the <a href="{{ route('legal.get', 'privacy-policy') }}"
                                            aria-label="privacy policy" class="underline line-gray">privacy
                                            policy</a></label>
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

@stop

@section('js')
    <script src="{{ asset('assets/js/plugins/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/referral.js') }}" defer></script>

    {!! $seo->meta_footer_script_nonce !!}
    {!! $seo->meta_footer_no_script_nonce !!}

    <script type='text/javascript' nonce="{{ csp_nonce() }}">
    (function() {
        const loadPlumb5 = () => {
            const s = document.createElement('script');
            s.src = "https://src.plumb5.com/snnrajcorp_com.js";
            s.async = true;
            document.body.appendChild(s);
        };

        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(loadPlumb5);
        } else {
            // Fallback after the page becomes usable
            setTimeout(loadPlumb5, 1500);
        }
    })();
    </script>

    <script type='text/javascript' nonce="{{ csp_nonce() }}">
        window.addEventListener("load", function() {
            const intlScriptId = "intl-tel-input-script-id";
            let countryData1 = null;
            let countryData2 = null;
            let scriptEle = document.createElement("script");
            scriptEle.setAttribute("type", "text/javascript");
            scriptEle.setAttribute("src",
                "{{ asset('assets/js/plugins/intlTelInput.min.js')}}");
            scriptEle.setAttribute("id", intlScriptId);
            document.body.appendChild(scriptEle);
            scriptEle.addEventListener("load", () => {
                countryData1 = window.intlTelInput(document.querySelector("#member_phone"), {
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
                countryData2 = window.intlTelInput(document.querySelector("#referal_phone"), {
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

            // initialize the validation library
            const validation = new JustValidate('#contactForm', {
                errorFieldCssClass: 'is-invalid',
            });
            // apply rules to form fields
            validation
                .addField('#member_name', [{
                        rule: 'required',
                        errorMessage: 'Name is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Name is invalid',
                    },
                ])
                .addField('#member_phone', [{
                        rule: 'required',
                        errorMessage: 'Phone is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Phone is invalid',
                    },
                ])
                .addField('#member_email', [{
                        rule: 'required',
                        errorMessage: 'Email is required',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Email is invalid!',
                    },
                ])
                .addField('#member_unit', [{
                        rule: 'required',
                        errorMessage: 'Unit is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Unit is invalid',
                    },
                ])
                .addField('#member_project_id', [{
                    rule: 'required',
                    errorMessage: 'Message is required',
                }, ])
                .addField('#referal_name', [{
                        rule: 'required',
                        errorMessage: 'Name is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Name is invalid',
                    },
                ])
                .addField('#referal_phone', [{
                        rule: 'required',
                        errorMessage: 'Phone is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Phone is invalid',
                    },
                ])
                .addField('#referal_email', [{
                        rule: 'required',
                        errorMessage: 'Email is required',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Email is invalid!',
                    },
                ])
                .addField('#referal_relation', [{
                        rule: 'required',
                        errorMessage: 'Relation is required',
                    },
                    {
                        rule: 'customRegexp',
                        value: COMMON_REGEX,
                        errorMessage: 'Relation is invalid',
                    },
                ])
                .addField('#referal_project_id', [{
                    rule: 'required',
                    errorMessage: 'Message is required',
                }, ])
                .onSuccess(async (event) => {
                    var submitBtn = document.getElementById('submitBtn')
                    submitBtn.value = 'Sending Message ...'
                    submitBtn.disabled = true;
                    try {
                        var formData = new FormData();
                        formData.append('member_name', document.getElementById('member_name').value)
                        formData.append('member_email', document.getElementById('member_email').value)
                        formData.append('member_phone', document.getElementById('member_phone').value)
                        formData.append('country_code_1', countryData1.getSelectedCountryData().dialCode)
                        formData.append('member_unit', document.getElementById('member_unit').value)
                        formData.append('member_project_id', document.getElementById('member_project_id')
                            .value)
                        formData.append('referal_name', document.getElementById('referal_name').value)
                        formData.append('referal_email', document.getElementById('referal_email').value)
                        formData.append('referal_phone', document.getElementById('referal_phone').value)
                        formData.append('country_code_2', countryData2.getSelectedCountryData().dialCode)
                        formData.append('referal_relation', document.getElementById('referal_relation')
                            .value)
                        formData.append('referal_project_id', document.getElementById('referal_project_id')
                            .value)

                        const response = await axios.post('{{ route('referal_page.post') }}', formData)
                        successToast(response.data.message)
                        event.target.reset();

                    } catch (error) {
                        if (error?.response?.data?.errors?.member_name) {
                            validation.showErrors({
                                '#member_name': error?.response?.data?.errors?.member_name[0]
                            })
                        }
                        if (error?.response?.data?.errors?.member_email) {
                            validation.showErrors({
                                '#member_email': error?.response?.data?.errors?.member_email[0]
                            })
                        }
                        if (error?.response?.data?.errors?.member_phone) {
                            validation.showErrors({
                                '#member_phone': error?.response?.data?.errors?.member_phone[0]
                            })
                        }
                        if (error?.response?.data?.errors?.member_unit) {
                            validation.showErrors({
                                '#member_unit': error?.response?.data?.errors?.member_unit[0]
                            })
                        }
                        if (error?.response?.data?.errors?.member_project_id) {
                            validation.showErrors({
                                '#member_project_id': error?.response?.data?.errors
                                    ?.member_project_id[0]
                            })
                        }
                        if (error?.response?.data?.errors?.referal_name) {
                            validation.showErrors({
                                '#referal_name': error?.response?.data?.errors?.referal_name[0]
                            })
                        }
                        if (error?.response?.data?.errors?.referal_email) {
                            validation.showErrors({
                                '#referal_email': error?.response?.data?.errors?.referal_email[0]
                            })
                        }
                        if (error?.response?.data?.errors?.referal_phone) {
                            validation.showErrors({
                                '#referal_phone': error?.response?.data?.errors?.referal_phone[0]
                            })
                        }
                        if (error?.response?.data?.errors?.referal_unit) {
                            validation.showErrors({
                                '#referal_unit': error?.response?.data?.errors?.referal_unit[0]
                            })
                        }
                        if (error?.response?.data?.errors?.referal_project_id) {
                            validation.showErrors({
                                '#referal_project_id': error?.response?.data?.errors
                                    ?.referal_project_id[0]
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
        });
    </script>

@stop
