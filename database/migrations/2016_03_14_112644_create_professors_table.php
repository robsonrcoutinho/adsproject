<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessorsTable extends Migration
{

    public function up()
    {
        Schema::create('professors', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('matricula', 6)->nullable();
            $table->string('matricula', 6)->unique();
            $table->string('nome', 30);
            //$table->boolean('ativo')->default(true);
            $table->softDeletes();
            $table->string('curriculo', 100)->nullable();

            $table->unsignedInteger('disciplina_id');

        });
    }


    public function down()
    {
        //Schema::drop('professors');
    }
}
