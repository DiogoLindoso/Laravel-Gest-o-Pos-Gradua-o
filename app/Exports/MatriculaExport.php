<?php

namespace App\Exports;

use DB;
use App\Inscricao;
use Maatwebsite\Excel\Concerns\FromArray;

class MatriculaExport implements FromArray
{
    /**
     * @return array
     */
    public function array(): array
    {
         
        $matricula_data = DB::table('inscricoes as i')
        ->join('users as u', 'u.id', '=', 'i.user_id')
        ->join ('enderecos as e', 'u.id', '=', 'e.user_id')
        ->join('documentos as d', 'u.id', '=', 'd.user_id')
        ->join('cotas as cot','cot.id', '=', 'i.cota_id')
        ->join('cursos as cur', 'cur.id', '=', 'i.curso_id')
        ->join('turmas as t', 't.id', '=', 'i.turma_id')
        ->join('municipios as m', 'm.id', '=', 't.municipio_id')
        ->join('municipios as m_e', 'm_e.id', '=', 'e.municipio_id') 
        ->orderBy('m.nome')
        ->orderBy('cot.prioridade')
        ->orderBy('i.tempo_servico_dias','desc')
        ->get([
            'cur.nome as NOME_CURSO',
            'd.nome as ALUNO',
            'm.nome as TURMA_PREF',
            'd.estado_civil as EST_CIVIL',
            'd.nome as NOME_COMPL',
            'd.nome as NOME_ABREV',
            'd.sexo as SEXO',
            'd.nome_pai as NOME_PAI',
            'd.nome_mae as NOME_MAE',
            'd.tipo_documento as RG_TIPO',
            'd.num_documento as RG_NUM',
            'd.orgao_emissor_documento as RG_EMISSOR',
            'd.uf_documento as RG_UF',
            'd.data_emissao_documento as RG_DTEXP',
            'd.cpf as CPF',
            'd.data_nascimento as DT_NASC',
            'e.logradouro as ENDERECO',
            'e.num as END_NUM',
            'e.complemento as END_COMPL',
            'e.bairro as BAIRRO',
            'm_e.nome as CIDADE',
            'e.cep as CEP',
            'e.celular as FONE',
            'u.email as EMAIL' 
        ])->toArray();
     $matricula_array[] = array(
        'CURSO',
        'NOME_CURSO',
        'TURNO',
        'CURRICULO',
        'UNIDADE_FISICA',
        'ALUNO',
        'PESSOA',
        'SERIE',
        'TURMA_PREF',
        'EST_CIVIL',
        'DIVIDA_BIBLIO',
        'ANOCONCL_2G',
        'TIPO_INGRESSO',
        'ANO_INGRESSO',
        'SEM_INGRESSO',
        'SIT_ALUNO',
        'NOME_COMPL',
        'NOME_ABREV',
        'SEXO',
        'NOME_PAI',
        'NOME_MAE',
        'RG_TIPO',
        'RG_NUM',
        'RG_EMISSOR',
        'RG_UF',
        'RG_DTEXP',
        'CPF',
        'DT_NASC',
        'ENDERECO',
        'END_NUM',
        'END_COMPL',
        'BAIRRO',
        'END_MUNICIPIO',
        'CIDADE',
        'CEP',
        'FONE',
        'EMAIL'
     );

     foreach($matricula_data as $matricula)
     {
      $matricula_array[] = array(
       'CURSO' => '',
       'NOME_CURSO' => $matricula->NOME_CURSO,
       'TURNO' => 'LSEST',
       'CURRICULO' => 'LMEM2020',
       'UNIDADE_FISICA' => 'EST',
       'ALUNO' => '',
       'PESSOA' => '',
       'SERIE' => 1,
       'TURMA_PREF' => $matricula->TURMA_PREF,
       'EST_CIVIL' => $matricula->EST_CIVIL,
       'DIVIDA_BIBLIO' => 'não',
       'ANOCONCL_2G' => '',
       'TIPO_INGRESSO' => 'concurso',
       'ANO_INGRESSO' => 2020,
       'SEM_INGRESSO' => '2020_2',
       'SIT_ALUNO' => 'ativo',
       'NOME_COMPL' => $matricula->NOME_COMPL,
       'NOME_ABREV' => $matricula->NOME_ABREV,
       'SEXO' => $matricula->SEXO,
       'NOME_PAI' => $matricula->NOME_PAI,
       'NOME_MAE' => $matricula->NOME_MAE,
       'RG_TIPO' => $matricula->RG_TIPO,
       'RG_NUM' => $matricula->RG_NUM,
       'RG_EMISSOR' => $matricula->RG_EMISSOR,
       'RG_UF' => $matricula->RG_UF,
       'RG_DTEXP' => date_format(date_create($matricula->RG_DTEXP),'d/m/Y'),
       'CPF' => $matricula->CPF,
       'DT_NASC' => date_format(date_create($matricula->DT_NASC), 'd/m/Y'),
       'ENDERECO' => $matricula->ENDERECO,
       'END_NUM' => $matricula->END_NUM,
       'END_COMPL' => $matricula->END_COMPL,
       'BAIRRO' => $matricula->BAIRRO,
       'END_MUNICIPIO' => '',
       'CIDADE' => $matricula->CIDADE,
       'CEP' => $matricula->CEP,
       'FONE' => $matricula->FONE,
       'EMAIL' => $matricula->EMAIL
      );
     }

        return $matricula_array;
    }
}
