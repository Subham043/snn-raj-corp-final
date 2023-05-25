@extends('main.layouts.index')

@section('css')

    <title>{{$data->page_name}}</title>

    <meta property="og:locale" content="en_US" />
	<meta property="og:type" content="profile" />
	<meta property="og:title" content="{{$data->page_name}}" />
	<meta property="og:url" content="{{Request::url()}}" />
	<meta property="og:site_name" content="{{$data->page_name}}" />
	<meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
	<meta name="twitter:label1" content="{{$data->page_name}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

@stop

@section('content')

    <!-- Legal -->
    <section class="py-5">
        <div class="background bg-img bg-fixed" data-overlay-dark="6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-12 " data-animate-effect="fadeInUp">
                        <div class="sub-title border-bot-light">{{$data->page_name}}</div>
                        <div class="section-title">{!!$data->heading!!}</div>
                        <div class="desc-ul">
                            {!!$data->description!!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('main.includes.common_contact')

@stop


@section('js')

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
            successToast(response.data.message)
            event.target.reset();

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


    </script>

@stop
