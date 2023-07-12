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
            'page url',
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
            $data->page_url,
            $data->ip_address,
            $data->is_verified ? 'Yes' : 'No',
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ProjectCampaignForm::all();
    }
}
