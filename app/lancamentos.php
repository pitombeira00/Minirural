<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lancamentos extends Model
{
    protected $table = "lancamentos";
    protected $primaryKey = 'id';

    public function plano(){
        return $this->hasOne(planos::class,'id','id_plano');
    }
    public function classificacao(){
        return $this->hasOne(classificacao::class,'id','id_class');
    }
}
