<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ClienteProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_producto',function(Blueprint $table){
            $table->integer('id_cliente');
            $table->integer('id_orden');
            $table->integer('id_cotizacion');

            // Foreign Keys
            $table->foreign('id_cliente')->references('id')->on('clientes');
            $table->foreign('id_orden')->references('id')->on('orden_trabajo');
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
