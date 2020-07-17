<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Inscricao;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInscricao;
use Illuminate\Support\Facades\Storage;
use App\Curso;
use App\Pais;
use App\Estado;
use App\Turma;

class InscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission',['except'=>['store','create']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =auth()->user()->id;
        $cursos =  Curso::all()->sortBy('nome');
        $paises = Pais::all()->sortBy('nome');
        $estados = Estado::all()->sortBy('nome');
        $turmas = Turma::where('curso_id',1)->get();
        $cotas = Curso::with('cotas')->get();

        return view('user.inscricao',compact(['estados','turmas','cotas','paises','cursos','user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInscricao $request)
    {
        $user = auth()->user();
        if (empty($user->endereco) && empty($user->documento)) {
            return response()->json(['errors'=>'Documentos e Endereço não cadastrados']);
        }
        $inscricao = new Inscricao();
        $inscricao =  $user->inscricao == null ? new Inscricao() : $user->inscricao;
        if (!empty($inscricao->compravante_tempo_servico && !empty($request->comprovante))) {
            $inscricao->compravante_tempo_servico = $request->comprovante->store('comprovantes','public');    
        }
        
        $periodos = json_decode($request->periodos,true);
        $dias = [];
        foreach ($periodos as $periodo)
        {
            $diff = abs(strtotime($periodo['dF']) - strtotime($periodo['dI']));
            $dia = $diff/(60*60*24);            
            array_push($dias,$dia);
        }
        $inscricao->turma_id = $request->turma;
        $inscricao->cota_id = $request->cota;
        $inscricao->curso_id = $request->curso;
        $inscricao->tempo_servico_dias = array_sum($dias);
        $inscricao->periodo_servico = $request->periodos;
        $user->inscricao()->save($inscricao);
        return response()->json(['success'=>'Inscrição Realizada']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       // return response()->json($user->inscricao);
       return view('user.comprovante',compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
