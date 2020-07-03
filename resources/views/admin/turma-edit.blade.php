@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="container row justify-content-between"> Editar Turma</div>
                </div>
                <div class="card-body">
                    @isset($turma)
                        <form method="POST" action="{{route('admin.turma.edit.save', ['turma' => $turma->id ])}}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Curso</label>
                                <div class="col-md-8">
                                    <select name="curso" id="curso" class="form-control" disabled>
                                        <option value="">{{$turma->curso->nome}}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Municipio</label>
                                <div class="col-md-8">
                                    <select name="municipio" id="municipio" class="form-control" disabled>
                                        <option value="">{{$turma->municipio->nome}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>
                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" value="{{$turma->nome}}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Vagas</label>
                                <div class="col-md-8">
                                <input type="number" id="vagas" name="vagas" value="{{$turma->vagas}}" class="form-control">
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