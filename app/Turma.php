<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome','vagas'];
    protected $primaryKey = 'id';
    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Municipio');
    }
}
