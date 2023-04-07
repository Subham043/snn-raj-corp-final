@extends('admin.layouts.dashboard')


@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        @can('list users')
        @include('admin.includes.breadcrumb', ['page'=>'User', 'page_link'=>route('user.paginate.get'), 'list'=>['Create']])
        @endcan
        <!-- end page title -->

        <div class="row">

            <div class="col-lg-12">
                <form id="countryForm" method="post" action="{{route('setting.email.post')}}" enctype="multipart/form-data">
                @csrf
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Email Setting</h4>
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="row gy-4">
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'mailer', 'label'=>'Mailer', 'value'=>old('mailer') ? old('mailer') : $mailer])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'host', 'label'=>'Host', 'value'=>old('host') ? old('host') : $host])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'port', 'label'=>'Port', 'value'=>old('port') ? old('port') : $port])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'encryption', 'label'=>'Encryption', 'value'=>old('encryption') ? old('encryption') : $encryption])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'username', 'label'=>'Username', 'value'=>old('username') ? old('username') : $username])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.password_input', ['key'=>'password', 'label'=>'Password', 'value'=>''])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'from_address', 'label'=>'From Address', 'value'=>old('from_address') ? old('from_address') : $from_address])
                                    </div>
                                    <div class="col-xxl-3 col-md-3">
                                        @include('admin.includes.input', ['key'=>'from_name', 'label'=>'From Name', 'value'=>old('from_name') ? old('from_name') : $from_name])
                                    </div>

                                    <div class="col-xxl-12 col-md-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light" id="submitBtn">Save</button>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <!--end col-->
        </div>
        <!--end row-->



    </div> <!-- container-fluid -->
</div><!-- End Page-content -->



@stop


@section('javascript')

<script type="text/javascript" nonce="{{ csp_nonce() }}">

// initialize the validation library
const validation = new JustValidate('#countryForm', {
      errorFieldCssClass: 'is-invalid',
});
// apply rules to form fields
validation
  .addField('#mailer', [
    {
      rule: 'required',
      errorMessage: 'Mailer is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Mailer is invalid',
    },
  ])
  .addField('#host', [
    {
      rule: 'required',
      errorMessage: 'Host is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Host is invalid',
    },
  ])
  .addField('#port', [
    {
      rule: 'required',
      errorMessage: 'Port is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Port is invalid',
    },
  ])
  .addField('#encryption', [
    {
      rule: 'required',
      errorMessage: 'Encryption is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Encryption is invalid',
    },
  ])
  .addField('#username', [
    {
      rule: 'required',
      errorMessage: 'Username is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Username is invalid',
    },
  ])
  .addField('#password', [
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'Password is invalid',
    },
  ])
  .addField('#from_name', [
    {
      rule: 'required',
      errorMessage: 'From Name is required',
    },
    {
        rule: 'customRegexp',
        value: COMMON_REGEX,
        errorMessage: 'From Name is invalid',
    },
  ])
  .addField('#from_address', [
    {
        rule: 'required',
        errorMessage: 'From Address is required',
    },
    {
        rule: 'email',
        errorMessage: 'From Address is invalid!',
    },
  ])
  .onSuccess(async (event) => {
    event.target.submit();
  });

</script>

@stop
