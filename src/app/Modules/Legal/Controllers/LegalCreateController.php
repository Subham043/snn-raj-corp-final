<?php

namespace App\Modules\Legal\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Requests\LegalCreateRequest;
use App\Modules\Legal\Services\LegalService;

class LegalCreateController extends Controller
{
    private $legalService;

    public function __construct(LegalService $legalService)
    {
        $this->middleware('permission:create legal pages', ['only' => ['get','post']]);
        $this->legalService = $legalService;
    }

    public function get(){
        return view('admin.pages.legal.create');
    }

    public function post(LegalCreateRequest $request){

        try {
            //code...
            $this->legalService->create(
                $request->except('image')
            );
            return response()->json(["message" => "Legal Pages created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
