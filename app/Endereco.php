<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'user_id';
    protected $fillable = ['municipio_id','cep','logradouro','bairro','num','complemento'];
    
    public function user()
    {
        return $this::belongsTo('App\User');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
}
