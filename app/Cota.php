<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cota extends Model
{
    protected $table = 'cotas';
    protected $primaryKey = 'id';
    protected $fillable = ['nome','prioridade','descricao'];

    public function cursos()
    {
        return $this->belongsToMany('App\Curso', 'cotas_cursos', 'cota_id', 'curso_id');
    }
    
}
