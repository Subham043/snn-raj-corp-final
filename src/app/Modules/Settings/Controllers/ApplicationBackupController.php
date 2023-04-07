<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ApplicationBackupController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:create roles', ['only' => ['get','post']]);
    }

    public function get(){
        //todo: run it using queue, dont run it on main web thread!!
        try {
            Artisan::call('backup:run');
            $output = Artisan::output();
            Log::info("Backpack\BackupManager -- new backup started \r\n" . $output);
            return redirect()->back()->with('success_status', 'Successfully created backup!');
        } catch (Exception $e) {
             return redirect()->back()->with('error_status', $e->getMessage());
        }
    }

    public function post(){}
}
