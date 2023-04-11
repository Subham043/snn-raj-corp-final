<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardService;

class AwardDeleteController extends Controller
{
    private $awardService;

    public function __construct(AwardService $awardService)
    {
        $this->middleware('permission:delete awards', ['only' => ['get']]);
        $this->awardService = $awardService;
    }

    public function get($id){
        $award = $this->awardService->getById($id);

        try {
            //code...
            $this->awardService->delete(
                $award
            );
            return redirect()->back()->with('success_status', 'Award deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
