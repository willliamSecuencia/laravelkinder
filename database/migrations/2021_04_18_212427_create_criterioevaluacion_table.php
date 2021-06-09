<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCriterioevaluacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criterioevaluacion', function (Blueprint $table) {
            $table->bigIncrements('idcriterioevaluacion');
            $table->unsignedBigInteger('evaluacionestudiante_id');
            $table->unsignedBigInteger('listacriterio_id');
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
        Schema::dropIfExists('criterioevaluacion');
    }
}
