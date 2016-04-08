<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFkTable extends Migration
{

    public function up()
    {
        Schema::table('disciplina_professor', function ($table) {
            $table->foreign('professor_id')->references('id')->on('professors');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

        });


        Schema::table('disciplina_semestre', function ($table) {
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');

        });

        Schema::table('avaliacaos', function ($table) {
            $table->foreign('semestre_id')->references('id')->on('semestres');
        });

        Schema::table('respostas', function ($table) {
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });

        Schema::table('avaliacao_pergunta', function ($table) {
            $table->foreign('avaliacao_id')->references('id')->on('avaliacaos');
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });

        Schema::table('opcao_resposta', function ($table) {
            $table->foreign('pergunta_id')->references('id')->on('perguntas');
        });

        Schema::table('pre_requisito', function ($table) {
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('possui_codigo_disciplina')->references('id')->on('disciplinas');
        });
    }


    public function down()
    {

    }
}