<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('initial_stock')->comment('Stock inicial');
            $table->bigInteger('cuc_stock')->comment('Stock CUC');
            $table->bigInteger('tomatlan_stock')->comment('Stock Tomatlan');
            $table->bigInteger('gourmet_stock')->comment('Stock Gourmet');
            $table->bigInteger('others_stock')->comment('Stock Otros');
            $table->bigInteger('minimum')->comment('Minima');
            $table->unsignedBigInteger('product_id')->comment('Producto_id');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `inventory` comment 'Inventario'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}
