<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = new Curso();
        $cursos = $cursos::all();
        return view('admin/cursos', compact('cursos'));
    }
    public function store(Request $request)
    {   
        $request->validate([
            'nome' => 'required'
        ]);
        $curso = new Curso();
        $curso->nome = $request->input('nome');
        $curso->save();
        return redirect()->route('admin/admin.cursos');
    }
    public function view(Curso $curso)
    {   
        return view('admin/curso-edit',compact('curso'));
    }
    public function edit(Request $request)
    {
        $curso = new Curso();
        $curso = $curso::find($request->curso);
        $curso->nome = $request->input('nome');
        $curso->save();
        return redirect()->route('admin.cursos');
    }
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('admin.cursos');
    }
}
