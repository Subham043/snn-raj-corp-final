<?php

namespace App\Modules\Settings\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Requests\ThemeRequest;
use App\Modules\Settings\Services\ThemeService;

class ThemeController extends Controller
{
    private $themeService;

    public function __construct(ThemeService $themeService)
    {
        $this->middleware('permission:view theme settings detail', ['only' => ['get','post']]);
        $this->themeService = $themeService;
    }

    public function get(){
        $data = $this->themeService->getById(1);
        return view('admin.pages.setting.theme.index', compact('data'));
    }

    public function post(ThemeRequest $request){
        try {
            //code...
            $this->themeService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Theme settings updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
