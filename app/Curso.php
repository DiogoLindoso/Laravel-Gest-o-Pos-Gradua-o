<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = ['nome'];
    public function turmas()
    {
        return $this->belongsToMany('App\Municipio','turmas','curso_id','municipio_id')->withPivot('id','nome','vagas');;
    }
    public function cotas()
    {
        return $this->belongsToMany('App\Cota', 'cotas_cursos', 'curso_id', 'cota_id');
    }
}
