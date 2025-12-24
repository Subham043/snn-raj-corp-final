@if($data->CampaignAmenities->count() > 0)
<section>
    <div class="amenities-holder" id="amenities-section">
        <div class="container">
            <div class="text-center">
                <h2 class="main-title">
                    {!!$data->amenities_heading!!}
                </h2>
            </div>
            <div class="row mt-5 justify-sm-around">
                @foreach ($data->CampaignAmenities as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 amenities-col">
                    <img data-src="{{ $item->icon_image_link }}" alt="{{$item->title}}" class="lazyload" width="75px" height="75px">
                    <h6>{{$item->title}}</h6>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
