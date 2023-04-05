<?php

namespace App\Modules\Authentication\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Authentication\Services\AuthService;

class LogoutController extends Controller
{

    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function get()
    {
        $this->authService->logout();
        return redirect(route('login.get'));
    }
}
