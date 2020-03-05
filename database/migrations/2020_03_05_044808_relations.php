<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entries', function (Blueprint $table)
        {
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('observation_id')->references('id')->on('observations');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('exits', function (Blueprint $table)
        {
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('place_id')->references('id')->on('places');
            $table->foreign('observation_id')->references('id')->on('observations');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('observations', function (Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::table('employees', function (Blueprint $table)
        {
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::table('inventory', function (Blueprint $table)
        {
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entries', function (Blueprint $table)
        {
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['place_id']);
            $table->dropForeign(['observation_id']);
            $table->dropForeign(['provider_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('exits', function (Blueprint $table)
        {
            $table->dropForeign(['unit_id']);
            $table->dropForeign(['place_id']);
            $table->dropForeign(['observation_id']);
            $table->dropForeign(['employee_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('observations', function (Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });

        Schema::table('employees', function (Blueprint $table)
        {
            $table->dropForeign(['department_id']);
        });

        Schema::table('inventory', function (Blueprint $table)
        {
            $table->dropForeign(['product_id']);
        });
    }
}
