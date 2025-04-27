<!-- Preloader -->
<div id="preloader-bg" class="preloader-bg"></div>
<div id="preloader">
    <div class="text-center">
        <a aria-label="logo" href="{{route('home_page.get')}}" class="preloader-logo"><img fetchpriority="high" src="{{ asset('assets/black-logo.webp') }}" width="70" height="70" alt="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_alt}}" title="{{ empty($generalSetting) ? '' : $generalSetting->website_logo_title}}" data-img="{{ asset('assets/black-logo.webp') }}"></a>
    </div>
    <div id="preloader-status">
        <div class="preloader-position loader"> <span></span> </div>
    </div>
</div>
