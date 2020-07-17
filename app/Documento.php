<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'nome',
        'sexo',
        'cpf',
        'nome_mae',
        'nome_pai',
        'data_nascimento',
        'estado_civil',
        'tipo_documento',
        'num_documento',
        'data_emissao_documento',
        'orgao_emissor_documento',
        'uf_documento',
        'nascimento_municipio',
        'titulo_num',
        'titulo_emissao',
        'titulo_municipio'
    ];

    public function user()
    {
        return $this::belongsTo('App\User');
    }
    public function nascimento()
    {
        return $this::belongsTo('App\Municipio','nascimento_municipio','id');
    }
    public function tituloMunicipio()
    {
        return $this::belongsTo('App\Municipio', 'titulo_municipio', 'id');
    }
    public function estado()
    {
        return $this::belongsTo('App\Estado', 'uf_documento', 'id');
    }
}
