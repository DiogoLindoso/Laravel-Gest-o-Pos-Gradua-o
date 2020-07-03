<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscricoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscricoes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('turma_id');
            $table->foreign('turma_id')->references('id')->on('turmas');
            $table->unsignedBigInteger('cota_id');
            $table->foreign('cota_id')->references('cota_id')->on('cotas_cursos');
            $table->unsignedBigInteger('curso_id');
            $table->foreign('curso_id')->references('curso_id')->on('cotas_cursos');
            $table->unsignedInteger('tempo_servico_dias')->nullable();
            $table->string('compravante_tempo_servico')->nullable();
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
        Schema::dropIfExists('inscricoes');
    }
}
