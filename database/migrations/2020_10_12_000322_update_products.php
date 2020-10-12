<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Product;

class UpdateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("products", function (Blueprint $table)
        {
            $table->unsignedBigInteger('inventory_id')->comment('Inventario_id')->nullable();
            $table->foreign('inventory_id')->references('id')->on('inventory');
        });

        $products = Product::all();

        foreach ($products as $product) {
            $product->inventory_id = $product->inventory->id;
            $product->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("products", function (Blueprint $table)
        {
            $table->dropForeign(['inventory_id']);
            $table->dropColumn('inventory_id');
        });
    }
}
