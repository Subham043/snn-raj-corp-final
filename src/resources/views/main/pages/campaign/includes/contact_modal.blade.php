<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enquire Now</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="contact-form" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            aria-describedby="emailHelp" placeholder="john@domain.com">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="983*******">
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn" aria-label="Submit Form">Submit</button>
                </form>

            </div>
        </div>
    </div>
</div>

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
