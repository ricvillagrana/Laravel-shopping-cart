<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria');
            $table->string('nombre');
            $table->decimal('precio',10,3);
            $table->integer('cantMax');
            $table->integer('cantMin');
            $table->text('descripcion');
            $table->timestamps();

            //  Foreign keys 
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('productos');
    }
}
