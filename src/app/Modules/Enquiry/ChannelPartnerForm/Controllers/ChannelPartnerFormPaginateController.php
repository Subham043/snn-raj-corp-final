<?php

namespace App\Modules\Enquiry\ChannelPartnerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ChannelPartnerForm\Services\ChannelPartnerFormService;
use Illuminate\Http\Request;

class ChannelPartnerFormPaginateController extends Controller
{
    private $freeAdFormService;

    public function __construct(ChannelPartnerFormService $freeAdFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->freeAdFormService = $freeAdFormService;
    }

    public function get(Request $request){
        $data = $this->freeAdFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.channel_partner_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}