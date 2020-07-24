@extends('layouts.dashboard')

@section('content')

<div class="row mt-5">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total de {{$somaCotas}} inscrições </h4>
                
                <ul class="list-style-none mb-0">
                    @foreach ($cotas as $cota)
                        <li class="mt-3">
                            <span class="text-muted">{{$cota->nome}}</span>
                            <span class="text-dark float-right font-weight-medium">{{$cota->count}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div> 
@endsection

