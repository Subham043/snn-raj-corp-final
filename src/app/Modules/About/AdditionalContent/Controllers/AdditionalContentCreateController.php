<?php

namespace App\Modules\About\AdditionalContent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Requests\AdditionalContentCreateRequest;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;

class AdditionalContentCreateController extends Controller
{
    private $additionalContentService;

    public function __construct(AdditionalContentService $additionalContentService)
    {
        $this->middleware('permission:create about additional content', ['only' => ['get','post']]);
        $this->additionalContentService = $additionalContentService;
    }

    public function get(){
        return view('admin.pages.about.additional_content.create');
    }

    public function post(AdditionalContentCreateRequest $request){

        try {
            //code...
            $additional_content = $this->additionalContentService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->additionalContentService->saveImage($additional_content);
            }
            return response()->json(["message" => "Additional Content created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
