<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConnectionMasterModel extends Model
{
    protected $table = 'connection_master';
    protected $primaryKey = 'connection_id';
    public $timestamps = false;

}
