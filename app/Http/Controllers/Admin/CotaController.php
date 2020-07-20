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
        $cota->fill($request->all())->save();
        return redirect()->route('cotas.index');
    }
    public function edit(Cota $cota)
    {   
        return view('admin/cotas-edit',compact('cota'));
    }
    public function update(Request $request, Cota $cota)
    {
        $cota->fill($request->all())->save();
        return redirect()->route('cotas.index');
    }
    public function destroy(Cota $cota)
    {
        $cota->delete();
        return redirect()->route('cotas.index');
    }
}
