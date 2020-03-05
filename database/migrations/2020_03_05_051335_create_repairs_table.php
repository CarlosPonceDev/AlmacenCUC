<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description')->comment('Descripcion');
            $table->string('product_id')->comment('Producto_id');
            $table->text('reason')->comment('Motivo');
            $table->string('personal')->nullable()->comment('Personal');
            $table->timestamp('exit_date')->nullable()->comment('Fecha de salida');
            $table->timestamp('delivery_date')->nullable()->comment('Fecha de entrega');
            $table->unsignedBigInteger('business_id')->comment('Empresa_id');
            $table->unsignedBigInteger('user_id')->comment('Usuario_id');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `repairs` comment 'Reparaciones'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
