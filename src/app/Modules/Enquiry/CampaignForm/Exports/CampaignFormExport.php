<?php

namespace App\Modules\Enquiry\CampaignForm\Exports;

use App\Modules\Enquiry\CampaignForm\Models\CampaignForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CampaignFormExport implements FromCollection,WithHeadings,WithMapping
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
            'source',
            'campaign',
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
            $data->source,
            $data->campaign,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return CampaignForm::all();
    }
}
