@if($data->CampaignGallery->count() > 0)
<section>
    <div class="gallery-holder" id="gallery-section">
        <div class="container">
            <div class="text-center">
                <h2 class="main-title">
                    {!!$data->gallery_heading!!}
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 slider-holder mt-3">
                    <div class="gallery-slider slider">
                        @foreach ($data->CampaignGallery as $item)
                        <div class="slider-img" img-src="{{ $item->image_link }}">
                            <img src="{{ $item->image_link }}" class="w-100" alt="Gallery Image {{$item->id}}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endif
