<?php

namespace App\Modules\Main\AwardPage;

use App\Http\Controllers\Controller;

class AwardPageController extends Controller
{

    public function get(){
        return view('main.pages.award');
    }

}
