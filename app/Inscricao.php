<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'cota_id',
        'curso_id',
        'turma_id',
        'tempo_servico_dias',
        'compravante_tempo_servico'
    ];
    
    public function cota()
    {
        return $this->belongsTo('App\Cota', 'cota_id');
    }
    public function curso()
    {
        return $this->belongsTo('App\Curso');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function turma()
    {
        return $this->belongsTo('App\Turma');
    }
}
