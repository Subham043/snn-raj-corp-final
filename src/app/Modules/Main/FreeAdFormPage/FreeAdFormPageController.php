<?php

namespace App\Modules\Main\FreeAdFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\FreeAdForm\Exports\FreeAdFormExport;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormLoginRequest;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormRequest;
use App\Modules\Enquiry\FreeAdForm\Services\FreeAdFormService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\SiteEnquiryRepresentative\Services\SiteEnquiryRepresentativeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FreeAdFormPageController extends Controller
{
    private $freeAdFormService;
    private $projectService;

    public function __construct(
        FreeAdFormService $freeAdFormService,
        ProjectService $projectService,
    )
    {
        $this->freeAdFormService = $freeAdFormService;
        $this->projectService = $projectService;
    }

    public function get(){
        $projects = $this->projectService->main_listing();
        $executives = (new SiteEnquiryRepresentativeService)->all();
        return view('main.pages.free_ad_form', compact(['projects', 'executives']));
    }

    public function post(FreeAdFormRequest $request){
        $project = $this->projectService->getById($request->project);
        $executive = (new SiteEnquiryRepresentativeService)->getById($request->executive_name);
        try {
            //code...
            $this->freeAdFormService->create(
                [
                    ...$request->except(['project', 'executive_name']),
                    'ip_address' => $request->ip(),
                    'project' => $project->name,
                    'executive_name' => $executive->name,
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            $response = (new ParamantraService)->campaign_form_create($request->name, $request->email, $request->phone, $request->source, $project->name, $executive->paramantra_code);
            return response()->json(["message" => $response], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

    public function login(){
        return view('main.pages.site_enquiry.login');
    }

    public function loginPost(FreeAdFormLoginRequest $request){
        if (Auth::guard('site_enquiry')->attempt($request->validated())) {
            (new RateLimitService($request))->clearRateLimit();
            return redirect(route('free_ad_form.data'))->with('success_status', 'Logged in successfully.');
        }

        return redirect(route('free_ad_form.login'))->with('error_status', 'Oops! You have entered invalid credentials');
    }

    public function data(Request $request){
        $data = $this->freeAdFormService->paginate($request->total ?? 10);
        return view('main.pages.site_enquiry.data', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

    public function excel(){
        return Excel::download(new FreeAdFormExport, 'site_enquiry_form.xlsx');
    }

    public function logout(){
        Auth::guard('site_enquiry')->logout();
        return redirect()->route('free_ad_form.login');
    }

}
