<div class="modal fade" id="contactModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header flex-wrap">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="col-12 mt-2 text-center">
                    <img fetchpriority="low" class="modal-img" src="{{ asset('assets/black-logo.webp') }}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ asset('assets/black-logo.webp') }}">
                    <h5 class="modal-title">Reach Out To us</h5>
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
                    <div class="col-md-6 form-group">
                        <input id="phoneModal" type="text" placeholder="Your Number *" required>
                    </div>
                    <div class="col-md-6 form-group mt-2 mb-2">
                        <select id="projectModal" required>
                            <option value="">Project</option>
                            @foreach($projects as $p)
                                <option value="{{$p->name}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <textarea id="messageModal" cols="30" rows="4" placeholder="Message *" required></textarea>
                    </div>
                    <div class="col-md-4 text-center">
                        <button type="submit" id="submitBtnModal" class="btn btn-dark">Submit</button>
                    </div>
                </form>
                <form id="otpFormModal" class="d-none" method="post">
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
