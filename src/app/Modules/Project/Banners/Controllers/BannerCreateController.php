<?php

namespace App\Modules\Project\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Banners\Requests\BannerCreateRequest;
use App\Modules\Project\Banners\Services\BannerService;
use App\Modules\Project\Projects\Services\ProjectService;

class BannerCreateController extends Controller
{
    private $bannerService;
    private $projectService;

    public function __construct(BannerService $bannerService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.banner.create', compact(['project_id']));
    }

    public function post(BannerCreateRequest $request, $project_id){

        $this->projectService->getById($project_id);
        try {
            //code...
            $banner = $this->bannerService->create(
                $request->except('image'),
                $project_id
            );
            if($request->hasFile('image')){
                $this->bannerService->saveImage($banner);
            }
            return response()->json(["message" => "Banner created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
