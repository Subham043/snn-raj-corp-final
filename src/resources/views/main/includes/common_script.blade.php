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

{!! empty($chatbotSetting) ? '' : $chatbotSetting->chatbot_script_nonce !!}

@yield('js')
