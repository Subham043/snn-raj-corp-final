<?php

namespace App\Modules\Legal\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Requests\LegalUpdateRequest;
use App\Modules\Legal\Services\LegalService;

class LegalUpdateController extends Controller
{
    private $legalService;

    public function __construct(LegalService $legalService)
    {
        $this->middleware('permission:edit legal pages', ['only' => ['get','post']]);
        $this->legalService = $legalService;
    }

    public function get($id){
        $data = $this->legalService->getById($id);
        return view('admin.pages.legal.update', compact('data'));
    }

    public function post(LegalUpdateRequest $request, $id){
        $legal = $this->legalService->getById($id);
        try {
            //code...
            $this->legalService->update(
                $request->except('image'),
                $legal
            );
            return response()->json(["message" => "Legal Pages updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
