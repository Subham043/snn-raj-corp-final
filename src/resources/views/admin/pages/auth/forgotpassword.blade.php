@extends('admin.layouts.auth')



@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Forgot Password?</h5>
                    <p class="text-muted">Reset password with SNN RAJ CORP</p>

                    <lord-icon
                        src="https://cdn.lordicon.com/rhvddzym.json"
                        trigger="loop"
                        colors="primary:#0ab39c"
                        class="avatar-xl">
                    </lord-icon>

                </div>

                <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                    Enter your email and instructions will be sent to you!
                </div>
                <div class="p-2">
                    <form id="forgotPasswordForm" method="post" action="{{route('forgot_password.post')}}">
                    @csrf
                        <div class="mb-4">
                            @include('admin.includes.input', ['key'=>'email', 'label'=>'Email', 'value'=>old('email')])
                        </div>

                        <div class="text-center mt-4">
                            <button class="btn btn-success w-100" type="submit">Send Reset Link</button>
                        </div>
                    </form><!-- end form -->
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="mt-4 text-center">
            <p class="mb-0">Wait, I remember my password... <a href="{{route('login.get')}}" class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
        </div>

    </div>
</div>

@stop

@section('javascript')

<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#forgotPasswordForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
        lockForm: true,
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
      errorMessage: 'Email is invalid!',
    },
  ])
  .onSuccess((event) => {
    event.target.submit();
  });
</script>

@stop
