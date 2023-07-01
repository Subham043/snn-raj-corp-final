<?php

namespace App\Modules\Main\FreeAdFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormRequest;
use App\Modules\Enquiry\FreeAdForm\Services\FreeAdFormService;

class FreeAdFormPageController extends Controller
{
    private $freeAdFormService;

    public function __construct(
        FreeAdFormService $freeAdFormService,
    )
    {
        $this->freeAdFormService = $freeAdFormService;
    }

    public function get(){
        return view('main.pages.free_ad_form');
    }

    public function post(FreeAdFormRequest $request){

        try {
            //code...
            $this->freeAdFormService->create(
                [
                    ...$request->validated(),
                    'ip_address' => $request->ip(),
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            (new SelldoService)->create($request->name, $request->email, $request->phone);
            return response()->json(["message" => "Free Ad Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
