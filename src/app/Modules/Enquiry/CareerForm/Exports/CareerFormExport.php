<?php

namespace App\Modules\Enquiry\CareerForm\Exports;

use App\Modules\Enquiry\CareerForm\Models\CareerForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CareerFormExport implements FromCollection,WithHeadings,WithMapping
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
            'experience',
            'description',
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
            $data->experience,
            $data->description,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return CareerForm::all();
    }
}
