@if($data->CampaignTable->count() > 0)
<section>
    <div class="amenities-holder" id="amenities-section">
        <div class="container">
            <div class="text-center">
                <h2 class="main-title">
                    {!!$data->table_heading!!}
                </h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <table class="tg" border="1" cellspacing="0" style="max-width:800px;margin:auto;">
                        <tbody>
                            <tr>
                                <th class="tg-baqh" colspan="3">
                                        {!!$data->table_main_heading!!}
                                        <b
                                        style="background-color: #ff00008a;color: white;padding-left: 10px;padding-right: 10px;padding-top:5px;padding-bottom:5px;margin-top:10px">*Unlock
                                        Special Offer Price Right Now*</b></th>
                            </tr>
                            <tr>
                                <td class="tg-baqh" colspan="1"><b>Unit</b></td>
                                <td class="tg-baqh" colspan="1"><b>Type</b></td>
                                <td class="tg-baqh" colspan="1"><b>Area &amp; Price</b></td>
                            </tr>
                            @foreach ($data->CampaignTable as $item)
                            <tr>
                                <td class="tg-0lax"><b>{{$item->unit}}</b></td>
                                <td class="tg-0lax"><b>{{$item->type}}</b></td>
                                <td class="tg-0lay locked" style="display:table-cell;">
                                    @if($item->is_available)
                                        <button
                                        class="unlockbuttonstyler"
                                        style="background-color: black !important; background-image: linear-gradient(315deg,#000000 0%,#191919 74%); color: white;font-weight:bold;"
                                        type="button"
                                        aria-label="Unlock Price"
                                        data-bs-toggle="modal" data-bs-target="#contactModal">🔒 Unlock Price</button>
                                    @else
                                        <button class="btn btn-danger" aria-label="Sold Out" disabled>Sold Out</button>
                                    @endif
                                </td>
                                <td class="tg-0lay unlocked" style="display:none;">3891 Sqft<br>3.88 Cr*</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
