<?php

namespace App\Modules\Main\BlogPage;

use App\Http\Controllers\Controller;

class BlogPageController extends Controller
{

    public function get(){
        return view('main.pages.blog.index');
    }

}
