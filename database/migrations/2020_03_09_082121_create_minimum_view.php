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
        (SELECT
            p.id,
            p.description,
            CONCAT(
                (
                    SELECT ca.prefix
                    FROM categories ca
                    WHERE ca.id = p.category_id
                ), 
                p.code
            ) AS code,
            (
                SELECT i.minimum
                FROM inventory i
                WHERE i.product_id = p.id
            ) AS minimum,
            (
                (
                    SELECT i.initial_stock
                    FROM inventory i
                    WHERE i.product_id = p.id
                ) +
                (
                    SELECT IF(IFNULL(SUM(en.quantity), 0) = 0, 0, SUM(en.quantity))
                    FROM entries en
                    WHERE en.product_id = p.id
                        AND en.place_id = (
                            SELECT pl.id
                            FROM places pl
                            WHERE name LIKE '%cuc%'
                        )
                        AND en.deleted_at IS NULL
                ) -
                (
                    SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                    FROM exits ex
                    WHERE ex.product_id = p.id
                        AND ex.deleted_at IS NULL
                )
            ) AS total
        FROM products p
        WHERE p.deleted_at IS NULL
        HAVING total < minimum)");
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
