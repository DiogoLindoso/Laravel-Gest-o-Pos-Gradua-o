<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Cota;
class CotaController extends Controller
{
    public function index()
    {
        $cotas = new Cota();
        $cotas = $cotas::all();
        return view('admin/cotas', compact('cotas'));
    }
    public function store(Request $request)
    {   
        $request->validate([
            'nome' => 'required',
            'prioridade' => 'required'
        ]);
        $cota = new Cota();
        $cota->nome = $request->input('nome');
        $cota->descricao = $request->input('descricao');
        $cota->prioridade = $request->input('prioridade');
        $cota->save();
        return redirect()->route('admin.cotas');
    }
    public function view(Cota $cota)
    {   
        return view('admin/cotas-edit',compact('cota'));
    }
    public function edit(Request $request)
    {
        $cota = new Cota();
        $cota = $cota::find($request->cota);
        $cota->nome = $request->input('nome');
        $cota->descricao = $request->input('descricao');
        $cota->prioridade = $request->input('prioridade');
        $cota->save();
        return redirect()->route('admin.cotas');
    }
    public function destroy(Cota $cota)
    {
        $cota->delete();
        return redirect()->route('admin.cotas');
    }
}
