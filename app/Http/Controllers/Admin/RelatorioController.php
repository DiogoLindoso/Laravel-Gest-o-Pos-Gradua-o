<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inscricao;
use App\Cota;

class RelatorioController extends Controller
{
    public function index()
    {
        $cotas = Cota::select('id', 'nome')->get();

        foreach ($cotas as $key => $cota) {
            $cotas[$key]['count'] = Inscricao::where('cota_id', $cota->id)->count();
        }
        $somaCotas = $cotas->sum('count');
        
        return view('admin.relatorio', compact('cotas', 'somaCotas'));
    }
}
