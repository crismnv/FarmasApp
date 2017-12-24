<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearBCambioEstadosReservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('b_cambio_estados_reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('trabajador_id');
            $table->foreign('trabajador_id')->references('id')->on('trabajadores')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('reserva_id');
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('restrict')->onUpdate('restrict');
            $table->string('estado_reserva_anterior', 15);
            $table->string('estado_reserva_nuevo', 15);
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
        Schema::dropIfExists('b_cambio_estados_reservas');
    }
}
