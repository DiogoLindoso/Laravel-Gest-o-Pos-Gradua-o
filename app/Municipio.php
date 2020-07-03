<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipios';
    protected $primaryKey = 'id';
    protected $fillable = ['estado_id','nome'];
    
    public function estado()
    {
        return $this->belongsTo('App\Estado');
    }
    public function turmas()
    {
        return $this->belongsToMany('App\Curso','turmas','municipio_id','curso_id')->withPivot('id','nome','vagas');
    }
}
