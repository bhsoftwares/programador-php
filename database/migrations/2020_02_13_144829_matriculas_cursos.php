<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatriculasCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas_cursos', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('matricula_id');
            $table->unsignedInteger('curso_id');
            $table->foreign('matricula_id')->references('id')
                ->on('matriculas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('curso_id')->references('id')
                ->on('cursos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('matriculas_cursos');
    }
}
