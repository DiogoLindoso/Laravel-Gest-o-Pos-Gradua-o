<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id';
    protected $fillable = ['nome'];

    public function estados()
    {
        return $this->hasMany('App\Estado')->orderBy('nome');
    }
}
