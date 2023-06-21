<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Exports;

use App\Modules\Enquiry\EmpanelmentForm\Models\EmpanelmentForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmpanelmentFormExport implements FromCollection,WithHeadings,WithMapping
{

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Id',
            'Scope of Work',
            'Name of Channel Partner',
            'Phone',
            'Telephone',
            'Email',
            'RERA No.',
            'Contact Person Name',
            'Designation',
            'PAN No.',
            'GSTIN',
            'SAC / HSN Code',
            'Tax Applicable',
            'Bank Name',
            'Bank Address',
            'Bank Branch',
            'Bank Account Number',
            'IFSC Code',
            'Address',
            'MSME Registered',
            'ESI Registered',
            'EPF Registered',
            'Created At',
        ];
    }
    public function map($data): array
    {
         return[
            $data->id,
            $data->scope,
            $data->channel_partner,
            $data->phone,
            $data->telephone,
            $data->email,
            $data->rera,
            $data->contact_person_name,
            $data->designation,
            $data->pan,
            $data->gst,
            $data->sac,
            $data->tax,
            $data->bank_name,
            $data->bank_address,
            $data->bank_branch,
            $data->bank_account_number,
            $data->ifsc,
            $data->address,
            $data->msme,
            $data->esi,
            $data->epf,
            $data->created_at,
         ];
    }
    public function collection()
    {
        return EmpanelmentForm::all();
    }
}
