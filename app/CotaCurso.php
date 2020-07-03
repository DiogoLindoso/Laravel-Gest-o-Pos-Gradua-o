<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotaCurso extends Model
{
    protected $table = 'cotas_cursos';
    protected $primaryKey = ['cota_id', 'curso_id'];
    protected $fillable = ['cota_id','curso_id'];
    
}
