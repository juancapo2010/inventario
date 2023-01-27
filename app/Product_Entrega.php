<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Product_Entrega extends Model implements Auditable
{
    //auditoria
    use \OwenIt\Auditing\Auditable;

    protected $table = 'entrega';

    protected $fillable = ['product_id','asignable_id','qty','tanggal','tecnico'];

    protected $hidden = ['created_at','updated_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
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
