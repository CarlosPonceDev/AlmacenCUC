<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInventoryView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_inventory AS
        (SELECT 
            p.id,
            p.description,
            (
                SELECT c.description
                FROM categories c
                WHERE c.id = p.category_id
            ) AS category,
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
                        WHERE name LIKE '%cucosta%'
                    )
                ) -
                (
                    SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                    FROM exits ex
                    WHERE ex.product_id = p.id
                )
            ) AS cuc,
            (
                (
                    SELECT IF(IFNULL(SUM(en.quantity), 0) = 0, 0, SUM(en.quantity))
                    FROM entries en
                    WHERE en.product_id = p.id
                        AND en.place_id = (
                        SELECT pl.id
                        FROM places pl
                        WHERE name LIKE '%tomatlan%'
                    )
                ) +
                (
                    SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                    FROM exits ex
                    WHERE ex.product_id = p.id
                        AND ex.place_id = (
                        SELECT pl.id
                        FROM places pl
                        WHERE name LIKE '%tomatlan%'
                    )
                )
            ) AS tomatlan,
            (
                (
                    SELECT IF(IFNULL(SUM(en.quantity), 0) = 0, 0, SUM(en.quantity))
                    FROM entries en
                    WHERE en.product_id = p.id
                        AND en.place_id = (
                        SELECT pl.id
                        FROM places pl
                        WHERE name LIKE '%estacion-groumet%'
                    )
                ) +
                (
                    SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                    FROM exits ex
                    WHERE ex.product_id = p.id
                        AND ex.place_id = (
                        SELECT pl.id
                        FROM places pl
                        WHERE name LIKE '%estacion-groumet%'
                    )
                )
            ) AS gourmet,
            (
                SELECT IF(IFNULL(SUM(en.quantity), 0) = 0, 0, SUM(en.quantity))
                FROM entries en
                WHERE en.product_id = p.id
                    AND en.place_id = (
                        SELECT pl.id
                        FROM places pl
                        WHERE name LIKE '%cucosta%'
                    )
            ) AS entries,
            (
                SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                FROM exits ex
                WHERE ex.product_id = p.id
            ) AS exits,
            (
                SELECT i.initial_stock
                FROM inventory i
                WHERE i.product_id = p.id
            ) AS initial_stock
        FROM products p)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_inventory;");
    }
}
