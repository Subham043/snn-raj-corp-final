<?php

namespace App\Modules\Main\AboutPage;

use App\Http\Controllers\Controller;

class AboutPageController extends Controller
{

    public function get(){
        return view('main.pages.about');
    }

}
