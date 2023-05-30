<!-- Menu -->
<div class="duru-wrap">
    <div class="duru-wrap-inner">
        <nav class="duru-menu">
            <ul>
                <li><a aria-label="home page" href="{{route('home_page.get')}}">Home</a></li>
                <li><a aria-label="about page" href="{{route('about_page.get')}}">About Us</a></li>
                <li><a aria-label="projects page" href="{{route('projects.get')}}">Projects</a></li>
                {{-- <li class='duru-menu-sub'><a href='#'>Projects <i class="ti-angle-down"></i></a>
                    <ul>
                        <li><a href='{{route('completed_projects.get')}}'>Completed Projects</a></li>
                        <li><a href='{{route('ongoing_projects.get')}}'>Ongoing Projects</a></li>
                    </ul>
                </li> --}}
                <li><a aria-label="awards page" href="{{route('awards_page.get')}}">Awards</a></li>
                <li><a aria-label="csr page" href="{{route('csr_page.get')}}">CSR</a></li>
                <li><a aria-label="blogs page" href="{{route('blogs.get')}}">Blogs</a></li>
                <li><a aria-label="contact us page" href="{{route('contact_page.get')}}">Contact</a></li>
                <li><a aria-label="referral page" href="{{route('referal_page.get')}}">Referral</a></li>
            </ul>
        </nav>
    </div>
</div>
<!-- Logo & Menu Burger -->
<header class="duru-header">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-md-6 duru-logo-wrap">
                <a aria-label="logo" href="{{route('home_page.get')}}" class="duru-logo"><img fetchpriority="high" src="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}"></a>
            </div>
            <!-- Menu Burger -->
            <div class="col-6 col-md-6 text-right duru-wrap-burger-wrap"> <a aria-label="menu" href="#" class="duru-nav-toggle duru-js-duru-nav-toggle"><i></i></a> </div>
        </div>
    </div>
</header>
