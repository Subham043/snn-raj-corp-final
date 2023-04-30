<!-- Menu -->
<div class="duru-wrap">
    <div class="duru-wrap-inner">
        <nav class="duru-menu">
            <ul>
                <li><a href="{{route('home_page.get')}}">Home</a></li>
                <li><a href="{{route('about_page.get')}}">About Us</a></li>
                <li class='duru-menu-sub'><a href='#'>Projects <i class="ti-angle-down"></i></a>
                    <ul>
                        <li><a href='{{route('completed_projects.get')}}'>Completed Projects</a></li>
                        <li><a href='{{route('ongoing_projects.get')}}'>Ongoing Projects</a></li>
                    </ul>
                </li>
                <li><a href="{{route('awards_page.get')}}">Awards</a></li>
                <li><a href="{{route('csr_page.get')}}">CSR</a></li>
                <li><a href="{{route('blogs.get')}}">Blogs</a></li>
                <li><a href="{{route('contact_page.get')}}">Contact</a></li>
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
                <a href="{{route('home_page.get')}}" class="duru-logo"><img src="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ empty($generalSetting) ? asset('assets/images/logo.png') : $generalSetting->website_logo_link}}"></a>
            </div>
            <!-- Menu Burger -->
            <div class="col-6 col-md-6 text-right duru-wrap-burger-wrap"> <a href="#" class="duru-nav-toggle duru-js-duru-nav-toggle"><i></i></a> </div>
        </div>
    </div>
</header>
