<?php

namespace App\Modules\Enquiry\LandOwnerForm\Exports;

use App\Modules\Enquiry\LandOwnerForm\Models\LandOwnerForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LandOwnerFormExport implements FromCollection,WithHeadings,WithMapping
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
            'subject',
            'property location',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->name,
            $data->email,
            $data->country_code.$data->phone,
            $data->ip_address,
            $data->subject,
            $data->property_location,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return LandOwnerForm::all();
    }
}
