<!-- Menu -->
<div id="duru-wrap-main" class="duru-wrap">
    <div class="duru-wrap-inner">
        <nav class="duru-menu">
            <ul>
                <li><a aria-label="home page" href="{{route('home_page.get')}}" id="sidebar_home_button">Home</a></li>
                <li><a aria-label="about us page" href="{{route('about_page.get')}}" id="sidebar_about_button">About Us</a></li>
                <li><a aria-label="projects page" href="{{route('projects.get')}}" id="sidebar_projects_button">Projects</a></li>
                {{-- <li class='duru-menu-sub'><a href='#'>Projects <i class="ti-angle-down"></i></a>
                    <ul>
                        <li><a href='{{route('completed_projects.get')}}'>Completed Projects</a></li>
                        <li><a href='{{route('ongoing_projects.get')}}'>Ongoing Projects</a></li>
                    </ul>
                </li> --}}
                <li><a aria-label="awards page" href="{{route('awards_page.get')}}" id="sidebar_awards_button">Awards</a></li>
                <li><a aria-label="csr page" href="{{route('csr_page.get')}}" id="sidebar_csr_button">CSR</a></li>
                <li><a aria-label="learn-more-about-engineering-and-labs" href="{{route('about_page.get')}}/learn-more-about-engineering-and-labs" id="sidebar_engineering_button">Engineering & Labs</a></li>
                <li><a aria-label="blogs page" href="{{route('blogs.get')}}" id="sidebar_blogs_button">Blogs</a></li>
                <li><a aria-label="contact us page" href="{{route('contact_page.get')}}" id="sidebar_contact_button">Contact</a></li>
                <li><a aria-label="referral page" href="{{route('referal_page.get')}}" id="sidebar_referral_button">Referral</a></li>
                <li><a aria-label="become a channel partner page" href="{{route('channel_partner.get')}}" id="sidebar_channel_partner_button">Become A Channel Partner</a></li>
                <li><a aria-label="land owner page" href="{{route('land_owner.get')}}" id="sidebar_land_owner_button">Land Owner</a></li>
                <li><a aria-label="career page" href="{{route('career_page.get')}}" id="sidebar_career_button">Career</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- Logo & Menu Burger -->
<header id="duru-header" class="duru-header">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-md-6 duru-logo-wrap">
                {{-- <a aria-label="logo" href="{{route('home_page.get')}}" class="duru-logo"><img fetchpriority="high" src="{{ empty($generalSetting) ? asset('assets/images/black-logo.webp') : $generalSetting->website_logo_link}}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}"></a> --}}
                <a aria-label="logo" href="{{route('home_page.get')}}" class="duru-logo"><img fetchpriority="high" src="{{ asset('assets/black-logo.webp') }}" width="70" height="70" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ asset('assets/black-logo.webp') }}"></a>
            </div>
            <!-- Menu Burger -->
            <div class="col-6 col-md-6 text-right duru-wrap-burger-wrap"> <a aria-label="menu" role="button" id="duru-js-duru-nav-toggle" class="duru-nav-toggle duru-js-duru-nav-toggle"><i></i></a> </div>
        </div>
    </div>
</header>
