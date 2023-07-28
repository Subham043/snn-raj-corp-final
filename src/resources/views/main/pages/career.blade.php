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
        .about_banner_img{
            border: 1px solid #1c1919;
            padding: 5px;
            border-top-left-radius: 30px;
            border-bottom-right-radius: 30px;
            object-fit: cover;
        }
    </style>
@stop

@section('content')


    <h1 class="d-none">{{$seo->page_keywords}}</h1>
    <h2 class="d-none">{{$seo->page_keywords}}</h2>

    <!-- Contact -->
    <div class="contact secondary-div mt-0 pt-5">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <img src="{{asset('assets/career.webp')}}" fetchpriority="high" alt="" class="img-fluid about_banner_img">
                </div>
            </div>
            {{-- <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="no-line-heading sub-title border-bot-light">Career</div>
                </div>
                <div class="col-md-8">
                    <h1 class="section-title">Get in <span>touch</span></h1>
                    <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line and we’ll get back to you shortly.</p>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title"><span>Career</span></div>
                    <p>If you’re looking for a career with us, drop us a line and we’ll get back to you shortly.</p>
                </div>
                <!-- form -->
                <div class="col-md-12 " data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="name" id="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="email" id="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="phone" id="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <input class="line-gray" name="experience" id="experience" type="text" placeholder="Real Estate Experience *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="line-gray" name="description" id="description" cols="30" rows="4" placeholder="Brief Description About Yourself *" required></textarea>
                            </div>
                            <div class="col-md-12 form-group">
                                <label for="cv">Upload CV (Only PDF Allowed) *</label>
                                <input class="line-gray" name="cv" id="cv" type="file" required>
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

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script nonce="{{ csp_nonce() }}" defer>
        const countryData = window.intlTelInput(document.querySelector("#phone"), {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            autoInsertDialCode: true,
            initialCountry: "auto",
            geoIpLookup: callback => {
                fetch("https://ipapi.co/json")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("us"));
            },
        });
    </script>

    <script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

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
          .addField('#experience', [
            {
              rule: 'required',
              errorMessage: 'Experience is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Experience is invalid',
            },
          ])
          .addField('#description', [
            {
              rule: 'required',
              errorMessage: 'Description is required',
            },
            {
                rule: 'customRegexp',
                value: COMMON_REGEX,
                errorMessage: 'Description is invalid',
            },
          ])
          .addField('#cv', [
                {
                rule: 'required',
                errorMessage: 'Cv is required',
                },
                {
                    rule: 'minFilesCount',
                    value: 1,
                    errorMessage: 'Cv is required',
                },
                {
                    rule: 'maxFilesCount',
                    value: 1,
                    errorMessage: 'Only One Cv is required',
                },
                {
                    rule: 'files',
                    value: {
                    files: {
                        extensions: ['pdf'],
                        maxSize: 500000,
                        types: ['application/pdf'],
                    },
                    },
                    errorMessage: 'Cv\'s with jpeg,jpg,png,webp extensions are allowed! Cv size should not exceed 500kb!',
                },
            ])
          .onSuccess(async (event) => {
            var submitBtn = document.getElementById('submitBtn')
            submitBtn.value = 'Submitting ...'
            submitBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('name',document.getElementById('name').value)
                formData.append('email',document.getElementById('email').value)
                formData.append('phone',document.getElementById('phone').value)
                formData.append('experience',document.getElementById('experience').value)
                formData.append('description',document.getElementById('description').value)
                formData.append('country_code',countryData.getSelectedCountryData().dialCode)
                if((document.getElementById('cv').files).length>0){
                    formData.append('cv',document.getElementById('cv').files[0])
                }

                const response = await axios.post('{{route('career_page.post')}}', formData)
                event.target.reset();
                successToast(response.data.message)

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
                if(error?.response?.data?.errors?.experience){
                    validation.showErrors({'#experience': error?.response?.data?.errors?.experience[0]})
                }
                if(error?.response?.data?.errors?.description){
                    validation.showErrors({'#description': error?.response?.data?.errors?.description[0]})
                }
                if(error?.response?.data?.errors?.cv){
                    validation.showErrors({'#cv': error?.response?.data?.errors?.cv[0]})
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

@stop
