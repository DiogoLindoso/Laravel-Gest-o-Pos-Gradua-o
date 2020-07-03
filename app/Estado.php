<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','uf','regiao_id'];

    public function pais()
    {
        return $this->belongsTo('App\Pais');
    }
    public function municipios()
    {
        return $this->hasMany('App\Municipio')->orderBy('nome');
    }
}
