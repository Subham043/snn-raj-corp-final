@if($data->CampaignBanner)
<section class="">
    <div class="banner-holder2" style="background-image: url('{{$data->CampaignBanner->banner_image_link}}')">
        <img src="{{ $data->CampaignBanner->banner_image_link }}" alt="Banner"  fetchpriority="high" loading="eager">
        <div class="banner-form-container">
            <div id="tophighlights">

                <div id="topform" class="formbackground" style="background-color: #F7F2EC;background-image: unset;">

                    <div
                        style="margin-bottom:10px !important;    border-bottom: 2px solid #1C1919;padding-bottom:8px;padding-top:0px;">
                        <h1 class="mb8 text-center" style="color:#1C1919;"><b>{{ $data->CampaignBanner->heading }}</b>
                        </h1>
                        <h1 class="mb16 text-center" style="    line-height:24px;color:#1C1919;"><b
                                style="font-size:14px;    font-weight: 400;">{{ $data->CampaignBanner->sub_heading }}</b></h1>
                    </div>
                    <ul>
                        @foreach ($data->CampaignBanner->points_list as $item)
                        <li style="font-weight:700;"><span style="color: #3D833E;">➤</span> {{$item}}</li>
                        @endforeach
                    </ul>



                    <p
                        style="padding: 5px;font-size:0.8rem;text-align:center;background-color:#3D833E;border-radius: 5px;color:#fff;">
                        Download Brochure & Floorplans<br><span class='ctanow'><b style="color:#fff;">*Register for
                                Special Offers Now*</b></span></p>

                    <form id="banner-form" class="row" method="post">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <input type="text" class="form-control" id="name2" name="name"
                                placeholder="Enter your Name">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <input type="email" class="form-control" id="email2" name="email"
                                aria-describedby="emailHelp" placeholder="Enter your email">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                            <input type="number" class="form-control" id="phone2" name="phone"
                                placeholder="Enter your phone">
                        </div>
                        <input type="hidden" name="page_url" id="page_url" value="{{Request::url()}}">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary formbuttonstyler" aria-label="Submit Form"
                                id="submitBtn2">Submit</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
</section>
@endif
