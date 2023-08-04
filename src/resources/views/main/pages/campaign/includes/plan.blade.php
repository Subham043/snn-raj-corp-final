@if($data->CampaignPlanCategory->count() > 0)
<section class="m-0">
    <div class="plan-holder" id="plan-section">
        <div class="container">
            <div class="row justify-content-between align-items-center plan-header">
                <h2 class="main-title">
                    {!!$data->plan_heading!!}
                </h2>
                <button data-bs-toggle="modal" data-bs-target="#contactModal" aria-label="Download PDF">
                    Download PDF <i class="fas fa-download"></i>
                </button>
            </div>
            <div class="tab-holder">
                <div class="tab-panels">
                    <div class="row flex-wrap justify-content-between">
                        <div class="col-lg-2 col-md-3 col-sm-12">
                            <ul class="tabs">
                                @foreach ($data->CampaignPlanCategory as $k=>$v)
                                <li data-panel-name="panel{{$k}}" data-panel-key="{{$k}}" class="{{$k==0 ? 'active' : ''}}">{{$v->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-10 col-md-9 col-sm-12" style="position: relative;" id="floor-container">
                            {{-- <div class="loader-div-tab">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div> --}}

                            @foreach ($data->CampaignPlanCategory as $k=>$v)
                            <div id="panel{{$k}}" class="panel {{$k==0 ? 'active' : ''}}">
                                @if($v->CampaignPlanImage->count() > 0)
                                <div class="tab-regular slider owl-carousel">
                                    @foreach ($v->CampaignPlanImage as $item)
                                    <div class="slider-img">
                                        <img src="{{ $item->image_link }}" class="w-100"
                                            alt="Plan Image {{$item->id}}">
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            @endforeach

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>
@endif
