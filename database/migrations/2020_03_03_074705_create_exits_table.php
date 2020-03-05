<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('date')->comment('Fecha');
            $table->integer('quantity')->comment('Cantidad');
            $table->unsignedBigInteger('unit_id')->comment('Unidad_id');
            $table->unsignedBigInteger('place_id')->comment('Lugar_id');
            $table->unsignedBigInteger('observation_id')->nullable()->comment('Observacion_id');
            $table->unsignedBigInteger('employee_id')->comment('Empleado_id');
            $table->unsignedBigInteger('product_id')->comment('Producto_id');
            $table->unsignedBigInteger('user_id')->comment('Usuario_id');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `exits` comment 'Salidas'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exits');
    }
}
