<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
Use App\Rules\Cpf;

class StoreDocumentos extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string',
            'sexo'=> 'required',
            'cpf' => [
                'required',
                'size:11',
                Rule::unique('documentos')->ignore(auth()->user()->documento),
                new Cpf
            ],
            'mae' => 'required|string',
            'pai' => 'nullable',
            'nascimento' => 'required|date',
            'tipo' => 'required',
            'num' => 'required|numeric',
            'data_emissao' => 'required|date',
            'orgao_emissor' => 'required|string|min:3|max:10',
            'uf_documento' => 'required',
            'nacionalidade' => 'required',
            'estado' => 'required',
            'naturalidade' => 'required',
            'estado_civil' => 'required',
            'titulo_num' => 'required',
            'titulo_municipio' => 'required',
            'titulo_emissao' => 'required',
            'titulo_uf'=> 'required'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => str_replace(['.','-'],'',$this->cpf),
        ]);
    }
}
