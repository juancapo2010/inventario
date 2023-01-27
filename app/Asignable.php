<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


// --asignables--
class Asignable extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;


    protected $fillable = ['nama','email','alamat','telepon'];

    protected $hidden = ['created_at','updated_at'];
}
