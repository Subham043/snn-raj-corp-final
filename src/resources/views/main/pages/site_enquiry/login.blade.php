<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SnnRajCorp - Site Enquiry Form</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('admin/images/logo.png') }}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iofrm-style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iofrm-theme27.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/iziToast.min.css')}}" rel="stylesheet" type="text/css" />
    <style nonce="{{ csp_nonce() }}">
       .form-holder .form-content{
        z-index: 9999;
       }
       .website-logo-inside {
            margin-bottom: 10px;
        }
        .img-holder .info-holder img {
            width: auto;
            max-width: 375px;
            height: 200px;
        }
        .form-content, body, .form-body {
            background-color: #1c1919;
        }
        .form-content .form-button .ibtn {
            background-color: #fff;
            color: #1c1919;
        }
        .form-content input, .form-content .dropdown-toggle.btn-default {
            border: 0;
            background-color: #fff;
            font-weight: 700;
            color: #1c1919;
        }
        .just-validate-error-label{
            margin-bottom: 10px;
        }
        @media (max-width: 765px){
            .img-holder {
                min-height: 1px;
                height: auto;
            }
        }

        select.form-control, select.form-control:focus{
            background: white;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="form-body">
        <div class="row">
            <div class="img-holder col-lg-4 col-md-6 col-sm-12">
                <div class="bg"></div>
                <div class="info-holder">
                    <a href="{{route('home_page.get')}}">
                        <div class="logo">
                            <img class="logo-size" src="{{ asset('admin/images/logo.png') }}" alt="">
                        </div>
                    </a>
                </div>
            </div>
            <div class="form-holder col-lg-8 col-md-6 col-sm-12">
                <div class="form-content">
                    <div class="form-items">
                        <div class="website-logo-inside">
                            <h3>Site Enquiry Executive Login.</h3>
                        </div>
                        <form id="contactForm" method="POST" action="{{route('free_ad_form.login_post')}}">
                            @csrf
                            <div>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
                                @error('email')
                                    <div class="invalid-message">{{ $email }}</div>
                                @enderror
                            </div>
                            <div>
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-message">{{ $password }}</div>
                                @enderror
                            </div>
                            <div class="form-button">
                                <button id="submitBtn" type="submit" class="ibtn">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/iziToast.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
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

    @if (session('success_status'))

        iziToast.success({
            title: 'Success',
            message: '{{ Session::get('success_status') }}',
            position: 'topRight',
            timeout:6000
        });

    @endif
    @if (session('error_status'))

        iziToast.error({
            title: 'Error',
            message: '{{ Session::get('error_status') }}',
            position: 'topRight',
            timeout:6000
        });

    @endif

      // initialize the validation library
    const validation = new JustValidate('#contactForm', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation
      .addField('#email', [
        {
          rule: 'required',
          errorMessage: 'Email is required',
        },
        {
          rule: 'email',
          errorMessage: 'Email is invalid',
        },
      ])
      .addField('#password', [
        {
          rule: 'required',
          errorMessage: 'Password is required',
        },
      ])
      .onSuccess(async (event) => {
        event.target.submit();
      });

</script>
</html>
