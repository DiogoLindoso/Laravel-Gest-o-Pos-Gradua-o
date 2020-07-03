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
                        <div class="container row justify-content-between"> Lista de Turmas
                            <button type="button" class="btn btn-primary align-self-end" data-toggle="modal" data-target="#modalExemplo">
                                Criar Turma
                            </button>
                        </div>
                    </div>
    
                    <div class="card-body" id="alunos">
                        @empty($turmas)
                            <p>Sem turmas cadastradas</p>    
                        @endempty
                        @isset($turmas)
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Município</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Vagas</th>
                                        <th scope="col">Curso</th>                                        
                                        <th scope="col">Ações</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($turmas as $turma)
                                        <tr>
                                            <th scope ="row">
                                                {{$turma->id}}
                                            </th>
                                            <td>
                                                {{$turma->municipio->nome}}
                                            </td>
                                            <td>
                                                {{$turma->nome}}
                                            </td>
                                            <td>
                                                {{$turma->vagas}}
                                            </td>
                                            <td>
                                                {{$turma->curso->nome}}
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" href="{{route('admin.turma.edit',['turma'=>$turma->id])}}" role="button">
                                                        Editar
                                                </a>
                                                    <a class="btn btn-danger" href="{{route('admin.turma.destroy',['turma'=>$turma->id])}}" role="button" >Apagar</button>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset
                        {{$turmas->links()}}
                    </div>
                </div>
            </div>
        </div>
<!-- Modal -->
            <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastro de Turma</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.turmas.submit') }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Curso</label>
                                <div class="col-md-8">
                                    <select name="curso" id="curso" class="form-control" required>
                                        @foreach ($cursos as $curso)
                                        <option value="{{$curso->id}}">{{$curso->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Estado</label>
                                <div class="col-md-8">
                                    <select name="estado" id="estado" class="form-control" required>
                                        @foreach ($estados as $estado)
                                        <option value="{{$estado->id}}">{{$estado->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Municipio</label>
                                <div class="col-md-8">
                                    <select name="municipio" id="municipio" class="form-control" required>
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>
                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Vagas</label>
                                <div class="col-md-8">
                                <input type="number" id="vagas" name="vagas" class="form-control">
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