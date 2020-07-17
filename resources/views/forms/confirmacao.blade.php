<form class="formmultstep" id="formconfirmacao">
<div class="card">
    <div class="card-header">
      Inscrição Realizada em {{date_format(date_create($user->inscricao->created_at), "d/m/Y à\s h:m:s")}}
    </div>
    <div class="card-body">
        <p class="card-text">Nome : {{$user->documento->nome}}</p>
        <p class="card-text">Sexo : {{$user->documento->sexo =='M'?'Masculino':'Feminino'}}</p>
        <p class="card-text">CPF : {{preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $user->documento->cpf)}}</p>
        <p class="card-text">Nome da Mãe : {{$user->documento->nome_mae}}</p>
        <p class="card-text">Nome do Pai : {{$user->documento->nome_mae}}</p>
        <p class="card-text">Data de Nascimento : {{date_format(date_create($user->documento->data_nascimento), "d/m/Y")}}</p>
        <p class="card-text">Estado Civil : {{$user->documento->estado_civil}}</p>
        <p class="card-text">Tipo de Documento : {{$user->documento->tipo_documento}}</p>
        <p class="card-text">Nº Documento : {{$user->documento->num_documento}}</p>
        <p class="card-text">Emissão do Documento : {{date_format(date_create($user->documento->data_emissao_documento),"d/m/Y")}}</p>
        <p class="card-text">Orgão Emissor : {{$user->documento->orgao_emissor_documento}} </p>
        <p class="card-text">UF : {{$user->documento->estado->uf}} </p>
        <p class="card-text">Naturalidade : {{$user->documento->nascimento->nome}} </p>
        <p class="card-text">Nº do Título de Eleitor : {{$user->documento->titulo_num}} </p>
        <p class="card-text">Data de emissão do Título : {{date_format(date_create($user->documento->titulo_emissao),"d/m/Y")}} </p>
        <p class="card-text">Titulo Município : {{$user->documento->tituloMunicipio->nome}} </p>
        <hr>
        <p class="card-text">Município : {{$user->endereco->municipio->nome}} </p>
        <p class="card-text">CEP : {{preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $user->endereco->cep)}} </p>
        <p class="card-text">Logradouro : {{$user->endereco->logradouro}} </p>
        <p class="card-text">Bairro : {{$user->endereco->bairro}} </p>
        <p class="card-text">Número : {{$user->endereco->num}} </p>
        <p class="card-text">Complemento : {{$user->endereco->complemento}} </p>
        <p class="card-text">Celular : {{$user->endereco->celular}} </p>
        <p class="card-text">Telefone fixo : {{$user->endereco->telefone_fixo}} </p>
        <hr>
        <p class="card-text">Turma : {{$user->inscricao->turma->municipio->nome}} </p>
        <p class="card-text">Cota : {{$user->inscricao->cota->nome}} </p>
        <p class="card-text">Curso : {{$user->inscricao->curso->nome}} </p>
        <p class="card-text">Tempo de serviço : {{$user->inscricao->tempo_servico_dias}} dias </p>

    </div>
  </div>
  <div class="row">
    <div class="ml-auto">
      <input type="button" name="Imprimir" class="btn btn-primary" value="Imprimir" />
    </div>
  </div>

</form>