<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Documento;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentos;

class DocumentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission',['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDocumentos $request)
    {
        try {
            $user = auth()->user();
            $doc = new Documento();
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
    
            return response()->json(['success'=>'Documento Salvo']); 
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                $this->update($request, auth()->user());
                return response()->json(['success'=>'Documento Atualizado']); 
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user->documento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

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
        $user->documento->nome = $request->input('nome');
        $user->documento->sexo = $request->input('sexo');
        $user->documento->cpf = $request->input('cpf');
        $user->documento->nome_mae = $request->input('mae');
        $user->documento->nome_pai = $request->input('pai');
        $user->documento->data_nascimento = $request->input('nascimento');
        $user->documento->estado_civil = $request->input('estado_civil');
        $user->documento->tipo_documento = $request->input('tipo');
        $user->documento->num_documento = $request->input('num');
        $user->documento->data_emissao_documento = $request->input('data_emissao');
        $user->documento->orgao_emissor_documento = $request->input('orgao_emissor');
        $user->documento->uf_documento = $request->input('uf_documento');
        $user->documento->nascimento_municipio = $request->input('naturalidade');
        $user->documento->titulo_num = $request->input('titulo_num');
        $user->documento->titulo_emissao = $request->input('titulo_emissao');
        $user->documento->titulo_municipio = $request->input('titulo_municipio');
        $user->documento()->save($user->documento);

        return response()->json(['success'=>'Documento Atualizado']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

    }
}
