<?php

namespace App\Modules\Csr\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Requests\CsrUpdateRequest;
use App\Modules\Csr\Services\CsrService;

class CsrUpdateController extends Controller
{
    private $csrService;

    public function __construct(CsrService $csrService)
    {
        $this->middleware('permission:edit csr content', ['only' => ['get','post']]);
        $this->csrService = $csrService;
    }

    public function get($id){
        $data = $this->csrService->getById($id);
        return view('admin.pages.csr.update', compact('data'));
    }

    public function post(CsrUpdateRequest $request, $id){
        $csr = $this->csrService->getById($id);
        try {
            //code...
            $this->csrService->update(
                $request->except('image'),
                $csr
            );
            if($request->hasFile('image')){
                $this->csrService->saveImage($csr);
            }
            return response()->json(["message" => "Csr updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
