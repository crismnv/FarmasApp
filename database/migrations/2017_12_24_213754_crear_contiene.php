<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearContiene extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contiene', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('preparado_id');
            $table->foreign('preparado_id')->references('id')->on('preparados')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('ingrediente_id');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes')->onDelete('restrict')->onUpdate('restrict');
            $table->double('cantidad', 8, 2);
            $table->string('estado', 15)->default('ACTIVO');
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
        Schema::dropIfExists('contiene');
    }
}
