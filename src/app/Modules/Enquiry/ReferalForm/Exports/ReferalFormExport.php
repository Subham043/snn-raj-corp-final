<?php

namespace App\Modules\Enquiry\ReferalForm\Exports;

use App\Modules\Enquiry\ReferalForm\Models\ReferalForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReferalFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'member name',
            'member email',
            'member phone',
            'member unit',
            'member project',
            'referal name',
            'referal email',
            'referal phone',
            'referal relation',
            'referal project',
            'created_at',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->member_name,
            $data->member_email,
            $data->member_phone,
            $data->member_unit,
            $data->member_project->name,
            $data->referal_name,
            $data->referal_email,
            $data->referal_phone,
            $data->referal_relation,
            $data->referal_project->name,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ReferalForm::with(['member_project', 'referal_project'])->get();
    }
}
