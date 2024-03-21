<?php

namespace App\Modules\Enquiry\ChannelPartnerForm\Exports;

use App\Modules\Enquiry\ChannelPartnerForm\Models\ChannelPartnerForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChannelPartnerFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',
            'email',
            'phone',
            'IP address',
            'project',
            'notes',
            'channel partner phone',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->email,
            $data->phone,
            $data->ip_address,
            $data->project,
            $data->notes,
            $data->channel_partner_phone,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ChannelPartnerForm::all();
    }
}