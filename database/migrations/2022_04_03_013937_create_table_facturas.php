<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFacturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('emisor_nombre');
            $table->integer('emisor_num_doc');
            $table->integer('emisor_num_doc_dv');
            $table->string('comprador_nombre');
            $table->integer('comprador_num_doc');
            $table->integer('comprador_num_doc_dv');
            $table->float('subtotal');
            $table->integer('iva')->nullable();
            $table->float('iva_value')->nullable();
            $table->float('total');
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
        Schema::dropIfExists('facturas');
    }
}
