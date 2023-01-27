<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Category extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;


    protected $fillable = ['name'];

    protected $hidden = ['created_at','updated_at'];
}
