<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Documento;
use App\Endereco;
use App\Estado;
use App\Pais;
use App\Municipio;
use App\Inscricao;
use App\Curso;
use App\Turma;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreDocumentos;
use App\Http\Requests\StoreEndereco;
use App\Http\Requests\StoreInscricao;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        $user = auth()->user();
        $doc = new Documento();
        $doc = $doc::find($user->id);
        $estados = Estado::all()->sortBy('nome');
        $paises = Pais::all()->sortBy('nome');
        $municipios = Municipio::all()->sortBy('nome');
        $cursos =  Curso::all()->sortBy('nome');
        $turmas = Turma::where('curso_id',1)->get();
        $cotas = Curso::with('cotas')->get();
        if ($user->inscricao) {
            $periodos =  json_decode($user->inscricao->periodo_servico,true);
        }else{
            $periodos = null;
        }
        
        
        if (isset($doc))
        {
            $address = new Endereco();
            $address = $address::find($user->id);
            
            return view('user/home', compact(['doc','address','paises','municipios','estados','cursos','turmas','cotas','user','periodos']));
        }else 
        {   $doc = new Documento();
            return view('user/home',compact(['doc','estados','paises','municipios','turmas','cotas']));
        }
        */
        //dd(auth()->user());
        /*if (auth()->user()->inscricao->id) {
            $inscricao = auth()->user()->inscricao->id;
           
            return view('user/home',compact(['inscricao']));
            
        }*/
        //return view('user/home');
    }
    public function show()
    {   /*
        $cursos =  Curso::all()->sortBy('nome');
        $paises = Pais::all()->sortBy('nome');
        $estados = Estado::all()->sortBy('nome');
        $turmas = Turma::where('curso_id',1)->get();
        $cotas = Curso::with('cotas')->get();

        return view('user/inscricao',compact(['estados','turmas','cotas','paises','cursos']));*/
    }
    public function createdoc(StoreDocumentos $request)
    {/*
        $user = auth()->user();
        $doc = new Documento();
        $doc = $doc::find($user->id) == null ? new Documento() : $doc::find($user->id);
        $doc->nome = $request->input('nome');
        $doc->sexo = $request->input('sexo');
        $doc->cpf = $request->input('cpf');
        $doc->nome_mae = $request->input('mae');
        $doc->nome_pai = $request->input('pai');
        $doc->data_nascimento = $request->input('nascimento');
        $doc->estado_civil = $request->input('estado_civil');
        $doc->tipo_documento = $request->input('tipo');
        $doc->num_documento = $request->input('num');
        $doc->data_emissao_documento = $request->input('data_emissao');
        $doc->orgao_emissor_documento = $request->input('orgao_emissor');
        $doc->uf_documento = $request->input('uf_documento');
        $doc->nascimento_municipio = $request->input('naturalidade');
        $doc->titulo_num = $request->input('titulo_num');
        $doc->titulo_emissao = $request->input('titulo_emissao');
        $doc->titulo_municipio = $request->input('titulo_municipio');
        $user->documento()->save($doc);

        return response()->json(['success'=>'Endereço salvo']); */
    }
    public function createendereco(StoreEndereco $request)
    {
        /*$address = new Endereco();
        $user = auth()->user();
        $address = $address::find($user->id) == null ? new Endereco() : $address::find($user->id);
        $address->municipio_id = $request->input('endereco_municipio');
        $address->cep = $request->input('endereco_cep');
        $address->logradouro = $request->input('endereco_logradouro');
        $address->bairro = $request->input('endereco_bairro');
        $address->num = $request->input('endereco_num_casa');
        $address->complemento = $request->input('endereco_complemento');
        $address->celular = $request->input('contato_celular');
        if (!empty($request->input('contato_fixo'))) 
        {
            $address->telefone_fixo = $request->input('contato_fixo');
        }
        
        $user->endereco()->save($address);
        return response()->json(['success'=>'Endereço salvo']);*/
    }
    public function createinscricao(StoreInscricao $request)
    {/*
        $user = auth()->user();
        $inscricao = new Inscricao();
        $inscricao =  $inscricao::find($user->id) == null ? new Inscricao() : $inscricao::find($user->id);
        if (isset($request->comprovante)) 
        {
            Storage::disk('public')->delete($user->inscricao->compravante_tempo_servico);
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
        return response()->json(['success'=>'Inscrição Realizada']);*/
    }
}
