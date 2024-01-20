<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ParamantraService
{
    private $input = array (
        'rep_id' => 'anuj@snnrajcorp.com',
        'channel_id' => 'Website_Contact_Us',
        'subject' => 'Lead from Website_Contact_Us',
        'f_name' => '',
        'l_name' => '',
        'email' => '',
        'phonefax' => '',
        'notes' => '',
        'project' => '',
        'alert_client' => 0,
        'alert_rep' => 0
    );

    private $url = 'https://cloud.paramantra.com/paramantra/api/data/new/format/json';
    private $api_key='16wDpCrI2FCutopxHIyK6rNz5p';
    private $app_name='HIrJA';

    public function contact_create(string $name, string $email, string $phone, string $subject): bool
    {
        $data = $this->input;
        $data['f_name'] = $name;
        $data['l_name'] = '';
        $data['email'] = $email;
        $data['phonefax'] = $phone;
        $data['subject'] = $subject;
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: $this->api_key ","ACTION-ON: $this->app_name"));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            curl_setopt($ch, CURLOPT_USERPWD, $this->api_key );
            $data_resp = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }

    public function campaign_form_verify(string $phone): bool
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

    public function free_ad_form_create(string $name, string $email, string $phone, string $source, string $projectId): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]='.$source.'&sell_do[campaign][srd]=64a7bd5c0ad1ff18a297393b&sell_do[form][lead][project_id]='.$projectId.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function campaign_form_create(string $name, string $email, string $phone, string $source, string $projectId, string $executive_name): bool
    {
        try {
            $response = Http::asForm()->post('https://app.sell.do/api/leads/create?sell_do[form][lead][name]='.$name.'&sell_do[form][lead][email]='.$email.'&sell_do[form][lead][phone]='.$phone.'&sell_do[form][lead][source]='.$source.'&sell_do[campaign][srd]=64a7c07b0ad1ff19f1e846f4&sell_do[form][lead][project_id]='.$projectId.'&sell_do[form][lead][sales]='.$executive_name.'&api_key=26c5b0ac69821ba28d6293355d641ec9');
            $data = json_decode($response->body());
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function popup_form_create(string $name, string $email, string $phone, string $project): bool
    {
        $data = $this->input;
        $data['f_name'] = $name;
        $data['l_name'] = '';
        $data['email'] = $email;
        $data['phonefax'] = $phone;
        $data['subject'] = 'Lead from Popup_Form';
        $data['project'] = $project;
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: $this->api_key ","ACTION-ON: $this->app_name"));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            curl_setopt($ch, CURLOPT_USERPWD, $this->api_key );
            $data_resp = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }

    public function project_campaign_create(string $name, string $email, string $phone, string $project): bool
    {
        $data = $this->input;
        $data['f_name'] = $name;
        $data['l_name'] = '';
        $data['email'] = $email;
        $data['phonefax'] = $phone;
        $data['subject'] = 'Lead from Campaign';
        $data['project'] = $project;
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: $this->api_key ","ACTION-ON: $this->app_name"));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            curl_setopt($ch, CURLOPT_USERPWD, $this->api_key );
            $data_resp = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }

}
