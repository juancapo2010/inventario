<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;


    protected $fillable = ['category_id','activo_id','estado_id','image','qty','asignable_id','sn','descripcion'];

    protected $hidden = ['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function asignable()
    {
        return $this->belongsTo(Asignable::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }

}
