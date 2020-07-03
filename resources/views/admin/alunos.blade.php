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
                        <div class="container row justify-content-between"> Lista de Alunos
                            <div class="row col-md-4">
                                <select name="turma" id="turma" class="form-control">
                                    
                                    @foreach ($turmas as $turma)
                                        <option value="{{$turma->id}}">{{$turma->municipio->nome}}</option>    
                                    @endforeach
                                    
                                </select>
                            </div>

                        </div>
                    </div>
    
                    <div class="card-body" id="alunos">
                        @empty($inscricoes)
                            <p>Sem Inscritos</p>    
                        @endempty
                        @isset($inscricoes)
                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº Inscricao</th>
                                        <th scope="col">Turma</th>
                                        <th scope="col">Cota</th>
                                        <th scope="col">Tempo de Serviço</th>
                                        <th scope="col">Nome</th>                                        
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inscricoes as $inscricao)
                                        <tr>
                                            <th scope ="row">
                                                {{$inscricao->inscricao}}
                                            </th>
                                            <td>
                                                {{$inscricao->municipioNome}}
                                            </td>
                                            <td>
                                                {{$inscricao->cotaNome}}
                                            </td>
                                            <td>
                                                {{$inscricao->tempo_servico_dias}} - Dias
                                            </td>
                                            <td>
                                                {{$inscricao->docNome}}
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