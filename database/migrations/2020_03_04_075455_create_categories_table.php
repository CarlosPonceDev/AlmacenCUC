<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Nombre');
            $table->string('description')->comment('Descripcion');
            $table->string('prefix')->comment('Prefijo');
            $table->string('icon')->comment('Icono');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement("ALTER TABLE `categories` comment 'Categorias'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
