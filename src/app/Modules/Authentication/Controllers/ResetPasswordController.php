<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Modules\Authentication\Requests\ResetPasswordPostRequest;
use App\Modules\Authentication\Services\UserService;
use Illuminate\Support\Facades\URL;

class ResetPasswordController extends Controller
{
    public function __construct(protected UserService $userService)
    {}

    public function get($token){
        try {
            //code...
            (new DecryptService)->decryptId($token);
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }
        return view('admin.pages.auth.reset_password');
    }

    public function post(ResetPasswordPostRequest $request, $token){
        //code...

        try {
            //code...
            $id = (new DecryptService)->decryptId($token);
        } catch (\Throwable $th) {
            //throw $th;
            abort(404);
        }

        try {
            //code...
            $user = $this->userService->getById($id);
            $this->userService->update($request->only('password'), $user);
            return redirect(route('login.get'))->with('success_status', 'Password Reset Successful.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error_status', 'Oops! Something went wrong please try again');
        }


    }
}
