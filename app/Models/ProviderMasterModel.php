<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderMasterModel extends Model
{
    protected $table = 'provider_master';
    protected $primaryKey = 'provider_int';
    public $timestamps = false;
}
