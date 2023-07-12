<?php

namespace App\Modules\Enquiry\ProjectCampaignForm\Exports;

use App\Modules\Enquiry\ProjectCampaignForm\Models\ProjectCampaignForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProjectCampaignFormExport implements FromCollection,WithHeadings,WithMapping
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
            'is verified',
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
            $data->is_verified,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ProjectCampaignForm::all();
    }
}
