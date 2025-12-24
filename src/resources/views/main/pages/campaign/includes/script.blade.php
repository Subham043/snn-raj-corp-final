<script src="{{ asset('assets/js/plugins/jq.min.js')}}" defer></script>
<script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}" defer></script>
<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}" defer></script>
<script src="{{ asset('assets/js/plugins/lazysizes.min.js') }}" defer></script>
<script src="{{ asset('assets/js/plugins/owl.carousel.min.js')}}" defer></script>
<script src="{{ asset('campaign/js/slick.js' ) }}" defer></script>
<script src="{{ asset('admin/js/pages/iziToast.min.js') }}" async></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}" async></script>
<script src="{{ asset('campaign/js/main.js') }}?v=v2" defer></script>


<script src="https://kit.fontawesome.com/b6a944420c.js" crossorigin="anonymous" async></script>

{!!$data->meta_footer_nonce!!}

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

</script>

<script nonce="{{ csp_nonce() }}" defer>
    window.addEventListener("load", function() {
        const intlScriptId = "intl-tel-input-script-id";
        let countryData2 = null;
        let scriptEle = document.createElement("script");
        scriptEle.setAttribute("type", "text/javascript");
        scriptEle.setAttribute("src",
            "{{ asset('assets/js/plugins/intlTelInput.min.js')}}");
        scriptEle.setAttribute("id", intlScriptId);
        document.body.appendChild(scriptEle);
        scriptEle.addEventListener("load", () => {
            countryData1 = window.intlTelInput(document.querySelector("#phoneModal"), {
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
            countryData2 = window.intlTelInput(document.querySelector("#phone2"), {
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

        let uuid = null;
        let link = null;

        var myModal = new bootstrap.Modal(document.getElementById('staticBackdropContact'), {
            keyboard: false
        })

        /**** Main Form ***/
        // initialize the validation library
        const validation2 = new JustValidate('#banner-form', {
            errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validation2
            .addField('#name2', [{
                    rule: 'required',
                    errorMessage: 'Name is required',
                },
                {
                    rule: 'customRegexp',
                    value: COMMON_REGEX,
                    errorMessage: 'Name is invalid',
                },
            ])
            .addField('#phone2', [{
                    rule: 'required',
                    errorMessage: 'Phone is required',
                },
                {
                    rule: 'customRegexp',
                    value: COMMON_REGEX,
                    errorMessage: 'Phone is invalid',
                },
            ])
            .addField('#email2', [{
                    rule: 'required',
                    errorMessage: 'Email is required',
                },
                {
                    rule: 'email',
                    errorMessage: 'Email is invalid!',
                },
            ])
            .onSuccess(async (event) => {
                var submitBtn2 = document.getElementById('submitBtn2')
                submitBtn2.value = 'Submitting ...'
                submitBtn2.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('name', document.getElementById('name2').value)
                    formData.append('email', document.getElementById('email2').value)
                    formData.append('phone', document.getElementById('phone2').value)
                    formData.append('country_code', countryData2.getSelectedCountryData().dialCode)
                    formData.append('page_url', '{{ Request::url() }}')

                    const response = await axios.post('{{route('enquiry_create.post')}}', formData)
                    event.target.reset();
                    uuid = response.data.uuid;
                    link = response.data.link;
                    myModal.show()

                } catch (error) {
                    if (error?.response?.data?.errors?.name) {
                        validation2.showErrors({
                            '#name2': error?.response?.data?.errors?.name[0]
                        })
                    }
                    if (error?.response?.data?.errors?.email) {
                        validation2.showErrors({
                            '#email2': error?.response?.data?.errors?.email[0]
                        })
                    }
                    if (error?.response?.data?.errors?.phone) {
                        validation2.showErrors({
                            '#phone2': error?.response?.data?.errors?.phone[0]
                        })
                    }
                    if (error?.response?.data?.message) {
                        errorToast(error?.response?.data?.message)
                    }
                } finally {
                    submitBtn2.value = `Submit`
                    submitBtn2.disabled = false;
                }
            });

        // initialize the validation library
        const validationOtp = new JustValidate('#otpForm', {
            errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validationOtp
            .addField('#otp', [{
                    rule: 'required',
                    errorMessage: 'OTP is required',
                },
                {
                    rule: 'customRegexp',
                    value: COMMON_REGEX,
                    errorMessage: 'OTP is invalid',
                },
            ])
            .onSuccess(async (event) => {
                var submitOtpBtn = document.getElementById('submitOtpBtn')
                submitOtpBtn.value = 'Submitting ...'
                submitOtpBtn.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('otp', document.getElementById('otp').value)
                    formData.append('slug',document.getElementById('slug').value)

                    const response = await axios.post(link, formData)
                    event.target.reset();
                    uuid = null;
                    link = null;
                    myModal.hide()
                    successToast(response.data.message)
                    setTimeout(()=> {
                        window.location.replace("{{route('campaign_view_thank.get', $data->slug)}}");
                    }
                    ,3000);
                } catch (error) {
                    if (error?.response?.data?.errors?.otp) {
                        validationOtp.showErrors({
                            '#otp': error?.response?.data?.errors?.otp[0]
                        })
                    }
                    if (error?.response?.data?.message) {
                        errorToast(error?.response?.data?.message)
                    }
                } finally {
                    submitOtpBtn.value = `Submit`
                    submitOtpBtn.disabled = false;
                }
            });

        document.getElementById('resendOtpBtn').addEventListener('click', async function(event) {
            if (uuid) {
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('uuid', uuid)
                    const response = await axios.post('{{route('enquiry.resendOtp')}}',
                        formData)
                    successToast(response.data.message)
                } catch (error) {
                    if (error?.response?.data?.message) {
                        errorToast(error?.response?.data?.message)
                    }
                } finally {
                    event.target.innerText = 'Resend OTP'
                    event.target.disabled = false;
                }
            }
        })
        /**** Main Form ***/

        let uuidModal = null;
        let linkModal = null;
        var myModalOtp = new bootstrap.Modal(document.getElementById('contactModal'), {
            keyboard: false
        })

        setTimeout(function() {
                myModalOtp.show();
            }, 5000);

        // initialize the validation library
        const validation = new JustValidate('#contactFormModal', {
            errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validation
        .addField('#nameModal', [
            {
            rule: 'required',
            errorMessage: 'Name is required',
            },
        ])
        .addField('#emailModal', [
            {
            rule: 'required',
            errorMessage: 'Email is required',
            },
            {
            rule: 'email',
            errorMessage: 'Email is invalid',
            },
        ])
        .addField('#phoneModal', [
            {
            rule: 'required',
            errorMessage: 'Phone is required',
            },
            {
                rule: 'customRegexp',
                value: /^[0-9]*$/,
                errorMessage: 'Phone is invalid',
            },
        ])
        .onSuccess(async (event) => {
            event.target.preventDefault;
            var submitBtn = document.getElementById('submitBtnModal')
            submitBtn.innerHTML = `
            <span class="d-flex align-items-center">
                <span class="spinner-border flex-shrink-0" role="status">
                    <span class="visually-hidden"></span>
                </span>
            </span>
            `
            submitBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('name',document.getElementById('nameModal').value)
                formData.append('email',document.getElementById('emailModal').value)
                formData.append('phone',document.getElementById('phoneModal').value)
                formData.append('page_url','{{Request::url()}}')
                formData.append('country_code',countryData1.getSelectedCountryData().dialCode)
                const response = await axios.post('{{route('enquiry_create.post')}}', formData)
                // successToast(response.data.message)
                // event.target.reset()
                // setTimeout(()=> {
                //     window.location.replace("{{route('campaign_view_thank.get', $data->slug)}}");
                // }
                // ,3000);
                // event.target.reset();
                uuidModal = response.data.uuid;
                linkModal = response.data.link;
                event.target.classList.add("d-none")
                document.getElementById('otpFormModal').classList.remove("d-none")
            } catch (error) {
                if(error?.response?.data?.errors?.name){
                    errorToast(error?.response?.data?.errors?.name[0])
                }
                if(error?.response?.data?.errors?.email){
                    errorToast(error?.response?.data?.errors?.email[0])
                }
                if(error?.response?.data?.errors?.phone){
                    errorToast(error?.response?.data?.errors?.phone[0])
                }
                if(error?.response?.data?.error){
                    errorToast(error?.response?.data?.error)
                }
            } finally{
                submitBtn.innerHTML =  `
                    Submit
                    `
                submitBtn.disabled = false;
            }
        });

        const validationOtpModal = new JustValidate('#otpFormModal', {
            errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validationOtpModal
        .addField('#otpModal', [
            {
            rule: 'required',
            errorMessage: 'OTP is required',
            },
        ])
        .onSuccess(async (event) => {
            var submitOtpBtnModal = document.getElementById('submitOtpBtnModal')
            submitOtpBtnModal.value = 'Submitting ...'
            submitOtpBtnModal.disabled = true;
            try {
                var formData = new FormData();
                formData.append('otp',document.getElementById('otpModal').value)
                formData.append('slug',document.getElementById('slugModal').value)

                const response = await axios.post(linkModal, formData)
                event.target.reset();
                document.getElementById('contactFormModal').reset();
                uuidModal = null;
                linkModal = null;
                myModalOtp.hide()
                event.target.classList.add("d-none")
                document.getElementById('contactFormModal').classList.remove("d-none")
                successToast(response.data.message)
            }catch (error){
                console.log(error);
                if(error?.response?.data?.errors?.otp){
                    validationOtpModal.showErrors({'#otpModal': error?.response?.data?.errors?.otp[0]})
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
            }finally{
                submitOtpBtnModal.value =  `Submit`
                submitOtpBtnModal.disabled = false;
            }
        });

        document.getElementById('resendOtpBtnModal').addEventListener('click', async function(event){
            if(uuidModal){
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('uuid',uuidModal)
                    const response = await axios.post('{{route('popup_page.resendOtp')}}', formData)
                    successToast(response.data.message)
                }catch (error){
                    if(error?.response?.data?.message){
                        errorToast(error?.response?.data?.message)
                    }
                }finally{
                    event.target.innerText = 'Resend OTP'
                    event.target.disabled = false;
                }
            }
        })

        document.getElementById('backOtpBtnModal').addEventListener('click', async function(event){
            uuidModal = null;
            linkModal = null;
            document.getElementById('otpFormModal').classList.add("d-none")
            document.getElementById('contactFormModal').classList.remove("d-none")
        })
    });
</script>
