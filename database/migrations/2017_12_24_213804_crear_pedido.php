<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearPedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ingrediente_id');
            $table->foreign('ingrediente_id')->references('id')->on('ingredientes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('restrict')->onUpdate('restrict');
            $table->date('fecha');
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
        Schema::dropIfExists('pedido');
    }
}
