@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="container row justify-content-between"> Lista de Cotas</div>
                </div>
                <div class="card-body">
                    @isset($cota)
                        <form method="POST" action="{{route('cota.edit.save', ['cota' => $cota->id ])}}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>

                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" value="{{$cota->nome}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Descrição</label>

                                <div class="col-md-8">
                                <input type="text" id="descricao" name="descricao" value="{{$cota->descricao}}" placeholder="Descrição opcional" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Prioridade</label>

                                <div class="col-md-8">
                                <input type="text" id="prioridade" name="prioridade" value="{{$cota->prioridade}}" placeholder="Ex: 1" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                            </div>
                        </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection