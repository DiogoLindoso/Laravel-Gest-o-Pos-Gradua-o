<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inscricao;

class RelatorioController extends Controller
{
    public function index()
    {
        $inscricao = Inscricao::get();
        return view('admin.relatorio', compact('inscricao'));
    }
}
