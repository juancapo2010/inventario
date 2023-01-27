<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peoplesoft extends Model
{
    protected $fillable = ['neme','lastname','username','email','password','is_active','is_admin'];

    protected $hidden = ['created_at','updated_at'];
}
