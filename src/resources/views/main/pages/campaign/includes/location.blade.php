@if($data->CampaignLocation && $data->CampaignConnectivity->count() > 0)
<section class="mt-5">
    <div class="connectivity-holder" id="location-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <h2 class="main-title text-center">
                        {!!$data->location_heading!!}
                    </h2>
                    {!!$data->CampaignLocation->description!!}
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 map-col">
                    <iframe
                        title="Map Iframe"
                        data-src="{{$data->CampaignLocation->location}}"
                        class="lazyload"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 image-col">
                    <img data-src="{{ $data->CampaignLocation->map_image_link }}" class="lazyload" alt="Map Image">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-col">
                    <h2 class="main-title text-center">
                        {!!$data->connectivity_heading!!}
                    </h2>
                    <div class="row">
                        @foreach ($data->CampaignConnectivity as $item)
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h6>{{$item->title}}</h6>
                            <ul class="row align-items-center justify-content-between">
                                @foreach ($item->points_list as $i)
                                <li class="col-lg-12 col-md-12 col-sm-12">
                                    <i class="fas fa-check"></i>
                                    {{$i}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endif
