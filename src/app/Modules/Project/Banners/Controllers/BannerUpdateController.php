<?php

namespace App\Modules\Project\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Banners\Requests\BannerUpdateRequest;
use App\Modules\Project\Banners\Services\BannerService;
use App\Modules\Project\Projects\Services\ProjectService;

class BannerUpdateController extends Controller
{
    private $bannerService;
    private $projectService;

    public function __construct(BannerService $bannerService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->bannerService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.banner.update', compact('data', 'project_id'));
    }

    public function post(BannerUpdateRequest $request, $project_id, $id){
        $this->projectService->getById($project_id);
        $banner = $this->bannerService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->bannerService->update(
                $request->except('image'),
                $banner
            );
            if($request->hasFile('image')){
                $this->bannerService->saveImage($banner);
            }
            return response()->json(["message" => "Banner updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
