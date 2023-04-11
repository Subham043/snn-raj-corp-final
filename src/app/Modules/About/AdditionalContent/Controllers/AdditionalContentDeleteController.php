<?php

namespace App\Modules\About\AdditionalContent\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;

class AdditionalContentDeleteController extends Controller
{
    private $additionalContentService;

    public function __construct(AdditionalContentService $additionalContentService)
    {
        $this->middleware('permission:delete about additional content', ['only' => ['get']]);
        $this->additionalContentService = $additionalContentService;
    }

    public function get($id){
        $additional_content = $this->additionalContentService->getById($id);

        try {
            //code...
            $this->additionalContentService->delete(
                $additional_content
            );
            return redirect()->back()->with('success_status', 'Additional Content deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
