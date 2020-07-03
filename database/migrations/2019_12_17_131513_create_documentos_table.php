<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nome');
            $table->enum('sexo',['M','F']);
            $table->string('cpf',11);
            $table->string('nome_mae');
            $table->string('nome_pai')->nullable();
            $table->date('data_nascimento');
            $table->enum('estado_civil',['Solteiro(a)','Casado(a)','Divorciado(a)','Viuvo(a)','União Estável','Outros']);
            $table->enum('tipo_documento',['Civil','Militar','Profissional']);
            $table->string('num_documento');
            $table->date('data_emissao_documento');
            $table->string('orgao_emissor_documento');
            $table->unsignedBigInteger('uf_documento');
            $table->foreign('uf_documento')->references('id')->on('estados');
            $table->unsignedBigInteger('nascimento_municipio');
            $table->foreign('nascimento_municipio')->references('id')->on('municipios');
            $table->string('titulo_num');
            $table->date('titulo_emissao');
            $table->unsignedBigInteger('titulo_municipio');
            $table->foreign('titulo_municipio')->references('id')->on('municipios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('documentos');

    }
}
