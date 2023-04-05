<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Modules\Authentication\Requests\ForgotPasswordPostRequest;
use App\Modules\Authentication\Services\UserService;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{

    public function __construct(protected UserService $userService)
    {}

    public function get(){
        return view('admin.pages.auth.forgotpassword');
    }

    public function post(ForgotPasswordPostRequest $request){

        try {
            //code...

            $user = $this->userService->getByEmail($request->email);
            $encryptId = (new DecryptService)->encryptId($user->id);
            $url = URL::temporarySignedRoute('reset_password.get', now()->addMinutes(60), ['token' => $encryptId]);
            return redirect($url)->with('success_status', 'Kindly check your mail, we have sent you a link where you can reset your password which is valid for next 1 hour!.');
            return redirect(route('forgot_password.get'))->with('success_status', 'Kindly check your mail, we have sent you a link where you can reset your password which is valid for next 1 hour!.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('forgot_password.get'))->with('error_status', 'Oops! You have entered invalid credentials');
        }

    }
}
