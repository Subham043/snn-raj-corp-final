<button type="button" class="popup_btn_modal" aria-label="Enquiry Popup"  data-bs-toggle="modal" data-bs-target="#contactModal">
    <img src="{{asset('smartphone.svg')}}" fetchpriority="high" loading="eager" title="Enquiry Popup" alt="Enquiry Popup" width="35" height="35" style="height: 35px; width:35px;" />
</button>

<div class="modal fade" id="contactModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header flex-wrap">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="col-12 mt-2 text-center">
                    <img fetchpriority="low" class="modal-img lazyload" data-src="{{ asset('assets/black-logo.webp') }}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ asset('assets/black-logo.webp') }}">
                    <h5 class="modal-title mt-1 fw-bold"><strong>Get A Callback</strong></h5>
                </div>
            </div>
            <div class="modal-body">

                <form id="contactFormModal" class="row justify-content-center" method="post">
                    {{-- <h4 class="text-center">Reach Out To Us</h4> --}}
                    <div class="col-md-6 form-group">
                        <input id="nameModal" type="text" placeholder="Your Name *" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <input id="emailModal" type="email" placeholder="Your Email *" required>
                    </div>
                    @if(request()->is('ongoing-projects/*') || request()->is('completed-projects/*'))
                    <div class="col-md-12 form-group">
                        <input id="phoneModal" type="text" placeholder="Your Number *" required>
                    </div>
                    <input type="hidden" id="projectModal" value="{{$data->id}}">
                    @else
                    <div class="col-md-6 form-group">
                        <input id="phoneModal" type="text" placeholder="Your Number *" required>
                    </div>
                    <div class="col-md-6 form-group mt-2 mb-2">
                        <select id="projectModal" required>
                            <option value="">Project</option>
                            @foreach($projects as $p)
                                @if(!$p->is_completed)
                                <option value="{{$p->id}}">{{$p->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="col-md-12 form-group">
                        <textarea id="messageModal" cols="30" rows="2" placeholder="Message *" required></textarea>
                    </div>
                    <div class="col-md-12 mt-2 mb-4">
                        <div class="col-md-12">
                            <label style="width: 290px;font-size:0.8rem;line-height: 15px;">
                                <input type="checkbox" class="line-gray">
                                I authorize SNN Raj Corp and its representatives to call, SMS, email, or WhatsApp me about its products and offers, this consent overrides any registration for DNC / NDNC
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" id="submitBtnModal" class="btn btn-dark">Submit</button>
                    </div>
                </form>
                <form id="otpFormModal" class="d-none" method="post">
                    <button type="button" id="backOtpBtnModal" class="btn btn-link px-0" style="text-decoration: none"><i class="ti-angle-left" aria-hidden="true"></i> Go Back</button>
                    <div class="mb-3">
                      <input type="text" id="otpModal" aria-describedby="otpHelp" placeholder="OTP *">
                      <div id="otpHelp" class="form-text">We have shared an OTP to your mobile via SMS.</div>
                    </div>
                    <button type="submit" id="submitOtpBtnModal" class="btn btn-dark">Submit</button>
                    <button type="button" id="resendOtpBtnModal" class="btn btn-danger">Resend OTP</button>
                </form>

            </div>
        </div>
    </div>
</div>
