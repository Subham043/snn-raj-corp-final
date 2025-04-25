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

    <link rel="preload" type="image/webp" fetchpriority="high" href="{{ asset('assets/partner.webp') }}" as="image">
    <link rel="preload" type="image/webp" fetchpriority="high" href="{{ asset('assets/partner_mobile.webp') }}" as="image">

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

        .hero .wrap ol li a {
            color: blue;
        }

        input[type=checkbox]:before {
            top: 0px;
        }

        input[type=checkbox]:after {
            top: 3px;
        }

        .hero-main {
            min-height: 712px
        }

        .special-link{
            color: #be932d !important;
            font-weight: 600;
        }

        @media screen and (max-width: 600px) {
            .hero-main {
                min-height: 1249px
            }
        }
    </style>
@stop

@section('content')

    <section class="hero hero-main section-padding pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <div class="img fr-img" data-animate-effect="fadeInUp">
                        <picture>
                            <source srcset="{{ asset('assets/partner_mobile.webp') }}"
                                            media="(max-width: 991px)">
                            <source srcset="{{ asset('assets/partner.webp') }}"
                                            media="(max-width: 1200px)">
                            <img src="{{ asset('assets/partner.webp') }}" width="583" height="351" fetchpriority="high" loading="eager"
                                alt="partner"
                                title="partner" class="img-fluid about_banner_img">
                        </picture>
                    </div>
                    <div class="wrap">
                        <div class="section-title">CHANNEL PARTNER EMPANELMENT.</div>
                        <p>
                            We greatly appreciate the value we place on building strong relationships with our business
                            associates. Our goal is to establish a long-lasting partnership, and we have made the process of
                            starting your journey simple and straightforward. Here's a step-by-step guide to get started:
                        </p>
                        <ol>
                            <li>
                                Take your time to explore our comprehensive website at <a href="https://www.snnrajcorp.com"
                                    target="_blank" class="special-link" class="special-link">www.snnrajcorp.com</a>. It will provide you with valuable insights into
                                all of our projects.
                            </li>
                            <li>
                                Once you have familiarized yourself with our offerings, navigate to the "CONTACTS" section
                                and click on "CHANNEL PARTNERS." You can access the Empanelment Form provided below. Please
                                complete the form and attach all necessary requirements as indicated in the enclosures
                                section. Send the completed form and attachments to <a
                                    href="mailto:channelsales@snnrajcorp.com" class="special-link">channelsales@snnrajcorp.com</a>.
                            </li>
                            <li>
                                After you have submitted the online registration form, our team will review your application
                                thoroughly. Following this evaluation, our dedicated CP department coordinator will contact
                                you either by phone or email to discuss the next steps in the process.
                            </li>
                            <li>
                                We also take pride in our prompt payment processing for our esteemed partners. All the
                                necessary details regarding pay-outs will be clearly outlined in the Memorandum of
                                Understanding (MOU).
                            </li>
                            <li>
                                We invite you to join us in doing business together.
                                If you have any questions or require clarification at any point, please do not hesitate to
                                reach out to our CP Coordinator at <br /><a href="tel:+918884123528" class="special-link">+91 8884123528</a>. We
                                look forward to the possibility of working together and building a mutually beneficial
                                partnership.
                            </li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <h1 class="d-none">{{ $seo->page_keywords }}</h1>
    <h2 class="d-none">{{ $seo->page_keywords }}</h2>

    <section class="lets-talk secondary-div mt-0">
        <div class="background bg-img bg-fixed" data-overlay-dark="6">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-md-4 mb-30">
                    <div class="no-stretch-line sub-title border-bot-light pb-0">Empanelment Form</div>
                </div> --}}
                    <div class="col-md-8">
                        <div class="section-title">Empanelment Form</div>
                        {{-- <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line and we’ll get back to you shortly.</p> --}}
                    </div>
                    <div class="col-md-12">
                        <form method="post" class="contact__form" id="contactForm">
                            <!-- Form elements -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="scope" id="scope" type="text"
                                        placeholder="Scope of Work *" required="">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="channel_partner" id="channel_partner" type="text"
                                        placeholder="Name of Channel Partner *" required="">
                                </div>
                                <div class="col-md-4 form-group">
                                    <select name="company_type" id="company_type" class="line-gray" aria-label="Company Type" required>
                                        <option value="">Company Type</option>
                                        <option value="Individual">Individual</option>
                                        <option value="Proprietorship">Proprietorship</option>
                                        <option value="Private Limited">Private Limited</option>
                                        <option value="Limited">Limited</option>
                                        <option value="LLP">LLP</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea class="line-gray" name="address" id="address" cols="30" rows="4" placeholder="Address *"
                                        required></textarea>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="phone" id="phone" type="text"
                                        placeholder="Phone *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="telephone" id="telephone" type="text"
                                        placeholder="Telephone *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="email" id="email" type="email"
                                        placeholder="Email *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="rera" id="rera" type="text"
                                        placeholder="Rera No. *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="contact_person_name" id="contact_person_name"
                                        type="text" placeholder="Contact Person Name *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="designation" id="designation" type="text"
                                        placeholder="Designation *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="pan" id="pan" type="text"
                                        placeholder="PAN No. *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="gst" id="gst" type="text"
                                        placeholder="GSTIN *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="sac" id="sac" type="text"
                                        placeholder="SAC / HSN Code *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="tax" id="tax" type="text"
                                        placeholder="Tax Applicable *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="bank_name" id="bank_name" type="text"
                                        placeholder="Bank Name *" required="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <input class="line-gray" name="bank_address" id="bank_address" type="text"
                                        placeholder="Bank Address *" required="">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="bank_branch" id="bank_branch" type="text"
                                        placeholder="Branch *" required="">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="bank_account_number" id="bank_account_number"
                                        type="text" placeholder="Bank Account Number *" required="">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="ifsc" id="ifsc" type="text"
                                        placeholder="IFSC Code *" required="">
                                </div>
                                <div class="col-4 my-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <label for="">MSME Registered: </label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="msme_yes" name="msme" value="1"
                                                class="line-gray">
                                            <label for="msme_yes">Yes</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="msme_no" name="msme" value="0"
                                                checked="checked" class="line-gray">
                                            <label for="msme_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 my-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <label for="">ESI Registered: </label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="esi_yes" name="esi" value="1"
                                                class="line-gray">
                                            <label for="esi_yes">Yes</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="esi_no" name="esi" value="0"
                                                checked="checked" class="line-gray">
                                            <label for="esi_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 my-3">
                                    <div class="row align-items-center">
                                        <div class="col-md-5">
                                            <label for="">EPF Registered: </label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="epf_yes" name="epf" value="1"
                                                class="line-gray">
                                            <label for="epf_yes">Yes</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" id="epf_no" name="epf" value="0"
                                                checked="checked" class="line-gray">
                                            <label for="epf_no">No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="msme_image">If MSME is registered, then upload the certificate (Only
                                        Image/PDF Allowed): *</label>
                                    <input class="line-gray" name="msme_image" id="msme_image" type="file" required>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="msme_image"><b>Enclosures (Only Image/PDF Allowed):</b> *</label>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="pan_image">Pan Copy:</label>
                                    <input class="line-gray" name="pan_image" id="pan_image" type="file" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="gst_image">GST Certificate Copy:</label>
                                    <input class="line-gray" name="gst_image" id="gst_image" type="file" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="seal_image">Print on A4 paper with seal and signature:</label>
                                    <input class="line-gray" name="seal_image" id="seal_image" type="file" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="cheque_image">One Cancelled Cheque copy or front copy of passbook:</label>
                                    <input class="line-gray" name="cheque_image" id="cheque_image" type="file"
                                        required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="rera_image">RERA Certificate:</label>
                                    <input class="line-gray" name="rera_image" id="rera_image" type="file" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2 mt-3">
                                    <input class="line-gray" name="submit" type="submit" id="submitBtn"
                                        value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- @include('main.includes.common_contact') --}}


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

            // initialize the validation library
            const validation = new JustValidate('#contactForm', {
                errorFieldCssClass: 'is-invalid',
            });
            // apply rules to form fields
            validation
                .addField('#scope', [{
                    rule: 'required',
                    errorMessage: 'Scope of work is required',
                }, ])
                .addField('#channel_partner', [{
                    rule: 'required',
                    errorMessage: 'Name of channel partner is required',
                }, ])
                .addField('#company_type', [{
                    rule: 'required',
                    errorMessage: 'Company Type is required',
                }, ])
                .addField('#telephone', [{
                    rule: 'required',
                    errorMessage: 'Telephone of work is required',
                }, ])
                .addField('#rera', [{
                    rule: 'required',
                    errorMessage: 'Rera No. is required',
                }, ])
                .addField('#contact_person_name', [{
                    rule: 'required',
                    errorMessage: 'Contact person name is required',
                }, ])
                .addField('#designation', [{
                    rule: 'required',
                    errorMessage: 'Designation is required',
                }, ])
                .addField('#pan', [{
                    rule: 'required',
                    errorMessage: 'Pan No. is required',
                }, ])
                .addField('#gst', [{
                    rule: 'required',
                    errorMessage: 'GSTIN is required',
                }, ])
                .addField('#sac', [{
                    rule: 'required',
                    errorMessage: 'SAC / HSN code is required',
                }, ])
                .addField('#tax', [{
                    rule: 'required',
                    errorMessage: 'Tax applicable is required',
                }, ])
                .addField('#bank_name', [{
                    rule: 'required',
                    errorMessage: 'Bank name is required',
                }, ])
                .addField('#bank_address', [{
                    rule: 'required',
                    errorMessage: 'Bank address is required',
                }, ])
                .addField('#bank_branch', [{
                    rule: 'required',
                    errorMessage: 'Bank branch is required',
                }, ])
                .addField('#bank_account_number', [{
                    rule: 'required',
                    errorMessage: 'Tax applicable is required',
                }, ])
                .addField('#ifsc', [{
                    rule: 'required',
                    errorMessage: 'IFSC code is required',
                }, ])
                .addField('#phone', [{
                    rule: 'required',
                    errorMessage: 'Phone is required',
                }, ])
                .addField('#email', [{
                        rule: 'required',
                        errorMessage: 'Email is required',
                    },
                    {
                        rule: 'email',
                        errorMessage: 'Email is invalid!',
                    },
                ])
                .addField('#address', [{
                    rule: 'required',
                    errorMessage: 'Address is required',
                }, ])
                .addField('#pan_image', [{
                        rule: 'required',
                        errorMessage: 'Pan Copy is required',
                    },
                    {
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'Pan Copy is required',
                    },
                    {
                        rule: 'maxFilesCount',
                        value: 1,
                        errorMessage: 'Only One Pan Copy is required',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['jpeg', 'jpg', 'png', 'webp', 'pdf'],
                                maxSize: 3000000,
                                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp',
                                    'application/pdf'],
                            },
                        },
                        errorMessage: 'Pan Copy\'s with jpeg,jpg,png,webp extensions are allowed! Pan Copy size should not exceed 500kb!',
                    },
                ])
                .addField('#gst_image', [{
                        rule: 'required',
                        errorMessage: 'GST Certificate Copy is required',
                    },
                    {
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'GST Certificate Copy is required',
                    },
                    {
                        rule: 'maxFilesCount',
                        value: 1,
                        errorMessage: 'Only One GST Certificate Copy is required',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['jpeg', 'jpg', 'png', 'webp', 'pdf'],
                                maxSize: 3000000,
                                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp',
                                    'application/pdf'],
                            },
                        },
                        errorMessage: 'GST Certificate Copy\'s with jpeg,jpg,png,webp extensions are allowed! GST Certificate Copy size should not exceed 500kb!',
                    },
                ])
                .addField('#rera_image', [{
                        rule: 'required',
                        errorMessage: 'RERA Certificate is required',
                    },
                    {
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'RERA Certificate is required',
                    },
                    {
                        rule: 'maxFilesCount',
                        value: 1,
                        errorMessage: 'Only One RERA Certificate is required',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['jpeg', 'jpg', 'png', 'webp', 'pdf'],
                                maxSize: 3000000,
                                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp',
                                    'application/pdf'],
                            },
                        },
                        errorMessage: 'RERA Certificate\'s with jpeg,jpg,png,webp extensions are allowed! RERA Certificate size should not exceed 500kb!',
                    },
                ])
                .addField('#cheque_image', [{
                        rule: 'required',
                        errorMessage: 'Cancelled Cheque copy or front copy of passbook is required',
                    },
                    {
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'Cancelled Cheque copy or front copy of passbook is required',
                    },
                    {
                        rule: 'maxFilesCount',
                        value: 1,
                        errorMessage: 'Only One Cancelled Cheque copy or front copy of passbook is required',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['jpeg', 'jpg', 'png', 'webp', 'pdf'],
                                maxSize: 3000000,
                                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp',
                                    'application/pdf'],
                            },
                        },
                        errorMessage: 'Cancelled Cheque copy or front copy of passbook\'s with jpeg,jpg,png,webp extensions are allowed! Cancelled Cheque copy or front copy of passbook size should not exceed 500kb!',
                    },
                ])
                .addField('#seal_image', [{
                        rule: 'required',
                        errorMessage: 'Seal & Signature is required',
                    },
                    {
                        rule: 'minFilesCount',
                        value: 1,
                        errorMessage: 'Seal & Signature is required',
                    },
                    {
                        rule: 'maxFilesCount',
                        value: 1,
                        errorMessage: 'Only One Seal & Signature is required',
                    },
                    {
                        rule: 'files',
                        value: {
                            files: {
                                extensions: ['jpeg', 'jpg', 'png', 'webp', 'pdf'],
                                maxSize: 3000000,
                                types: ['image/jpeg', 'image/jpg', 'image/png', 'image/webp',
                                    'application/pdf'],
                            },
                        },
                        errorMessage: 'Seal & Signature\'s with jpeg,jpg,png,webp extensions are allowed! Seal & Signature size should not exceed 500kb!',
                    },
                ])
                .addField('#msme_yes', [{
                    validator: (value, fields) => true,
                }, ])
                .addField('#msme_image', [{
                    validator: (value, fields) => true,
                }, ])
                .addField('#esi_yes', [{
                    validator: (value, fields) => true,
                }, ])
                .addField('#epf_yes', [{
                    validator: (value, fields) => true,
                }, ])
                .onSuccess(async (event) => {
                    var submitBtn = document.getElementById('submitBtn')
                    submitBtn.value = 'Submitting ...'
                    submitBtn.disabled = true;
                    try {
                        var formData = new FormData();
                        formData.append('scope', document.getElementById('scope').value)
                        formData.append('channel_partner', document.getElementById('channel_partner').value)
                        formData.append('address', document.getElementById('address').value)
                        formData.append('phone', document.getElementById('phone').value)
                        formData.append('telephone', document.getElementById('telephone').value)
                        formData.append('email', document.getElementById('email').value)
                        formData.append('rera', document.getElementById('rera').value)
                        formData.append('contact_person_name', document.getElementById(
                            'contact_person_name').value)
                        formData.append('designation', document.getElementById('designation').value)
                        formData.append('pan', document.getElementById('pan').value)
                        formData.append('gst', document.getElementById('gst').value)
                        formData.append('sac', document.getElementById('sac').value)
                        formData.append('tax', document.getElementById('tax').value)
                        formData.append('company_type', document.getElementById('company_type').value)
                        formData.append('bank_name', document.getElementById('bank_name').value)
                        formData.append('bank_address', document.getElementById('bank_address').value)
                        formData.append('bank_branch', document.getElementById('bank_branch').value)
                        formData.append('bank_account_number', document.getElementById(
                            'bank_account_number').value)
                        formData.append('ifsc', document.getElementById('ifsc').value)
                        formData.append('country_code', countryData.getSelectedCountryData().dialCode)
                        formData.append('msme', document.getElementById('msme_yes').checked ? document
                            .getElementById('msme_yes').value : document.getElementById('msme_no').value
                            )
                        formData.append('epf', document.getElementById('epf_yes').checked ? document
                            .getElementById('epf_yes').value : document.getElementById('epf_no').value)
                        formData.append('esi', document.getElementById('esi_yes').checked ? document
                            .getElementById('esi_yes').value : document.getElementById('esi_no').value)
                        if ((document.getElementById('msme_image').files).length > 0) {
                            formData.append('msme_image', document.getElementById('msme_image').files[0])
                        }
                        if ((document.getElementById('pan_image').files).length > 0) {
                            formData.append('pan_image', document.getElementById('pan_image').files[0])
                        }
                        if ((document.getElementById('gst_image').files).length > 0) {
                            formData.append('gst_image', document.getElementById('gst_image').files[0])
                        }
                        if ((document.getElementById('seal_image').files).length > 0) {
                            formData.append('seal_image', document.getElementById('seal_image').files[0])
                        }
                        if ((document.getElementById('cheque_image').files).length > 0) {
                            formData.append('cheque_image', document.getElementById('cheque_image').files[
                                0])
                        }
                        if ((document.getElementById('rera_image').files).length > 0) {
                            formData.append('rera_image', document.getElementById('rera_image').files[0])
                        }
                        formData.append('page_url', '{{ Request::url() }}')

                        const response = await axios.post('{{ route('channel_partner.post') }}', formData)
                        event.target.reset();
                        successToast(response.data.message)

                    } catch (error) {
                        if (error?.response?.data?.errors?.scope) {
                            validation.showErrors({
                                '#scope': error?.response?.data?.errors?.scope[0]
                            })
                        }
                        if (error?.response?.data?.errors?.channel_partner) {
                            validation.showErrors({
                                '#channel_partner': error?.response?.data?.errors?.channel_partner[
                                    0]
                            })
                        }
                        if (error?.response?.data?.errors?.address) {
                            validation.showErrors({
                                '#address': error?.response?.data?.errors?.address[0]
                            })
                        }
                        if (error?.response?.data?.errors?.phone) {
                            validation.showErrors({
                                '#phone': error?.response?.data?.errors?.phone[0]
                            })
                        }
                        if (error?.response?.data?.errors?.telephone) {
                            validation.showErrors({
                                '#telephone': error?.response?.data?.errors?.telephone[0]
                            })
                        }
                        if (error?.response?.data?.errors?.email) {
                            validation.showErrors({
                                '#email': error?.response?.data?.errors?.email[0]
                            })
                        }
                        if (error?.response?.data?.errors?.rera) {
                            validation.showErrors({
                                '#rera': error?.response?.data?.errors?.rera[0]
                            })
                        }
                        if (error?.response?.data?.errors?.contact_person_name) {
                            validation.showErrors({
                                '#contact_person_name': error?.response?.data?.errors
                                    ?.contact_person_name[0]
                            })
                        }
                        if (error?.response?.data?.errors?.designation) {
                            validation.showErrors({
                                '#designation': error?.response?.data?.errors?.designation[0]
                            })
                        }
                        if (error?.response?.data?.errors?.pan) {
                            validation.showErrors({
                                '#pan': error?.response?.data?.errors?.pan[0]
                            })
                        }
                        if (error?.response?.data?.errors?.gst) {
                            validation.showErrors({
                                '#gst': error?.response?.data?.errors?.gst[0]
                            })
                        }
                        if (error?.response?.data?.errors?.sac) {
                            validation.showErrors({
                                '#sac': error?.response?.data?.errors?.sac[0]
                            })
                        }
                        if (error?.response?.data?.errors?.tax) {
                            validation.showErrors({
                                '#tax': error?.response?.data?.errors?.tax[0]
                            })
                        }
                        if (error?.response?.data?.errors?.company_type) {
                            validation.showErrors({
                                '#company_type': error?.response?.data?.errors?.company_type[0]
                            })
                        }
                        if (error?.response?.data?.errors?.bank_name) {
                            validation.showErrors({
                                '#bank_name': error?.response?.data?.errors?.bank_name[0]
                            })
                        }
                        if (error?.response?.data?.errors?.bank_address) {
                            validation.showErrors({
                                '#bank_address': error?.response?.data?.errors?.bank_address[0]
                            })
                        }
                        if (error?.response?.data?.errors?.bank_branch) {
                            validation.showErrors({
                                '#bank_branch': error?.response?.data?.errors?.bank_branch[0]
                            })
                        }
                        if (error?.response?.data?.errors?.bank_account_number) {
                            validation.showErrors({
                                '#bank_account_number': error?.response?.data?.errors
                                    ?.bank_account_number[0]
                            })
                        }
                        if (error?.response?.data?.errors?.ifsc) {
                            validation.showErrors({
                                '#ifsc': error?.response?.data?.errors?.ifsc[0]
                            })
                        }
                        if (error?.response?.data?.errors?.msme) {
                            validation.showErrors({
                                '#msme_yes': error?.response?.data?.errors?.msme[0]
                            })
                        }
                        if (error?.response?.data?.errors?.msme_image) {
                            validation.showErrors({
                                '#msme_image': error?.response?.data?.errors?.msme_image[0]
                            })
                        }
                        if (error?.response?.data?.errors?.esi) {
                            validation.showErrors({
                                '#esi_yes': error?.response?.data?.errors?.esi[0]
                            })
                        }
                        if (error?.response?.data?.errors?.epf) {
                            validation.showErrors({
                                '#epf_yes': error?.response?.data?.errors?.epf[0]
                            })
                        }
                        if (error?.response?.data?.errors?.pan_image) {
                            validation.showErrors({
                                '#pan_image': error?.response?.data?.errors?.pan_image[0]
                            })
                        }
                        if (error?.response?.data?.errors?.gst_image) {
                            validation.showErrors({
                                '#gst_image': error?.response?.data?.errors?.gst_image[0]
                            })
                        }
                        if (error?.response?.data?.errors?.seal_image) {
                            validation.showErrors({
                                '#seal_image': error?.response?.data?.errors?.seal_image[0]
                            })
                        }
                        if (error?.response?.data?.errors?.cheque_image) {
                            validation.showErrors({
                                '#cheque_image': error?.response?.data?.errors?.cheque_image[0]
                            })
                        }
                        if (error?.response?.data?.errors?.rera_image) {
                            validation.showErrors({
                                '#rera_image': error?.response?.data?.errors?.rera_image[0]
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
