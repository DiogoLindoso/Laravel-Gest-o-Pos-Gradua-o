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
                    @isset($curso)
                        <form method="POST" action="{{route('curso.edit.save',['curso'=>$curso->id])}}">
                            @csrf

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>

                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" value="{{$curso->nome}}" class="form-control">
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