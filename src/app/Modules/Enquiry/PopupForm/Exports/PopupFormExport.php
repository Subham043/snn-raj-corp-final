<?php

namespace App\Modules\Enquiry\PopupForm\Exports;

use App\Modules\Enquiry\PopupForm\Models\PopupForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PopupFormExport implements FromCollection,WithHeadings,WithMapping
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
            'project',
            'IP address',
            'subject',
            'message',
            'page url',
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
            $data->project,
            $data->ip_address,
            $data->subject,
            $data->message,
            $data->page_url,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return PopupForm::where('is_verified', true)->get();
    }
}
