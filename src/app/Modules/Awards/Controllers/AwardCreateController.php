<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Requests\AwardCreateRequest;
use App\Modules\Awards\Services\AwardService;

class AwardCreateController extends Controller
{
    private $awardService;

    public function __construct(AwardService $awardService)
    {
        $this->middleware('permission:create awards', ['only' => ['get','post']]);
        $this->awardService = $awardService;
    }

    public function get(){
        return view('admin.pages.award.create');
    }

    public function post(AwardCreateRequest $request){

        try {
            //code...
            $award = $this->awardService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->awardService->saveImage($award);
            }
            return response()->json(["message" => "Award created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
