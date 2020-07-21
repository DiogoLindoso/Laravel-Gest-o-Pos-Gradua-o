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
        $curso->fill($request->all())->save();
        return redirect()->route('cursos.index');
    }
    public function edit(Curso $curso)
    {   
        return view('admin/curso-edit',compact('curso'));
    }
    public function update(Request $request, Curso $curso)
    {
        $curso->fill($request->all())->save();
        return redirect()->route('cursos.index');
    }
    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
