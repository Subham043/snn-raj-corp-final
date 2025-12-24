<div class="modal fade" id="contactModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header flex-wrap">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="col-12 mt-2 text-center">
                    <img fetchpriority="low" class="modal-img lazyload" data-src="{{ asset('assets/black-logo.webp') }}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ asset('assets/black-logo.webp') }}" width="{{$isMobile ? '70px' : '70px'}}" height="{{$isMobile ? '70px' : '70px'}}">
                    <h5 class="modal-title mt-1">Get A Callback</h5>
                </div>
            </div>
            <div class="modal-body">

                <form id="contactFormModal" class="row justify-content-center" method="post">
                    {{-- <h4 class="text-center">Reach Out To Us</h4> --}}
                    <div class="col-md-12 form-group">
                        <input id="nameModal" type="text" placeholder="Your Name *" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input id="emailModal" type="email" placeholder="Your Email *" required>
                    </div>
                    <div class="col-md-12 form-group">
                        <input id="phoneModal" type="text" placeholder="Your Number *" required>
                    </div>
                    <div class="col-md-12 mt-4 mb-4">
                        <div class="col-md-12">
                            <label style="width: 270px;font-size:0.8rem;line-height: 15px;">
                                <input type="checkbox" class="line-gray">
                                I authorize SNN Raj Corp and its representatives to call, SMS, email, or WhatsApp me about its products and offers, this consent overrides any registration for DNC / NDNC
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" id="submitBtnModal" class="btn btn-dark" aria-label="Submit Form">Submit</button>
                    </div>
                </form>
                <form id="otpFormModal" class="d-none" method="post">
                    <button type="button" id="backOtpBtnModal" class="btn btn-link px-0" aria-label="Go Back" style="text-decoration: none"><i class="fa-solid fa-arrow-left"></i> Go Back</button>
                    <div class="mb-3">
                      <input type="text" id="otpModal" aria-describedby="otpHelp" placeholder="OTP *">
                      <div id="otpHelp" class="form-text">We have shared an OTP to your mobile via SMS.</div>
                    </div>
                    <input type="hidden" id="slugModal" value="{{$data->id}}">
                    <button type="submit" id="submitOtpBtnModal" class="btn btn-dark" aria-label="Submit Form">Submit</button>
                    <button type="button" id="resendOtpBtnModal" class="btn btn-danger" aria-label="Resend OTP">Resend OTP</button>
                </form>

            </div>
        </div>
    </div>
</div>
<button type="button" class="popup_btn_modal"  data-bs-toggle="modal" data-bs-target="#contactModal" aria-label="Enquiry Pop Up">
    <img src="{{asset('smartphone.svg')}}" style="height: 35px; width:35px;" alt="Enquiry Pop Up" />
</button>


<div class="modal fade" id="staticBackdropContact" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Verify Mobile Number</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="otpForm" method="post">
                    <div class="mb-3">
                      <input type="text" class="form-control" id="otp" name="otp" aria-describedby="otpHelp" placeholder="OTP *">
                      <div id="otpHelp" class="form-text">We have shared an OTP to your mobile via SMS.</div>
                    </div>
                    <input type="hidden" id="slug" name="slug" value="{{$data->id}}">
                    <button type="submit" id="submitOtpBtn" class="btn btn-dark" aria-label="Submit Form">Submit</button>
                    <button type="button" id="resendOtpBtn" class="btn btn-danger" aria-label="Resend OTP">Resend OTP</button>
                </form>

            </div>
        </div>
    </div>
</div>
