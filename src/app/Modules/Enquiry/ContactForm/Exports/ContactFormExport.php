<?php

namespace App\Modules\Enquiry\ContactForm\Exports;

use App\Modules\Enquiry\ContactForm\Models\ContactForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContactFormExport implements FromCollection,WithHeadings,WithMapping
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
            $data->phone,
            $data->subject,
            $data->message,
            $data->page_url,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return ContactForm::all();
    }
}
