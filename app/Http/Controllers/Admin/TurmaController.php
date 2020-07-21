<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Turma;
use App\Curso;
use App\Estado;
class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::paginate(10);
        $cursos = Curso::all();
        $estados = Estado::all()->sortBy('nome');
        return view('admin/turmas',compact(['turmas','estados','cursos']));
    }
    public function store(Request $request)
    {
        $turma = new Turma();
        $turma->curso_id = $request->input('curso');
        $turma->municipio_id = $request->input('municipio');
        $turma->nome = $request->input('nome');
        $turma->vagas = $request->input('vagas');
        $turma->save();
        return redirect()->back();
    }
    public function edit(Turma $turma)
    {
        return view('admin/turma-edit',compact('turma'));
    }
    public function update(Request $request, Turma $turma)
    {
        $turma->nome = $request->nome;
        $turma->vagas = $request->vagas;
        $turma->save();
        return redirect()->route('turmas.index');
    }
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('turmas.index');
    }
}
