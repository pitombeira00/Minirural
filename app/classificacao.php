<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classificacao extends Model
{
    protected $table = "classificacao";
    protected $primaryKey = 'id';

    public function lancamentos(){
        return $this->hasOne(lancamentos::class);
    
    }
}
