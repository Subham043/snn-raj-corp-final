<!-- Footer -->
<footer class="footer">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-30">
                    {{-- <div class="sub-title border-footer-light">Contact Us</div> --}}
                    <div class="duru-logo-wrap footer-logo">
                        <a href="{{route('home_page.get')}}" class="duru-logo"><img fetchpriority="low" src="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}"></a>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="item">
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

                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Company</span></h3>
                        <a href="{{route('about_page.get')}}">About Us</a><br/>
                        <a href="{{route('awards_page.get')}}">Awards</a><br/>
                        <a href="{{route('csr_page.get')}}">CSR</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Projects</span></h3>
                        <a href="{{route('completed_projects.get')}}">Completed</a><br/>
                        <a href="{{route('ongoing_projects.get')}}">Ongoing</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="item">
                        <h3><span>Get In Touch</span></h3>
                        <a href="{{route('contact_page.get')}}">Contact Us</a>
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
                        @foreach($legal as $legal)
                            <a href="{{route('legal.get', $legal->slug)}}" class="mx-2">{{$legal->page_name}}</a>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
