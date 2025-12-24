@if($data->CampaignAbout)
<section>
    <div class="container">
        <div class="about-holder" id="about-section">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-6 col-sm-12 slider-holder">
                    <div class="slider-img">
                        <img data-src="{{ $data->CampaignAbout->left_image_link }}" class="lazyload w-100" alt="Project Image" width="{{$isMobile ? '406px' : '526px'}}" height="{{$isMobile ? '487px' : '631px'}}">
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 content-holder">
                    <div class="logo-secondary text-center">
                        <img data-src="{{ $data->CampaignAbout->about_logo_link }}" class="lazyload" alt="Project Logo" width="{{$isMobile ? '220px' : '220px'}}" height="{{$isMobile ? '220px' : '220px'}}">
                    </div>
                    <!-- <h2 class="main-title text-center">
                        Raj <span>Viviente</span>
                    </h2> -->
                    <h6 class="text-center">
                        <span>RERA NUMBER:</span> {{ $data->CampaignAbout->rera }}
                    </h6>
                    {!! $data->CampaignAbout->description !!}
                </div>
            </div>
        </div>
    </div>
</section>
@endif
