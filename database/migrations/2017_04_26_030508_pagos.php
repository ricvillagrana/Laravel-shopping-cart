<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_cotizacion');
            $table->decimal('subtotal',10,3);
            $table->decimal('IVA',10,3);
            $table->decimal('total',10,3);
            $table->smallInteger('tipo_proc');
            $table->smallInteger('t_tatjeta');
            $table->boolean('status');

            // Foreign Keys
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
