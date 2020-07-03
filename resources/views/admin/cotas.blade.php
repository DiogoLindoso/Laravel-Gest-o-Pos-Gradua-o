@extends('layouts.dashboard')

@section('content')

<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="container row justify-content-between"> Lista de Cotas
                            <button type="button" class="btn btn-primary align-self-end" data-toggle="modal" data-target="#modalExemplo">
                                Criar Cota
                            </button>
                        </div>
                    </div>
    
                    <div class="card-body">
                        @empty($cotas)
                            <p>Sem cotas cadastradas</p>    
                        @endempty
                        @isset($cotas)
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Descrição</th>
                                        <th scope="col">Prioridade</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cotas as $cota)
                                        <tr>
                                            <th scope ="row">
                                                {{$cota->id}}
                                            </th>
                                            <td>
                                                {{$cota->nome}}
                                            </td>
                                            <td>
                                                {{$cota->descricao}}
                                            </td>
                                            <td>
                                                {{$cota->prioridade}}
                                            </td>
                                            <td>
                                            <a class="btn btn-primary" href="{{route('cota.edit',['cota'=>$cota->id])}}" role="button">
                                                    Editar
                                            </a>
                                                <a class="btn btn-danger" href="{{route('cota.destroy',['cota'=>$cota->id])}}" role="button" >Apagar</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                        

                    </div>

                </div>
            </div>
        </div>
<!-- Modal -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Título do modal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('cota.submit') }}">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>

                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Descrição</label>

                                <div class="col-md-8">
                                <input type="text" id="descricao" name="descricao" placeholder="Descrição opcional" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Prioridade</label>

                                <div class="col-md-8">
                                <input type="text" id="prioridade" name="prioridade" placeholder="Ex: 1" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar mudanças</button>
                              </div>
                        </form>

                    </div>

                </div>
            </div>
        </div> 

@endsection