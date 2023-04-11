<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Requests\AwardUpdateRequest;
use App\Modules\Awards\Services\AwardService;

class AwardUpdateController extends Controller
{
    private $awardService;

    public function __construct(AwardService $awardService)
    {
        $this->middleware('permission:edit awards', ['only' => ['get','post']]);
        $this->awardService = $awardService;
    }

    public function get($id){
        $data = $this->awardService->getById($id);
        return view('admin.pages.award.update', compact('data'));
    }

    public function post(AwardUpdateRequest $request, $id){
        $award = $this->awardService->getById($id);
        try {
            //code...
            $this->awardService->update(
                $request->except('image'),
                $award
            );
            if($request->hasFile('image')){
                $this->awardService->saveImage($award);
            }
            return response()->json(["message" => "Award updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
