<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;

class ProfileExport implements FromCollection,WithHeadings
{
    protected $registration_id;

 function __construct($registration_id) {
        $this->registration_id = $registration_id;
 }
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
        // dd($this->registration_id);
        return DB::table('registration_details')->where('registration_id',$this->registration_id)->get();
    }
}
