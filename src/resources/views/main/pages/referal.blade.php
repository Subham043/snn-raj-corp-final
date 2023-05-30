<!DOCTYPE html>
<html lang="xyz">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @cspMetaTag(App\Http\Policies\ContentSecurityPolicy::class)

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;1,300;1,400&amp;family=Oswald:wght@300;400&amp;display=swap">
    <link href="{{ asset('admin/css/iziToast.min.css') }}" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css'])
    <style nonce="{{ csp_nonce() }}">
        :root{

            --theme-background-color: {{ empty($themeSetting) ? '#1b1b1b' : $themeSetting->background_color}};
            --theme-primary-color: {{ empty($themeSetting) ? '#dccc73' : $themeSetting->primary_color}};
            --theme-overlay-color: {{ empty($themeSetting) ? '#000' : $themeSetting->overlaycolor}};
            --theme-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-dark-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-input-lines-color: {{ empty($themeSetting) ? 'rgba(255,255,255,0.1)' : 'rgba('.$themeSetting->lines_color_rgb.',0.1)'}};
            --theme-text-color: {{ empty($themeSetting) ? '#999' : $themeSetting->text_color}};
            --theme-highlight-text-color: {{ empty($themeSetting) ? '#fff' : $themeSetting->highlight_text_color}};

            --theme-header-color: #1b1919;
            --theme-footer-color: #1b1919;
            --theme-primary-color: #DCCE78;
            /* --theme-hero-color: #e5d1c6; */
            --theme-hero-color: #DCCE78;
            --theme-secondary-color: #ece9de;
            --theme-subject-color: #f6f6f4;
            --theme-suffix-color: #f6f6f4;
            --theme-hero-title-color: #fff;
            --theme-hero-title-span-color: #1b1919;
            --theme-text-color: #000;
            --theme-highlight-text-color: #000;
            /* --theme-lines-color:#3d3b3b0f; */
            --theme-lines-color:#DCCE78;
        }
        body {
            color: #000000 !important;
            background: #ffffff !important;
        }
        .logo-shape{
            border-bottom-right-radius: 25px;
            border-top-left-radius: 25px;
        }
        .section-title {
            font-weight: 800;
            font-size: 40px;
        }
        .sub-title {
            font-weight: 600;
        }
        .duru-wrap {
            background: var(--theme-header-color);
        }
        .duru-menu>ul>li>a, .duru-menu ul ul li a{
            color: #fff;
        }
        .duru-header, .duru-header.scrolled {
            background: var(--theme-header-color);
        }
        .hero, #slider-area{
            background: var(--theme-hero-color);
        }
        .hero-main{
            padding-bottom: 70px;
        }
        .hero-main, .hero-main .hero{
            background: white;
        }
        .footer {
            background: var(--theme-footer-color);
        }
        .hero .section-title span {
            color: #fff;
        }
        .hero .section-title, .secondary-div .section-title {
            color: #000;
        }
        .hero .section-title span {
            color: #fff;
        }
        .hero-main .section-title span {
            color: var(--theme-primary-color);
        }
        .hero .sub-title:before{
            background-color: white;
        }
        .hero .sub-title.border-bot-light {
            border-bottom: 1px solid white;
        }
        .hero .button-light:hover {
            color: white;
        }
        .hero p {
            font-size: 18px;
            color: #000;
            font-weight: 500;
        }
        .secondary-div .section-title span {
            color: var(--theme-primary-color);
        }
        .secondary-div{
            background: var(--theme-secondary-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .subject-div{
            background: var(--theme-subject-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .suffix-div{
            background: var(--theme-suffix-color);
            padding: 125px 0;
            margin-top: 60px;
        }
        .hero-contact{
            padding: 125px 0;
            margin-top: 60px;
        }
        .secondary-div input[type=password].line-gray, .secondary-div input[type=email].line-gray, .secondary-div input[type=text].line-gray, .secondary-div input[type=file].line-gray, .secondary-div textarea.line-gray, .secondary-div select.line-gray {
            border-bottom: 1px solid black;
        }
        .secondary-div select.line-gray {
            padding: 15px 0 !important;
            border-radius: 0 !important;
        }
        .secondary-div  label a{
            color: black !important;
            border-bottom: 1px solid black !important;
        }
        .secondary-div input[type=checkbox].line-gray:before {
            border: 1px solid black;
        }
        .hero-contact input[type=submit] {
            background: black;
            color: white;
        }
        .hero-contact .states li h1{
            color: white;
        }
        .hero-contact .states li p {
            font-weight: 600;
        }
        .hero-contact input[type=submit]:hover, .hero-contact input[type=reset]:hover, .hero-contact input[type=button]:hover, .hero-contact button:hover {
            background-color: black;
            color: var(--theme-hero-color);
            border: 1px solid black;
        }
        .blog-home .item .cont{
            background-color: #ece9de;
        }
        .blog-home .item .cont .date a{
            color: #000;
            font-weight: 600;
        }
        .blog-home .item h4, .blog-home .item h4 a {
            margin-bottom: 0px;
        }
        .footer .top .item p, .footer .top .item .mail, .footer .top .item h3 span, .footer .bottom p, .footer .bottom p a{
            color: #fff;
        }
        .slide-num span{
            color: black;
        }
        .slider__progress span{
            background-color: var(--theme-hero-color);
        }
        .slider-fade .owl-theme .owl-nav [class*=owl-]{
            background: var(--theme-hero-color);
            border: 1px solid var(--theme-hero-color);
            color: #000;
        }
        .owl-theme .owl-dots .owl-dot span{
            background: black;
            border: 1px solid black;
        }
        .button-light:hover {
            color: white;
        }
    </style>

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
        .slider-fade .v-middle{
            position: relative;
            transform: none;
            top: 0;
            left: 0;
        }

        .header.slider-fade  {
            min-height: 1px;
            height: auto;
            overflow: hidden;
            background: transparent !important;
        }

        .slider-fade .slider .owl-item, .slider-fade .owl-item {
            height: auto;
            position: relative;
        }

        .slider-fade .slider .item, .slider-fade .item{
            position: static;
            background-image: none !important;
        }

        .slider-fade .owl-carousel .owl-stage:after, #slider-area:after{
            content: none;
        }

        @media screen and (max-width: 600px) {
            #slider-area img {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        @include('main.includes.loader')
        @include('main.includes.scroll_top')
        @include('main.includes.lines')
        @include('main.includes.header')

        @if(count($banner)>0)
        <header id="slider-area" class="header slider-fade">
            <div class="owl-carousel owl-theme">
                <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
                @foreach($banner as $banner)
                    <div class="text-left item bg-img" data-overlay-dark="4" data-background="{{$banner->image_link}}">
                        <div class="v-middle caption">
                            <img src="{{$banner->image_link}}" alt="{{$banner->image_alt}}" title="{{$banner->image_title}}" fetchpriority="high">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slide-num" id="snh-1"></div>
            <div class="slider__progress"><span></span></div>
        </header>
        @endif


        <!-- Contact -->
        <div class="contact secondary-div mt-0">
            <div class="container">
                <div class="row mb-5 " data-animate-effect="fadeInUp">
                    <div class="col-md-4">
                        <div class="sub-title border-bot-light">Refer Now</div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-title">Member Details</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 " data-animate-effect="fadeInUp">
                        <!-- Contact Info -->
                    </div>
                    <!-- form -->
                    <div class="col-md-8 " data-animate-effect="fadeInUp">
                        <form method="post" class="contact__form" id="contactForm">
                            <!-- Form elements -->
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="member_name" id="member_name" type="text" placeholder="Member Name *" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="member_email" id="member_email" type="email" placeholder="Member Email *" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="member_phone" id="member_phone" type="text" placeholder="Member Phone *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <select class="line-gray" name="member_project_id" id="member_project_id" required>
                                        <option value="">Project Name *</option>
                                        @foreach($projects as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="line-gray" name="member_unit" id="member_unit" type="text" placeholder="Member Unit *" required>
                                </div>
                                <div class="section-title my-5">Referral Details</div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="referal_name" id="referal_name" type="text" placeholder="Referal Name *" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="referal_email" id="referal_email" type="email" placeholder="Referal Email *" required>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input class="line-gray" name="referal_phone" id="referal_phone" type="text" placeholder="Referal Phone *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="line-gray" name="referal_relation" id="referal_relation" type="text" placeholder="Referal Relation *" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <select class="line-gray" name="referal_project_id" id="referal_project_id" required>
                                        <option value="">Project Name *</option>
                                        @foreach($projects as $p)
                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="col-md-12 mt-3 mb-5">
                                        <input type="checkbox" class="line-gray">
                                        <label>I agree with the <a href="{{route('legal.get', 'privacy-policy')}}" aria-label="privacy policy" class="underline line-gray">privacy policy</a></label>
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

        @include('main.includes.footer')
        @include('cookie-consent::index')
    </div>

<script nonce="{{ csp_nonce() }}">
    const nonce = '{{ csp_nonce() }}';
</script>

<script src="{{ asset('assets/js/plugins/jquery-3.6.1.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/modernizr-2.6.2.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/jquery.waypoints.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/jquery.isotope.v3.0.2.js')}}"></script>
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/scrollIt.min.js')}}"></script>
<script src="{{ asset('assets/js/plugins/swiper-bundle.min.js')}}"></script>
<script src="{{ asset('assets/modules/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{ asset('assets/modules/masonry/masonry.pkgd.min.js')}}"></script>
<script src="{{ asset('assets/modules/YouTubePopUp/YouTubePopUp.js')}}"></script>
<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/iziToast.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
@vite(['resources/js/app.js'])


<script type="text/javascript" nonce="{{ csp_nonce() }}" defer>

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

    const COMMON_REGEX = /^[a-z 0-9~%.:_\@\-\/\(\)\\\#\;\[\]\{\}\$\!\&\<\>\'\?\r\n+=,]+$/i;


// initialize the validation library
const validation = new JustValidate('#contactForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#member_name', [
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
  .addField('#member_phone', [
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
  .addField('#member_email', [
    {
        rule: 'required',
        errorMessage: 'Email is required',
    },
    {
        rule: 'email',
        errorMessage: 'Email is invalid!',
    },
  ])
  .addField('#member_unit', [
    {
      rule: 'required',
      errorMessage: 'Unit is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Unit is invalid',
    },
  ])
  .addField('#member_project_id', [
    {
      rule: 'required',
      errorMessage: 'Message is required',
    },
  ])
  .addField('#referal_name', [
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
  .addField('#referal_phone', [
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
  .addField('#referal_email', [
    {
        rule: 'required',
        errorMessage: 'Email is required',
    },
    {
        rule: 'email',
        errorMessage: 'Email is invalid!',
    },
  ])
  .addField('#referal_relation', [
    {
      rule: 'required',
      errorMessage: 'Relation is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Relation is invalid',
    },
  ])
  .addField('#referal_project_id', [
    {
      rule: 'required',
      errorMessage: 'Message is required',
    },
  ])
  .onSuccess(async (event) => {
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.value = 'Sending Message ...'
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('member_name',document.getElementById('member_name').value)
        formData.append('member_email',document.getElementById('member_email').value)
        formData.append('member_phone',document.getElementById('member_phone').value)
        formData.append('member_unit',document.getElementById('member_unit').value)
        formData.append('member_project_id',document.getElementById('member_project_id').value)
        formData.append('referal_name',document.getElementById('referal_name').value)
        formData.append('referal_email',document.getElementById('referal_email').value)
        formData.append('referal_phone',document.getElementById('referal_phone').value)
        formData.append('referal_relation',document.getElementById('referal_relation').value)
        formData.append('referal_project_id',document.getElementById('referal_project_id').value)

        const response = await axios.post('{{route('referal_page.post')}}', formData)
        successToast(response.data.message)
        event.target.reset();

    }catch (error){
        if(error?.response?.data?.errors?.member_name){
            validation.showErrors({'#member_name': error?.response?.data?.errors?.member_name[0]})
        }
        if(error?.response?.data?.errors?.member_email){
            validation.showErrors({'#member_email': error?.response?.data?.errors?.member_email[0]})
        }
        if(error?.response?.data?.errors?.member_phone){
            validation.showErrors({'#member_phone': error?.response?.data?.errors?.member_phone[0]})
        }
        if(error?.response?.data?.errors?.member_unit){
            validation.showErrors({'#member_unit': error?.response?.data?.errors?.member_unit[0]})
        }
        if(error?.response?.data?.errors?.member_project_id){
            validation.showErrors({'#member_project_id': error?.response?.data?.errors?.member_project_id[0]})
        }
        if(error?.response?.data?.errors?.referal_name){
            validation.showErrors({'#referal_name': error?.response?.data?.errors?.referal_name[0]})
        }
        if(error?.response?.data?.errors?.referal_email){
            validation.showErrors({'#referal_email': error?.response?.data?.errors?.referal_email[0]})
        }
        if(error?.response?.data?.errors?.referal_phone){
            validation.showErrors({'#referal_phone': error?.response?.data?.errors?.referal_phone[0]})
        }
        if(error?.response?.data?.errors?.referal_unit){
            validation.showErrors({'#referal_unit': error?.response?.data?.errors?.referal_unit[0]})
        }
        if(error?.response?.data?.errors?.referal_project_id){
            validation.showErrors({'#referal_project_id': error?.response?.data?.errors?.referal_project_id[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.value =  `Send Message`
        submitBtn.disabled = false;
    }
  });


</script>

{!! empty($chatbotSetting) ? '' : $chatbotSetting->chatbot_script_nonce !!}

{!!$seo->meta_footer_script_nonce!!}
{!!$seo->meta_footer_no_script_nonce!!}

</body>
</html>
