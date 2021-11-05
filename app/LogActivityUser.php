<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivityUser extends Model
{
    //
    protected $fillable = [
        'subject','url','method','ip','agent','user_id','aksi'
    ];
}
