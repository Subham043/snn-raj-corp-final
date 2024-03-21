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

    public function empanelment_form_create(string $name, string $email, string $phone, string $address):string|bool
    {
        $data = array (
            'company_name' => $name,
            'email' => $email,
            'contact_num' => $phone,
            'address' => $address,
        );
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://cloud.paramantra.com/paramantra/api/channel_partner/createChannelPartner/format/json");
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
            $resp = json_decode($data_resp);
            if($resp->response){
                return $resp->response->message;
            }
            return "Record already exists.";
        }
    }

    public function channel_partner_form_create(string $name, string $email, string $phone, string $project, string $notes, string $channel_partner_phone):string|bool
    {
        $data = array (
            'f_name' => $name,
            'email' => $email,
            'phonefax' => $phone,
            'projectname' => $project,
            'notes' => $notes,
            'channel_partner' => $channel_partner_phone,
        );
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://cloud.paramantra.com/paramantra/api/channel_partner/gneLead/format/json");
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
            $resp = json_decode($data_resp);
            if($resp->response){
                return $resp->response->message;
            }
            return "Record already exists.";
        }
    }

    public function free_ad_form_create(string $name, string $email, string $phone, string $source, string $campaign, string $project): bool|string
    {
        $data = $this->input;
        $data['f_name'] = $name;
        $data['l_name'] = '';
        $data['email'] = $email;
        $data['phonefax'] = $phone;
        $data['channel_id'] = 'Walk-In';
        $data['subject'] = 'Lead from Walk-In';
        $data['project'] = $project;
        $data['alert_client'] = 0;
        $data['alert_rep'] = 0;
        $data['USOURCE']= $source;
        $data['utm_campaign'] = $campaign;
        $data['utm_ad_name'] ='Free Ad Form';
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
            $resp = json_decode($data_resp)[0];
            if($resp->message == 'contact_number_added'){
                return "Record created successfully.";
            }
            return "Record already exists.";
        }
    }

    public function campaign_form_create(string $name, string $email, string $phone, string $source, string $project, string $executive_name): bool|string
    {
        $data = $this->input;
        $data['f_name'] = $name;
        $data['l_name'] = '';
        $data['email'] = $email;
        $data['phonefax'] = $phone;
        $data['channel_id'] = 'Walk-In';
        $data['subject'] = 'Lead from Site-Enquiry-Form';
        $data['project'] = $project;
        $data['alert_client'] = 0;
        $data['alert_rep'] = 0;
        $data['rep_id']= $executive_name;
        $data['USOURCE']= $source;
        $data['utm_ad_name'] ='Site Enquiry Form';
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
            $resp = json_decode($data_resp)[0];
            if($resp->message == 'contact_number_added'){
                return "Record created successfully.";
            }
            return "Record already exists.";
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