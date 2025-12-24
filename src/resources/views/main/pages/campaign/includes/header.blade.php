<header role="banner">
    <nav>
        <div class="logo-holder">
            <a href="{{ Request::url() }}" aria-label='Logo Link'>
                <img src="{{ $data->header_logo_link }}" class="main-logo top-logo" alt="Project Logo"  fetchpriority="high" loading="eager" width="{{$isMobile ? '75px' : '120px'}}" height="{{$isMobile ? '75px' : '120px'}}">
            </a>
        </div>
    </nav>
</header>
