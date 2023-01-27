<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


// --Estado
class Estado extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;



    protected $fillable = ['nama'];

    protected $hidden = ['created_at','updated_at'];
}
