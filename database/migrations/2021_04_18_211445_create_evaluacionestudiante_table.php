<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionestudianteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacionestudiante', function (Blueprint $table) {
            $table->bigIncrements('idevaluacionestudiante');
            $table->unsignedBigInteger('estudiante_id');
            $table->unsignedBigInteger('contacto_id');
            $table->text('bienvenida');
            $table->text('concepto');
            $table->text('vocabulario');
            $table->string('mes');
            $table->integer('ausencias');
            $table->integer('anio');
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
        Schema::dropIfExists('evaluacionestudiante');
    }
}
