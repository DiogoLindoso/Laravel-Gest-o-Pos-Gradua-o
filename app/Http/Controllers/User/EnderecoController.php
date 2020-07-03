<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\User;
use App\Endereco;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEndereco;

class EnderecoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission',['except'=>['store']]);
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEndereco $request)
    {
        $address = new Endereco();
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
        return response()->json(['success'=>'Endereço salvo']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json($user->endereco);
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
