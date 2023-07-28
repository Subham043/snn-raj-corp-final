<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class SelldoService
{

    public function create(string $name, string $email, string $phone): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]=website&sell_do[campaign][srd]=64a7bb690ad1ff10693d9e04&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
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

    public function free_ad_create(string $name, string $email, string $phone, string $source, string $project): bool
    {
        try {
            switch ($project) {
                case 'Raj High Gardens':
                    # code...
                    $project_id = '63932f2ca6bbc90b878a7f02';
                    break;

                case 'Raj Bay Vista':
                    # code...
                    $project_id = '63aa8dddc8256132cbd821dd';
                    break;

                case 'Raj Viviente':
                    # code...
                    $project_id = '63a1523ced23e9658b4a2293';
                    break;

                default:
                    # code...
                    $project_id = '';
                    break;
            }
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]='.$source.'&sell_do[campaign][srd]=64a7bd5c0ad1ff18a297393b&sell_do[form][lead][project_id]='.$project_id.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function campaign_create(string $name, string $email, string $phone, string $source, string $project, string $executive_name): bool
    {
        try {
            switch ($project) {
                case 'Raj High Gardens':
                    # code...
                    $project_id = '63932f2ca6bbc90b878a7f02';
                    break;

                case 'Raj Bay Vista':
                    # code...
                    $project_id = '63aa8dddc8256132cbd821dd';
                    break;

                case 'Raj Viviente':
                    # code...
                    $project_id = '63a1523ced23e9658b4a2293';
                    break;

                default:
                    # code...
                    $project_id = '';
                    break;
            }
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]='.$source.'&sell_do[campaign][srd]=64a7c07b0ad1ff19f1e846f4&sell_do[form][lead][project_id]='.$project_id.'&sell_do[form][lead][sales]='.$executive_name.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function project_create(string $name, string $email, string $phone, string $srd): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]=website&sell_do[campaign][srd]='.$srd.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function popup_create(string $name, string $email, string $phone, string $srd, string $project_id): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]=website&sell_do[campaign][srd]='.$srd.'&sell_do[form][lead][project_id]='.$project_id.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function project_campaign_create(string $name, string $email, string $phone, string $srd, string $project_id): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]=website&sell_do[campaign][srd]='.$srd.'&sell_do[form][lead][project_id]='.$project_id.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function project_campaign_bare_create(string $name, string $email, string $phone, string $srd): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]=website&sell_do[campaign][srd]='.$srd.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

}
