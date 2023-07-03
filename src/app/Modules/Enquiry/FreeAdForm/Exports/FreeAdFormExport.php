<?php

namespace App\Modules\Enquiry\FreeAdForm\Exports;

use App\Modules\Enquiry\FreeAdForm\Models\FreeAdForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FreeAdFormExport implements FromCollection,WithHeadings,WithMapping
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
            'source',
            'executive',
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
            $data->source,
            $data->executive_name,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return FreeAdForm::all();
    }
}
