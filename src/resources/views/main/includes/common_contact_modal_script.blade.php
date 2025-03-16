<script type="text/javascript" nonce="{{ csp_nonce() }}" defer>
window.addEventListener("load", function () {
    const intlScriptId = "intl-tel-input-script-id";
    let countryData = null;
    let uuidModal = null;
    let linkModal = null;
    
    var contactModal = new bootstrap.Modal(document.getElementById('contactModal'), {
        keyboard: false
    })

    const loadIntlTelInput = () => {
        if(!document.querySelector(`script#${intlScriptId}`)){
            let scriptEle = document.createElement("script");
            scriptEle.setAttribute("type", "text/javascript");
            scriptEle.setAttribute("src", "{{ asset('assets/js/plugins/intlTelInput.min.js')}}");
            scriptEle.setAttribute("id", intlScriptId);
            document.body.appendChild(scriptEle);
            scriptEle.addEventListener("load", () => {
                countryData = window.intlTelInput(document.querySelector("#phoneModal"), {
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
        }
    }
    
    document.getElementById('contactModal').addEventListener('show.bs.modal', function (event) {
      // do something...
      loadIntlTelInput();
    })
    
    // window.addEventListener("scroll", (event) => {
    //     let scroll = this.scrollY;
    //     if((scroll>850 && scroll<900)){
    //         contactModal.show()
    //     }
    // });

    window.addEventListener("scroll", (event) => {
        const scrollPosition = window.scrollY + window.innerHeight; // Current scroll position + viewport height
        const pageHeight = document.documentElement.scrollHeight; // Total page height

        // Trigger when user is within 100px of the bottom
        if (pageHeight - scrollPosition <= 100) {
            contactModal.show();
        }
    });
    
    // initialize the validation library
    const validationModal = new JustValidate('#contactFormModal', {
            errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validationModal
        .addField('#nameModal', [
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
        .addField('#phoneModal', [
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
        .addField('#emailModal', [
        {
            rule: 'required',
            errorMessage: 'Email is required',
        },
        {
            rule: 'email',
            errorMessage: 'Email is invalid!',
        },
        ])
        .addField('#projectModal', [
        {
            rule: 'required',
            errorMessage: 'Project is required',
        },
        {
            rule: 'customRegexp',
            value: COMMON_REGEX,
            errorMessage: 'Project is invalid',
        },
        ])
        .addField('#messageModal', [
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
        var submitBtnModal = document.getElementById('submitBtnModal')
        submitBtnModal.value = 'Submitting ...'
        submitBtnModal.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('nameModal').value)
            formData.append('email',document.getElementById('emailModal').value)
            formData.append('phone',document.getElementById('phoneModal').value)
            formData.append('project_id',document.getElementById('projectModal').value)
            formData.append('message',document.getElementById('messageModal').value)
            formData.append('country_code',countryData.getSelectedCountryData().dialCode)
            formData.append('page_url','{{Request::url()}}')
    
            const response = await axios.post('{{route('popup_page.post')}}', formData)
            uuidModal = response.data.uuid;
            linkModal = response.data.link;
            event.target.classList.add("d-none")
            document.getElementById('otpFormModal').classList.remove("d-none")
        }catch (error){
            console.log(error)
            if(error?.response?.data?.errors?.name){
                validationModal.showErrors({'#nameModal': error?.response?.data?.errors?.name[0]})
            }
            if(error?.response?.data?.errors?.email){
                validationModal.showErrors({'#emailModal': error?.response?.data?.errors?.email[0]})
            }
            if(error?.response?.data?.errors?.phone){
                validationModal.showErrors({'#phoneModal': error?.response?.data?.errors?.phone[0]})
            }
            if(error?.response?.data?.errors?.project_id){
                validationModal.showErrors({'#projectModal': error?.response?.data?.errors?.project_id[0]})
            }
            if(error?.response?.data?.errors?.message){
                validationModal.showErrors({'#messageModal': error?.response?.data?.errors?.message[0]})
            }
            if(error?.response?.data?.message){
                errorToast(error?.response?.data?.message)
            }
        }finally{
            submitBtnModal.value =  `Submit`
            submitBtnModal.disabled = false;
        }
        });
    
        // initialize the validation library
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
        {
            rule: 'customRegexp',
            value: COMMON_REGEX,
            errorMessage: 'OTP is invalid',
        },
        ])
        .onSuccess(async (event) => {
        var submitOtpBtnModal = document.getElementById('submitOtpBtnModal')
        submitOtpBtnModal.value = 'Submitting ...'
        submitOtpBtnModal.disabled = true;
        try {
            var formData = new FormData();
            formData.append('otp',document.getElementById('otpModal').value)
    
            const response = await axios.post(linkModal, formData)
            event.target.reset();
            uuidModal = null;
            linkModal = null;
            contactModal.hide()
            event.target.classList.add("d-none")
            document.getElementById('contactFormModal').classList.remove("d-none")
            document.getElementById('contactFormModal').reset()
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
