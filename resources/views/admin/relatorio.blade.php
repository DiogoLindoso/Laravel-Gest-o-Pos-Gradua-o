@extends('layouts.dashboard')

@section('content')

<div class="row mt-5">
    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total de {{$inscricao->count()}} inscrições </h4>
                
                <ul class="list-style-none mb-0">
                    <li>
                        <span class="text-muted">{{$inscricao->where('cota_id',1)->first()->cota->nome}}</span>
                        <span class="text-dark float-right font-weight-medium">{{$inscricao->where('cota_id',1)->count()}}</span>
                    </li>
                    <li class="mt-3">

                        <span class="text-muted">{{$inscricao->where('cota_id',2)->first()->cota->nome}}</span>
                        <span class="text-dark float-right font-weight-medium">{{$inscricao->where('cota_id',2)->count()}}</span>
                    </li>
                    <li class="mt-3">
 
                        <span class="text-muted">{{$inscricao->where('cota_id',3)->first()->cota->nome}}</span>
                        <span class="text-dark float-right font-weight-medium">{{$inscricao->where('cota_id',3)->count()}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> 
@endsection

