<?php

namespace App\Modules\Main\ProjectPage;

use App\Http\Controllers\Controller;

class ProjectPageController extends Controller
{

    public function get(){
        return view('main.pages.project.index');
    }

}
