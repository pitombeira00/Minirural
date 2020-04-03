<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class planos extends Model
{
    protected $table = "plano";
    protected $primaryKey = 'id';

    public function lancamentos(){
        return $this->hasOne(lancamentos::class);
    }
}
