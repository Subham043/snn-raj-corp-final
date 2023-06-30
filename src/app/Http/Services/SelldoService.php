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

    public function get(string $phone): bool
    {
        try {
            Http::asForm()
            ->post('https://app.sell.do/api/leads/phone/retrieve_lead?api_key=cb59ce73bf598b600fc107d640d03376&value='.$phone);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
