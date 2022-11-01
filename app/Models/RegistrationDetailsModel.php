<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationDetailsModel extends Model
{
    protected $table = 'registration_details';
    protected $primaryKey = 'registration_id';
    public $timestamps = false;


}

