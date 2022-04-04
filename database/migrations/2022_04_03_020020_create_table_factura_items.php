<?php

use App\Models\Factura;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFacturaItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_items', function (Blueprint $table) {
            $table->id();
            $table->string("descripcion");
            $table->integer("cantidad");
            $table->float("valor");
            $table->float("total");
            $table->foreignIdFor(Factura::class);
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
        Schema::dropIfExists('factura_items');
    }
}
