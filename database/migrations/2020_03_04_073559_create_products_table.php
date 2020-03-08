<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('code')->comment('Codigo');
            $table->text('description')->comment('Descripcion');
            $table->unsignedBigInteger('category_id')->comment('Categoria_id');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `products` comment 'Productos'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
