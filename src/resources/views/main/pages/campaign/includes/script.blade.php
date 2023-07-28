<script src="https://kit.fontawesome.com/b6a944420c.js" crossorigin="anonymous" async></script>
<script src="{{ asset('campaign/js/jquery.js') }}"></script>
<script src="{{ asset('campaign/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('campaign/js/img-previewer.js') }}"></script>
<script src="{{ asset('campaign/js/slick.js') }}"></script>
<script src="{{ asset('campaign/js/iziToast.min.js') }}"></script>
<script src="{{ asset('campaign/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/axios.min.js') }}"></script>
<script src="{{ asset('admin/js/pages/just-validate.production.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
<script nonce="{{ csp_nonce() }}" defer>
  const countryData1 = window.intlTelInput(document.querySelector("#phone"), {
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
  const countryData2 = window.intlTelInput(document.querySelector("#phone2"), {
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

{!!$data->meta_footer!!}

<script type="text/javascript" nonce="{{ csp_nonce() }}" defer>
(function( $ ) {
    $(document).ready(function() {

        $(".regular").slick({
            dots: false,
            infinite: true,
            adaptiveHeight: true,
            arrows: false,
            // prevArrow: '<button type="button" data-role="none" class="slick-prev"><i class="fas fa-long-arrow-alt-left"></i></button>',
            // nextArrow: '<button type="button" data-role="none" class="slick-next"><i class="fas fa-long-arrow-alt-right"></i></button>',
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
            ]
        });
        $(".gallery-slider").slick({
            dots: true,
            infinite: true,
            adaptiveHeight: true,
            arrows: true,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left"></i></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right"></i></button>',
            customPaging: function(slider, i) {
                return '<button  aria-label="Image Slider Index"> <img src="' + $(slider.$slides[i]).attr('img-src') + '"/></button>';
            },
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
            ]
        });
        $(".tab-regular").owlCarousel({
            items: 1,
            center: true,
            autoplay: true,
            rewind: true,
            nav: true,
            dots: false,
            navText: [
                '<button type="button" data-role="none" class="slick-prev slick-arrow" style="" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i></button>',
                '<button type="button" data-role="none" class="slick-next slick-arrow" style="" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i></button>'
            ]
        });
        $(".creation").slick({
            dots: false,
            infinite: true,
            adaptiveHeight: true,
            // arrows: false,
            prevArrow: '<button type="button" data-role="none" class="slick-prev" aria-label="Previous Button"><i class="fas fa-long-arrow-alt-left"></i></button>',
            nextArrow: '<button type="button" data-role="none" class="slick-next" aria-label="Next Button"><i class="fas fa-long-arrow-alt-right"></i></button>',
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: false
                    }
                },
            ]
        });

        $('.tab-panels .tabs li').click(function(){
            var $panel = $(this).closest('.tab-panels');


            //event listener listening for clicks on the tabs panels

            //figure out which panel to show

            $panel.find(' .tabs li.active').removeClass('active');

            $(this).addClass('active');

            var clickedPanel = $(this).attr('data-panel-name');
            var clickedPanelKey = parseInt($(this).attr('data-panel-key'))

            //hide current panel
            $panel.find('.panel.active').slideUp(300, nextPanel);

            //show new panel
            function nextPanel(){
                $(this).removeClass('active');

                $('#'+clickedPanel).slideDown(300, function(){
                    $(this).addClass('active');
                });
            }
        })

        const myModal = new bootstrap.Modal('#exampleModal', {
            keyboard: false
        })
        setTimeout(function() {
            myModal.show();
        }, 5000);

        const errorToast = (message) => {
    iziToast.error({
        title: 'Error',
        message: message,
        position: 'bottomCenter',
        timeout: 7000
    });
}
const successToast = (message) => {
    iziToast.success({
        title: 'Success',
        message: message,
        position: 'bottomCenter',
        timeout: 6000
    });
}
    let uuid = null;
    let link = null;
    var myModalOtp = new bootstrap.Modal(document.getElementById('staticBackdropContact'), {
        keyboard: false
    })

    // initialize the validation library
    const validation = new JustValidate('#contact-form', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation
      .addField('#name', [
        {
          rule: 'required',
          errorMessage: 'Name is required',
        },
      ])
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
      .addField('#phone', [
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
        var submitBtn = document.getElementById('submitBtn')
        submitBtn.innerHTML = `
        <span class="d-flex align-items-center">
            <span class="spinner-border flex-shrink-0" role="status">
                <span class="visually-hidden"></span>
            </span>
            <span class="flex-grow-1 ms-2">
                &nbsp; Submiting...
            </span>
        </span>
        `
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('name').value)
            formData.append('email',document.getElementById('email').value)
            formData.append('phone',document.getElementById('phone').value)
            formData.append('page_url',document.getElementById('page_url').value)
            formData.append('country_code',countryData1.getSelectedCountryData().dialCode)
            const response = await axios.post('{{route('enquiry_create.post')}}', formData)
            // successToast(response.data.message)
            // event.target.reset()
            // setTimeout(()=> {
            //     window.location.replace("{{route('campaign_view_thank.get', $data->slug)}}");
            // }
            // ,3000);
            event.target.reset();
            uuid = response.data.uuid;
            link = response.data.link;
            myModal.hide()
            myModalOtp.show()
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

    // initialize the validation library
    const validation2 = new JustValidate('#banner-form', {
          errorFieldCssClass: 'is-invalid',
    });
    // apply rules to form fields
    validation2
      .addField('#name2', [
        {
          rule: 'required',
          errorMessage: 'Name is required',
        },
      ])
      .addField('#email2', [
        {
          rule: 'required',
          errorMessage: 'Email is required',
        },
        {
          rule: 'email',
          errorMessage: 'Email is invalid',
        },
      ])
      .addField('#phone2', [
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
        var submitBtn = document.getElementById('submitBtn2')
        submitBtn.innerHTML = `
        <span class="d-flex align-items-center">
            <span class="spinner-border flex-shrink-0" role="status">
                <span class="visually-hidden"></span>
            </span>
            <span class="flex-grow-1 ms-2">
                &nbsp; Submiting...
            </span>
        </span>
        `
        submitBtn.disabled = true;
        try {
            var formData = new FormData();
            formData.append('name',document.getElementById('name2').value)
            formData.append('email',document.getElementById('email2').value)
            formData.append('phone',document.getElementById('phone2').value)
            formData.append('page_url',document.getElementById('page_url').value)
            formData.append('country_code',countryData2.getSelectedCountryData().dialCode)
            const response = await axios.post('{{route('enquiry_create.post')}}', formData)
            // console.log(response);
            // successToast(response.data.message)
            // event.target.reset()
            // setTimeout(()=> {
            //     window.location.replace("{{route('campaign_view_thank.get', $data->slug)}}");
            // }
            // ,1000);
            event.target.reset();
            uuid = response.data.uuid;
            link = response.data.link;
            myModalOtp.show()
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

      const validationOtp = new JustValidate('#otpForm', {
              errorFieldCssClass: 'is-invalid',
        });
        // apply rules to form fields
        validationOtp
          .addField('#otp', [
            {
              rule: 'required',
              errorMessage: 'OTP is required',
            },
          ])
          .onSuccess(async (event) => {
            var submitOtpBtn = document.getElementById('submitOtpBtn')
            submitOtpBtn.value = 'Submitting ...'
            submitOtpBtn.disabled = true;
            try {
                var formData = new FormData();
                formData.append('otp',document.getElementById('otp').value)
                formData.append('slug',document.getElementById('slug').value)

                const response = await axios.post(link, formData)
                event.target.reset();
                uuid = null;
                link = null;
                myModalOtp.hide()
                successToast(response.data.message)
                setTimeout(()=> {
                    window.location.replace("{{route('campaign_view_thank.get', $data->slug)}}");
                }
                ,3000);
            }catch (error){
                if(error?.response?.data?.errors?.otp){
                    errorToast(error?.response?.data?.errors?.otp[0])
                }
                if(error?.response?.data?.message){
                    errorToast(error?.response?.data?.message)
                }
                if(error?.response?.data?.error){
                    errorToast(error?.response?.data?.error)
                }
            }finally{
                submitOtpBtn.value =  `Submit`
                submitOtpBtn.disabled = false;
            }
          });

          document.getElementById('resendOtpBtn').addEventListener('click', async function(event){
            if(uuid){
                event.target.innerText = 'Sending ...'
                event.target.disabled = true;
                try {
                    var formData = new FormData();
                    formData.append('uuid',uuid)
                    const response = await axios.post('{{route('enquiry.resendOtp')}}', formData)
                    successToast(response.data.message)
                }catch (error){
                    if(error?.response?.data?.message){
                        errorToast(error?.response?.data?.message)
                    }
                    if(error?.response?.data?.error){
                        errorToast(error?.response?.data?.error)
                    }
                }finally{
                    event.target.innerText = 'Resend OTP'
                    event.target.disabled = false;
                }
            }
          })

    });
})(jQuery);

</script>
