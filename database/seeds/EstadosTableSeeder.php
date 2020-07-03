<?php

use Illuminate\Database\Seeder;
use App\Estado;
Use App\Pais;
class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::firstOrCreate(['nome' => 'Rondônia', 'uf'=>'RO', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Acre', 'uf'=>'AC', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Amazonas', 'uf'=>'AM', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Roraima', 'uf'=>'RR', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Pará', 'uf'=>'PA', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Amapá', 'uf'=>'AP', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Tocantins', 'uf'=>'TO', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        
        Estado::firstOrCreate(['nome' => 'Maranhão', 'uf'=>'MA', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Piauí', 'uf'=>'PI', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Ceará', 'uf'=>'CE', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Rio Grande do Norte', 'uf'=>'RN', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Paraíba', 'uf'=>'PB', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Pernambuco', 'uf'=>'PE', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Alagoas', 'uf'=>'AL', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Sergipe', 'uf'=>'SE', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Bahia', 'uf'=>'BA', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        
        Estado::firstOrCreate(['nome' => 'Minas Gerais', 'uf'=>'MG', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Espírito Santo', 'uf'=>'ES', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Rio de Janeiro', 'uf'=>'RJ', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'São Paulo', 'uf'=>'SP', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        
        Estado::firstOrCreate(['nome' => 'Paraná', 'uf'=>'PR', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Santa Catarina', 'uf'=>'SC', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Rio Grande do Sul', 'uf'=>'RS', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        
        Estado::firstOrCreate(['nome' => 'Mato Grosso do Sul', 'uf'=>'MS', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Mato Grosso', 'uf'=>'MT', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Goiás', 'uf'=>'GO', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        Estado::firstOrCreate(['nome' => 'Distrito Federal', 'uf'=>'DF', 'pais_id'=> Pais::where('nome','Brasil')->get()->first()->id]);
        
    }
}
