@extends('main.layouts.index')

@section('css')

    <title>{{$seo->meta_title}}</title>
    <meta name="description" content="{{$seo->meta_description}}"/>
    <meta name="keywords" content="{{$seo->meta_keywords}}"/>

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="profile" />
    <meta property="og:title" content="{{$seo->meta_title}}" />
    <meta property="og:description" content="{{$seo->meta_description}}" />
    <meta property="og:url" content="{{Request::url()}}" />
    <meta property="og:site_name" content="{{$seo->meta_title}}" />
    <meta property="og:image" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:card" content="{{ asset('assets/images/logo.png')}}" />
    <meta name="twitter:label1" content="{{$seo->meta_title}}" />
    <meta name="twitter:data1" content="{{$seo->meta_description}}" />

    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="32x32" />
    <link rel="icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ empty($generalSetting) ? asset('assets/images/favicon.png') : $generalSetting->website_favicon_link}}" />

    {!!$seo->meta_header_script!!}
    {!!$seo->meta_header_no_script!!}

    <style nonce="{{ csp_nonce() }}">
        .pagination-wrap {
            position: relative;
            z-index: 10;
            pointer-events: all;
        }
        .contact .phone, .contact .social a {
            color: #000;
        }
        input[type=password].line-gray, input[type=email].line-gray, input[type=text].line-gray, input[type=file].line-gray, textarea.line-gray {
            border-bottom: 1px solid black;
        }
    </style>
@stop

@section('content')

    @include('main.includes.referal')
    <div class="py-5"></div>

    <!-- Contact -->
    <div class="contact secondary-div mt-0">
        <div class="container">
            <div class="row mb-5 " data-animate-effect="fadeInUp">
                <div class="col-md-4">
                    <div class="sub-title border-bot-light">Contact</div>
                </div>
                <div class="col-md-8">
                    <div class="section-title">Get in touch</div>
                    <p>If you’re looking for a home or just want to find out more about us and our projects, drop us a line and we’ll get back to you shortly.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 " data-animate-effect="fadeInUp">
                    <!-- Contact Info -->
                    <p>{{ empty($generalSetting) ? '' : $generalSetting->address}}</p>
                    <p class="phone">{{ empty($generalSetting) ? '' : $generalSetting->phone}}</p>
                    <p class="mail">{{ empty($generalSetting) ? '' : $generalSetting->email}}</p>
                    <div class="social mt-2">
                        <a href="{{ empty($generalSetting) ? '' : $generalSetting->facebook}}"><i class="ti-facebook"></i></a>
                        <a href="{{ empty($generalSetting) ? '' : $generalSetting->instagram}}"><i class="ti-instagram"></i></a>
                        <a href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin}}"><i class="ti-linkedin"></i></a>
                        <a href="{{ empty($generalSetting) ? '' : $generalSetting->youtube}}"><i class="ti-youtube"></i></a>
                    </div>
                </div>
                <!-- form -->
                <div class="col-md-8 " data-animate-effect="fadeInUp">
                    <form method="post" class="contact__form" id="contactForm">
                        <!-- Form elements -->
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="name" id="name" type="text" placeholder="Your Name *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="email" id="email" type="email" placeholder="Your Email *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="phone" id="phone" type="text" placeholder="Your Number *" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input class="line-gray" name="subject" id="subject" type="text" placeholder="Subject *" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <textarea class="line-gray" name="message" id="message" cols="30" rows="4" placeholder="Message *" required></textarea>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="col-md-12 mt-3 mb-5">
                                    <input type="checkbox" class="line-gray">
                                    <label>I agree with the <a href="{{route('legal.get', 'privacy-policy')}}" class="underline line-gray">privacy policy</a></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <input name="submit" id="submitBtn" type="submit" value="Send Message">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Maps -->
    {{-- <div class="google-maps">
        <iframe id="gmap_canvas"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13419.032130422971!2d-79.94077173022463!3d32.772154400000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88fe7a1ae84ff639%3A0xe5c782f71924a526!2s24%20King%20St%2C%20Charleston%2C%20SC%2029401%2C%20Amerika%20Birle%C5%9Fik%20Devletleri!5e0!3m2!1str!2str!4v1665070628853!5m2!1str!2str"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> --}}


@stop

@section('js')

    {!!$seo->meta_footer_script_nonce!!}
    {!!$seo->meta_footer_no_script_nonce!!}

@stop
