@extends('layouts.inicio')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card">
        <div class="card-header">
            Area do candidato
        </div>
        <div class="card-body">
            <h5 class="card-title ml-1">Bem vindo ! {{Auth::user()->documento->nome}}</h5>
            @empty($inscricao->id)
            <div class="row mb-3 ml-1">
                <a href="{{route('inscricao.create',['user'=>Auth::user()])}}" class="btn btn-primary col col-md-3">Realizar Inscrição</a>
              </div>
            @endempty

          <div class="row mb-3 ml-1">
            <a href="#" class="btn btn-primary col col-md-3">Visualizar Inscrição</a>
          </div>
          <form action="{{route('password.request')}}" method="GET">
            @csrf
            <div class="row mb-3 ml-1">

                <input type="submit" class="btn btn-warning col col-md-3" value="Alterar Senha"    >
              </div>
          </form>

          
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="row mb-3 ml-1">
                    <input type="submit" class="btn btn-danger col col-md-3" value="Sair">
                </div>
            </form>
            
         
        </div>
      </div>
    {{--<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="documentos"><strong>Dados Pessoais</strong></li>
                        <li id="endereco"><strong>Endereço</strong></li>
                        <li id="inscricao"><strong>Inscrição</strong></li>
                        <li id="confirmacao"><strong>Confirmação</strong></li>
                    </ul> <!-- fieldsets -->
                </div>

                <div class="card-body">
                    @include('forms.documentos')
                    @include('forms.endereco')
                    @include('forms.inscricao')
                    @include('forms.confirmacao')
                </div>
            </div>
        </div>
    </div>--}}
</div>
@endsection
