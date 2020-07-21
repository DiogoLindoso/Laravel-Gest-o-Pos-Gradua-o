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
@endsection