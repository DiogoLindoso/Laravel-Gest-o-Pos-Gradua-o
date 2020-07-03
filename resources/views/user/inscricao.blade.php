@extends('layouts.inicio')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
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
    </div>
</div>
@endsection