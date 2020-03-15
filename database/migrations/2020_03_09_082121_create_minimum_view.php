<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMinimumView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW minimum AS
        (select p.id as id, p.description, i.minimum, (i.initial_stock + IF(e.place_id = 1, e.quantity, 0) - IF(ex.place_id != 1, ex.quantity, 0)) as total
        from products p INNER JOIN inventory i on i.product_id = p.id
        INNER JOIN entries e on e.product_id = p.id
        INNER JOIN exits ex on ex.product_id = p.id
        GROUP BY p.description
        HAVING total < i.minimum)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW minimum;");
    }
}
