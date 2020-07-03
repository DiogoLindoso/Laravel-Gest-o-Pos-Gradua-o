<form class="formmultstep" id="formdocumentos" data-documento="{{$user}}">
    @csrf
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Nome</label>

        <div class="col-md-6">
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Sexo</label>

        <div class="col-md-3">
            <select id="sexo" name="sexo" class="form-control" required>
                <option value=""></option>
                <option value="M">Masculino</option>
                <option value="F">Feminino</option>
            </select>
        </div>
    </div>
    
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">CPF</label>

        <div class="col-md-3">
            <input type="text" id="cpf" name="cpf" class="form-control" data-mask="000.000.000-00" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Data de Nascimento</label>

        <div class="col-md-2 pr-0">
            <input type="date" id="nascimento" name="nascimento" class="form-control" required>
        </div>

        <label class="col-md-2 col-form-label text-md-right">Estado Civil</label>
    
        <div class="col-md-2">
            <select id="estado_civil" name="estado_civil" class="form-control" required>
                <option value=""></option>
                <option value="Solteiro(a)">Solteiro(a)</option>
                <option value="Casado(a)">Casado(a)</option>
                <option value="Divorciado(a)">Divorciado(a)</option>
                <option value="Viuvo(a)">Viuvo(a)</option>
                <option value="União Estável">União Estável</option>
                <option value="Outros">Outros</option>
            </select>
        </div>

    </div> 
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Nome da Mãe</label>

        <div class="col-md-6">
            <input type="text" id="mae" name="mae" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Nome do Pai</label>

        <div class="col-md-6">
            <input type="text" id="pai" name="pai" class="form-control">
        </div>
    </div>

    <hr>                       
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Tipo do Documento</label>
    
        <div class="col-md-2">
            <select id="tipo" name="tipo" class="form-control" required>
                <option value=""></option>
                <option value="Civil" >Civil</option>
                <option value="Militar">Militar</option>
                <option value="Profissional">Profissional</option>
            </select>
        </div>
        <label class="col-md-2 col-form-label text-md-right">Nº Documento</label>
    
        <div class="col-md-2">
            <input type="text" id="num" name="num" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Data de Emissão</label>
    
        <div class="col-md-2 pr-0">
            <input type="date" id="data_emissao" name="data_emissao" class="form-control" required>
        </div>
        <label class="col-md-2 col-form-label text-md-right">Orgão Emissor</label>

        <div class="col-md-2">
            <input type="text" id="orgao_emissor" name="orgao_emissor" class="form-control" required>
        </div>
    
    
        <label class="col-md-2 col-form-label text-md-right">UF do Orgão Emissor</label>
        @isset($estados)
            <div class="col-md-1 pr-0">
                <select name="uf_documento" id="uf_documento" class="form-control" required>
                    <option value=""></option>
                    @foreach ($estados as $estado)
                        <option value="{{$estado->id}}">{{$estado->uf}}</option>    
                    @endforeach
                </select>
            </div>
        @endisset 
    </div>
    <hr>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right"> Nacionalidade</label>
        <div class="col-md-2">
            <select name="nacionalidade" id="nacionalidade" class="form-control" required>
                <option value=""></option>
                @foreach ($paises as $pais)
                    <option value="{{$pais->id}}">{{$pais->nome}}</option>
                @endforeach
            </select>
        </div>
        <label class="col-md-2 col-form-label text-md-right">Estado</label>

        <div class="col-md-3">
            <select name="estado" id="estado" class="form-control" required>
                <option value=""><option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Naturalidade</label>
        <div class="col-md-2">
        <select name="naturalidade" id="naturalidade" class="form-control" required>
            <option value=""><option>
        </select>
        </div>
    </div>
    <fieldset>
        <legend>Título de Eleitor</legend>
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">Título de Eleitor</label>
            <div class="col-md-2">
                <input type="text" name="titulo_num" id="titulo_num" class="form-control">
            </div>

            <label class="col-md-1 col-form-label text-md-right">UF</label>
            <div class="col-md-2">
                <select name="titulo_uf" id="titulo_uf" class="form-control">
                    <option value=""></option>
                        @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->uf}}</option>
                        @endforeach
                </select>
            </div>
            <label class="col-md-1 col-form-label text-md-right">Município</label>
            <div class="col-md-2">
                <select name="titulo_municipio" id="titulo_municipio" class="form-control">
                    <option value=""></option>
                @isset($doc->titulo_municipio)
                    <option value="{{$doc->titulo_municipio}}">{{$doc->tituloMunicipio->nome}}<option>
                @endisset
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-2 col-form-label text-md-right">Data Emissão</label>
            <div class="col-md-2 pr-0">
                <input type="date" name="titulo_emissao" id="titulo_emissao" class="form-control">
            </div>
        </div>
    </fieldset>
    <div class="row">
        <div class="ml-auto">
            <input type="submit" name="next" class="next action-button btn btn-primary" value="Avançar" />
        </div>
    </div>
</form>