<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEndereco extends FormRequest
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
            'endereco_municipio' => 'required|string',
            'endereco_uf' => 'required',
            'endereco_logradouro' => 'required|string',
            'endereco_bairro' => 'required|string',
            'endereco_num_casa' => 'required|numeric',
            'endereco_complemento' => 'max:50',
            'endereco_cep' => 'required|size:8',
            'contato_celular' => 'required|numeric',
            'contato_fixo' => 'nullable|numeric'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'endereco_cep' => str_replace(['.','-'],'',$this->endereco_cep),
            'contato_celular' =>str_replace(['(',')','-',' '],'',$this->contato_celular),
            'contato_fixo' => str_replace(['(',')','-',' '],'',$this->contato_fixo)
        ]);
    }
}
