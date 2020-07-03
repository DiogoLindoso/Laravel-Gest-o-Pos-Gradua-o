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
                        <div class="container row justify-content-between"> Lista de Cursos
                            <button type="button" class="btn btn-primary align-self-end" data-toggle="modal" data-target="#modalExemplo">
                                Criar Curso
                            </button>
                        </div>
                    </div>
    
                    <div class="card-body">
                        @empty($cursos)
                            <p>Sem cursos cadastradas</p>    
                        @endempty
                        @isset($cursos)
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cursos as $curso)
                                        <tr>
                                            <th scope ="row">
                                                {{$curso->id}}
                                            </th>
                                            <td>
                                                {{$curso->nome}}
                                            </td>
                                            <td>
                                            <a class="btn btn-primary" href="{{route('curso.edit',['curso'=>$curso->id])}}" role="button">
                                                    Editar
                                            </a>
                                                <a class="btn btn-danger" href="{{route('curso.destroy',['curso'=>$curso->id])}}" role="button" >Apagar</button>
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
                        <form method="POST" action="{{ route('curso.submit') }}">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label text-md-right">Nome</label>

                                <div class="col-md-8">
                                <input type="text" id="nome" name="nome" class="form-control">
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