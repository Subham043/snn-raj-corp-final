<!-- Footer -->
<footer class="footer" id="footer_main_id">
    <div class="footer-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-30">
                    <div class="duru-logo-wrap footer-logo text-center">
                        <a aria-label="logo" href="{{route('home_page.get')}}" class="duru-logo"><img fetchpriority="low" class="lazyload" width="130" height="130" data-src="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}"></a>
                        <div class="row justify-content-center py-3">
                            <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                                <p class="text-white m-0">Building trust and transforming skylines since 1994. Discover premium residential and commercial spaces designed for modern living in Bangalore’s most sought-after locations.</p>
                            </div>
                        </div>
                        <div class="social mt-2">
                            <a aria-label="facebook" id="footer_facebook_button" href="{{ empty($generalSetting) ? '' : $generalSetting->facebook}}"><i class="ti-facebook"></i></a>
                            <a aria-label="instagram" id="footer_instagram_button" href="{{ empty($generalSetting) ? '' : $generalSetting->instagram}}"><i class="ti-instagram"></i></a>
                            <a aria-label="linkedin" id="footer_linkedin_button" href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin}}"><i class="ti-linkedin"></i></a>
                            <a aria-label="youtube" id="footer_youtube_button" href="{{ empty($generalSetting) ? '' : $generalSetting->youtube}}"><i class="ti-youtube"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Get In Touch</span></h3>
                        <p>{{ empty($generalSetting) ? '' : $generalSetting->address}}</p>
                        <a aria-label="{{ empty($generalSetting) ? '' : $generalSetting->phone}}" href="tel:{{ empty($generalSetting) ? '' : $generalSetting->phone}}" class="phone">{{ empty($generalSetting) ? '' : $generalSetting->phone}}</a>
                        <a aria-label="{{ empty($generalSetting) ? '' : $generalSetting->email}}" href="mailto:{{ empty($generalSetting) ? '' : $generalSetting->email}}" class="mail">{{ empty($generalSetting) ? '' : $generalSetting->email}}</a>
                        {{-- <div class="social mt-2">
                            <a aria-label="facebook" href="{{ empty($generalSetting) ? '' : $generalSetting->facebook}}"><i class="ti-facebook"></i></a>
                            <a aria-label="instagram" href="{{ empty($generalSetting) ? '' : $generalSetting->instagram}}"><i class="ti-instagram"></i></a>
                            <a aria-label="linkedin" href="{{ empty($generalSetting) ? '' : $generalSetting->linkedin}}"><i class="ti-linkedin"></i></a>
                            <a aria-label="youtube" href="{{ empty($generalSetting) ? '' : $generalSetting->youtube}}"><i class="ti-youtube"></i></a>
                        </div> --}}
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Company</span></h3>
                        <a aria-label="about us" href="{{route('about_page.get')}}" id="footer_about_button">About Us</a><br/>
                        <a aria-label="awards" href="{{route('awards_page.get')}}" id="footer_awards_button">Awards</a><br/>
                        <a aria-label="csr" href="{{route('csr_page.get')}}" id="footer_csr_button">CSR</a><br/>
                        <a aria-label="about us" href="{{route('about_page.get')}}/learn-more-about-engineering-and-labs" id="footer_engineering_button">Engineering & Labs</a><br/>
                        <a aria-label="csr" href="{{route('projects.get')}}" id="footer_projects_button">Projects</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Media Center</span></h3>
                        {{-- <a aria-label="ongoing projects" href="{{route('ongoing_projects.get')}}">Blogs</a><br/> --}}
                        <a aria-label="blogs" href="{{route('blogs.get')}}" id="footer_blogs_button">Blogs</a><br/>
                        <a aria-label="newsletter" href="#" id="footer_news_letter_button">News Letter</a><br/>
                        <a aria-label="press release" href="#" id="footer_press_release_button">Press Release</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Get In Touch</span></h3>
                        <a aria-label="contact us" href="{{route('contact_page.get')}}" id="footer_contact_button">Contact Us</a><br/>
                        <a aria-label="referral" href="{{route('referal_page.get')}}" id="footer_referral_button">Referral</a><br/>
                        <a aria-label="become a channel partner" href="{{route('channel_partner.get')}}" id="footer_channel_partner_button">Become A Channel Partner</a><br/>
                        <a aria-label="land owner" href="{{route('land_owner.get')}}" id="footer_land_owner_button">Land Owner</a><br/>
                        <a aria-label="career" href="{{route('career_page.get')}}" id="footer_career_button">Career</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>© {{date('Y')}} {{ empty($generalSetting) ? '' : $generalSetting->website_name}}. All right reserved.</p>
                </div>
                <div class="col-md-8">
                    <p class="right">
                        @foreach($legal as $k => $legal)
                            <a aria-label="{{$legal->page_name}}" href="{{route('legal.get', $legal->slug)}}" id="footer_legal_{{$k+1}}_button" class="mx-2">{{$legal->page_name}}</a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
