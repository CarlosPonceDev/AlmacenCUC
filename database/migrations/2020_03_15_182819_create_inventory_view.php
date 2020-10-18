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
            CONCAT(
                (
                    SELECT ca.prefix
                    FROM categories ca
                    WHERE ca.id = p.category_id
                ), 
                p.code
            ) AS code,
            (
                SELECT c.description
                FROM categories c
                WHERE c.id = p.category_id
            ) AS category,
            (
                (
                    SELECT i.initial_stock
                    FROM inventory i
                    WHERE i.id = p.inventory_id
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
                        AND en.deleted_at IS NULL
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
                        AND ex.deleted_at IS NULL
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
                        AND en.deleted_at IS NULL
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
                        AND ex.deleted_at IS NULL
                )
            ) AS gourmet,
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
            ) AS entries,
            (
                SELECT IF(IFNULL(SUM(ex.quantity), 0) = 0, 0, SUM(ex.quantity))
                FROM exits ex
                WHERE ex.product_id = p.id
                    AND ex.deleted_at IS NULL
            ) AS exits,
            (
                SELECT i.initial_stock
                FROM inventory i
                WHERE i.id = p.inventory_id
            ) AS initial_stock
        FROM products p
        WHERE p.deleted_at IS NULL)");
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
