<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class SelldoService
{

    public function create(string $name, string $email, string $phone): bool
    {
        try {
            Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function verify(string $phone): bool
    {
        try {
            $response = Http::get('https://app.sell.do/api/leads/phone/retrieve_lead?api_key=26c5b0ac69821ba28d6293355d641ec9&value='.$phone);
            $data = json_decode($response->body());
            if($data->exists){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
