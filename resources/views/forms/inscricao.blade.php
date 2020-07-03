<form class="formmultstep" id="forminscricao">
    @csrf
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Curso</label>
            <div class="col-md-3">
                <select name="curso" id="curso" class="form-control" required>
                    <option value=""></option>
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}" 
                            {{isset($user->inscricao->curso->id)
                            && $user->inscricao->curso->id == $curso->id ? 'selected': '' }}>
                            {{$curso->nome}}</option>    
                    @endforeach
                </select>
            </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Turma / Município</label>
        <div class="col-md-4">
            <select name="turma" id="turma" class="form-control" required>
                <option value=""></option>
                @foreach ($turmas as $turma)
                    <option 
                        value="{{$turma->id}}"
                        {{isset($user->inscricao->turma->id) 
                        && $user->inscricao->turma->id == $turma->id ? 'selected' : ''}}>
                        {{$turma->municipio->nome}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-2 col-form-label text-md-right">Cota</label>
        <div class="col-md-3">
            <select name="cota" id="cota" class="form-control" required>
                <option value=""></option>
                @foreach ($cotas as $colecao)
                    @foreach ($colecao->cotas as $cota)
                        <option 
                            value="{{$cota->id}}"
                            {{isset($user->inscricao->cota->id)
                            && $user->inscricao->cota->id == $cota->id ? 'selected' : ''}}>{{$cota->nome}}
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>
    </div>
     
    <fieldset>
        <legend> Calculo do Tempo de Serviço </legend> 

            <input type="button" class="btn btn-primary" id="plus" value="Acrescentar Período" /> 
            @isset($periodos)
                @foreach ($periodos as $i => $periodo)
                    <div class="form-group row" id="P-{{$i}}">
                        <label class="col-md-2 col-form-label text-md-right">{{$i}}º Período</label>
                        <div class="col-md-3">
                            <input type="date" name="tempoInicial-{{$i}}" value="{{$periodo["dI"]}}" class="form-control" required>
                            <small class="form-text text-muted">Inserir data de início.</small>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tempoFinal-{{$i}}" value="{{$periodo["dF"]}}" class="form-control" required>
                            <small class="form-text text-muted">Inserir data de fim.</small>
                        </div>
                    </div>  
                @endforeach
            @endisset
            @empty($periodos)
            <div class="form-group row" id="P-1">
                <label class="col-md-2 col-form-label text-md-right">1º Período</label>
                <div class="col-md-3">
                    <input type="date" name="tempoInicial-1" class="form-control" required>
                    <small class="form-text text-muted">Inserir data de início.</small>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tempoFinal-1" class="form-control" disabled="disabled" required>
                    <small class="form-text text-muted">Inserir data de fim.</small>
                </div>
            </div>
            @endempty

    </fieldset>
    @isset($user->inscricao->compravante_tempo_servico)
        <a href="/storage/{{$user->inscricao->compravante_tempo_servico}}" target="_blank">{{$name = str_replace("comprovantes/","", $user->inscricao->compravante_tempo_servico)}}</a>    
        <div class="form-group row">
            <div class="col-md-6">
                <label for="enviocomprovante">Substituir comprovante de tempo de serviços em PDF</label>
                <input type="file" id ="comprovante" name="comprovante" class="form-control-file" id="enviocomprovante">
            </div>
        </div>
    @endisset
    @empty($user->inscricao->compravante_tempo_servico)
        <div class="form-group row">
            <div class="col-md-6">
                <label for="enviocomprovante">Envio comprovante de tempo de serviço em PDF</label>
                <input type="file" id ="comprovante" name="comprovante" class="form-control-file" id="enviocomprovante" required>
            </div>
        </div>
    @endempty
        <div class="row">
            <div class="mr-auto">
                <input type="button" name="voltar" class="previous action-button-previous btn btn-primary" value="Voltar" /> 
            </div>
            <div class="ml-auto">
                <input type="submit" name="Inscrever" class="next action-button btn btn-primary" value="Inscrever" />
            </div>
        </div>
</form>