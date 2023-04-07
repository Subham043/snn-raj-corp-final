<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Configurations\EmailSettings;
use App\Modules\Settings\Requests\EmailSettingRequest;

class EmailSettingController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:create roles', ['only' => ['get','post']]);
    }

    public function get(EmailSettings $settings){
        return view('admin.pages.setting.email')->with([
            'mailer' => $settings->mailer,
            'host' => $settings->host,
            'port' => $settings->port,
            'username' => $settings->username,
            'encryption' => $settings->encryption,
            'from_address' => $settings->from_address,
            'from_name' => $settings->from_name,
        ]);
    }

    public function post(EmailSettings $settings, EmailSettingRequest $request){

        $settings->mailer = $request->mailer;
        $settings->host = $request->host;
        $settings->port = $request->port;
        $settings->username = $request->username;
        $settings->encryption = $request->encryption;
        $settings->from_address = $request->from_address;
        $settings->from_name = $request->from_name;
        if($request->password){
            $settings->password = $request->password;
        }

        $settings->save();

        return redirect()->back()->with('success_status', 'Saved successfully.');

    }
}
