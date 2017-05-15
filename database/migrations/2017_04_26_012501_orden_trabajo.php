<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdenTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_trabajo',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_cotizacion');
            // Tipo de servicio podrá contener:
            //      1::Normal
            //      2::Urgente
            //      3::Extra
            $table->smallInteger('tipo_servicio');
            // Tipo de empastado podrá contener:
            //      1::Tesis
            //      2::Libro
            $table->smallInteger('tipo_empastado');
            $table->smallInteger('pasta_dura');
            $table->smallInteger('pasta_delgada');
            $table->smallInteger('pasta_calidad');
            $table->smallInteger('color_cant');
            $table->decimal('color_costo',10,3);
            $table->string('color_papel');
            $table->smallInteger('bn_cant');
            $table->decimal('bn_costo',10,3);
            $table->string('bn_papel');
            $table->boolean('digitesis');
            $table->boolean('disco_sencillo');
            $table->boolean('disco_bolsa');
            // Impresión podrá contener:
            //      1::Serigrafía
            //      2::Offset
            //      3::Digital
            //      4::Sublimado
            $table->smallInteger('impresion');
            $table->text('descripcion');
            $table->text('observaciones');
            $table->dateTime('fecha_entrega');
            $table->timestamps();

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
        Schema::drop('orden_trabajo');
    }
}
