<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product_Devolucion extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;


    protected $table = 'devolucion';

    protected $fillable = ['product_id','estado_id','qty','tanggal'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function asignable()
    {
        return $this->belongsTo(Asignable::class);
    }

    public function activo()
    {
        return $this->belongsTo(Activo::class);
    }
}
