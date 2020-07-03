<form class="formmultstep" id="formendereco">
    @csrf                            
    <div class="form-group row">

        <label class="col-md-2 col-form-label text-md-right">Estado</label>

        @isset($estados)
            <div class="col-md-2 pr-0">
                <select name="endereco_uf" id="endereco_uf" class="form-control" required>
                    <option value=""></option>
                    @foreach ($estados as $estado)
                        <option value="{{$estado->id}}" {{isset($address->municipio->estado->id) && $address->municipio->estado->id == $estado->id ? 'selected': '' }}>{{$estado->nome}}</option>    
                    @endforeach
                </select>
            </div>
        @endisset
        <label class="col-md-1 col-form-label text-md-right">Municipio</label>

        <div class="col-md-3">
            <select name="endereco_municipio" id="endereco_municipio" class="form-control" required>
                <option value="{{isset($address->municipio->id)? $address->municipio->id : ''}}" selected>{{isset($address->municipio->nome)?$address->municipio->nome:''}}</option>
            </select>
        </div> 
        <label class="col-md-1 col-form-label text-md-right">CEP</label>

        <div class="col-md-2">
            <input type="text" id="endereco_cep" name="endereco_cep" value="{{isset($address->cep)?$address->cep : ''}}" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Logradouro</label>

        <div class="col-md-6">
            <input type="text" id="endereco_logradouro" name="endereco_logradouro" value="{{isset($address->logradouro) ? $address->logradouro : '' }}" class="form-control" required>
        </div>

        <label class="col-md-1 col-form-label text-md-right">Bairro</label>

        <div class="col-md-2">
            <input type="text" id="endereco_bairro" name="endereco_bairro" value="{{isset($address->bairro) ? $address->bairro : ''}}" class="form-control" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Nº Casa</label>

        <div class="col-md-2">
            <input type="number" placeholder="S/Nº = 0" id="endereco_num_casa" name="endereco_num_casa" value="{{isset($address->num) ? $address->num : ''}}" class="form-control" required>
        </div>

        <label class="col-md-2 col-form-label text-md-right">Complemento</label>

        <div class="col-md-5">
            <input type="text" id="endereco_complemento" name="endereco_complemento" value="{{isset($address->complemento) ? $address->complemento : ''}}" class="form-control">
        </div>
    </div> 
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Telefone Celular</label>

        <div class="col-md-3">
            <input type="tel" id="contato_celular" name="contato_celular" value="{{isset($address->celular) ? $address->celular : ''}}" class="form-control" required>
        </div>
    </div>                            
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Telefone Fixo</label>

        <div class="col-md-3">
            <input type="tel" id="contato_fixo" placeholder="Opcional" value="{{isset($address->telefone_fixo) ? $address->telefone_fixo : ''}}" name="contato_fixo" class="form-control">
        </div>
    </div> 
    <div class="row">
        <div class="mr-auto">
            <input type="button" name="previous" class="previous action-button-previous btn btn-primary" value="Voltar" /> 
        </div>
        <div class="ml-auto">
            <input type="submit" name="next" class="next action-button btn btn-primary" value="Avançar" />
        </div>
    </div>
</form>