<!-- Lets Talk -->
<section class="contact secondary-div mt-0">
    <div class="background bg-img bg-fixed" data-overlay-dark="6">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-30">
                    <div class="no-stretch-line sub-title border-bot-light">Contact Us</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Get in touch</div>
                    <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line
                        and we’ll get back to you shortly.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <!-- Contact Info -->
                    <p>{{ empty($generalSetting) ? '' : $generalSetting->address }}</p>
                    <a aria-label="phone" href="tel:{{ empty($generalSetting) ? '' : $generalSetting->phone }}"
                        class="phone">{{ empty($generalSetting) ? '' : $generalSetting->phone }}</a>
                    <a aria-label="email" href="mailto:{{ empty($generalSetting) ? '' : $generalSetting->email }}"
                        class="mail">{{ empty($generalSetting) ? '' : $generalSetting->email }}</a>
                    <div class="social mt-2">
                        <a aria-label="facebook" href="{{ empty($generalSetting) ? '' : $generalSetting->facebook }}"><i
                                class="ti-facebook"></i></a>
                        <a aria-label="instagram" href="{{ empty($generalSetting) ? '' : $generalSetting->instagram }}"><i
                                class="ti-instagram"></i></a>
                        <a aria-label="linkedin" href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin }}"><i
                                class="ti-linkedin"></i></a>
                        <a aria-label="youtube" href="{{ empty($generalSetting) ? '' : $generalSetting->youtube }}"><i
                                class="ti-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="name" id="name" type="text" placeholder="Full Name *" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="email" id="email" type="email" placeholder="Email *" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="phone" id="phone" type="text" placeholder="Phone *" required="">
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="subject" id="subject" type="text" placeholder="Subject *" required="">
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="line-gray" name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 mb-5">
                                <label>
                                    <input type="checkbox" class="line-gray">
                                    I authorize SNN Raj Corp and its representatives to call, SMS, email, or WhatsApp me about its products and offers, this consent overrides any registration for DNC / NDNC
                                </label>
                            </div>
                            <div class="col-md-2">
                                <input class="line-gray" name="submit" type="submit" id="submitBtn" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    <button type="submit" id="submitOtpBtn" class="btn btn-dark">Submit</button>
                    <button type="button" id="resendOtpBtn" class="btn btn-danger">Resend OTP</button>
                </form>

            </div>
        </div>
    </div>
</div>
