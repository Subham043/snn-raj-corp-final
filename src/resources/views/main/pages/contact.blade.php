@extends('main.layouts.index')

@section('css')
    <style nonce="{{ csp_nonce() }}">
        .pagination-wrap {
            position: relative;
            z-index: 10;
            pointer-events: all;
        }
    </style>
@stop

@section('content')

    <!-- Contact -->
    <div class="contact section-padding">
        <div class="container">
            <div class="row mb-5 animate-box" data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">Contact</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Get in touch</div>
                    <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line and we’ll get back to you shortly.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 animate-box" data-animate-effect="fadeInUp">
                    <!-- Contact Info -->
                    <p>1616 Broadway NY, New York 10001<br>United States of America.</p>
                    <div class="phone">+1 203-123-0606</div>
                    <div class="mail mb-3">info@architect.com</div>
                    <div class="social mt-2">
                        <a href="index.html"><i class="ti-twitter"></i></a>
                        <a href="index.html"><i class="ti-instagram"></i></a>
                        <a href="index.html"><i class="ti-linkedin"></i></a>
                    </div>
                </div>
                <!-- form -->
                <div class="col-md-8 animate-box" data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form"
                        action="https://duruthemes.com/demo/html/archsan/dark/mail.php">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input name="subject" type="text" placeholder="Subject *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input name="submit" type="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Maps -->
    <div class="google-maps">
        <iframe id="gmap_canvas"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13419.032130422971!2d-79.94077173022463!3d32.772154400000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88fe7a1ae84ff639%3A0xe5c782f71924a526!2s24%20King%20St%2C%20Charleston%2C%20SC%2029401%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1665070628853!5m2!1str!2str"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

@stop
