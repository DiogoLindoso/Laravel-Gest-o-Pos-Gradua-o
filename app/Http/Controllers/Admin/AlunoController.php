<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inscricao;
use App\Turma;
use Illuminate\Support\Facades\DB;
class AlunoController extends Controller
{
    public function index()
    {
        $turmas = Turma::all();
        return view('admin/alunos',compact(['turmas']));
    }
    public function turma(Turma $turma)
    {
        $inscricoes = DB::table('inscricoes as i')
        ->leftJoin('cotas as c','i.cota_id','=','c.id')
        ->leftJoin('turmas as t','i.turma_id','=','t.id')
        ->leftJoin('documentos as d', 'i.user_id','=','d.user_id')
        ->leftJoin('municipios as m', 't.municipio_id','=','m.id')
        ->where('i.turma_id','=',$turma->id)
        ->orderBy('m.nome')
        ->orderBy('c.prioridade')
        ->orderBy('i.tempo_servico_dias','desc')
        ->limit($turma->vagas)
        ->get(['i.id as inscricao','i.tempo_servico_dias','c.nome as cotaNome','m.nome as municipioNome','d.nome as docNome']);
        return json_encode($inscricoes);
    }
}
