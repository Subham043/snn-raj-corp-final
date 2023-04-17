<?php

namespace App\Modules\Main\CsrPage;

use App\Http\Controllers\Controller;

class CsrPageController extends Controller
{

    public function get(){
        return view('main.pages.csr');
    }

}
