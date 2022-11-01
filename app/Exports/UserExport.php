<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class UserExport implements FromCollection,WithHeadings 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'registration_id',
            'applicant_name',
            'email_id',
            'mobile_number',
            'gender',
            'age'
        ];
    } 
    public function collection()
    {
        //
        return DB::table('registration_details')->get();
    }
}
