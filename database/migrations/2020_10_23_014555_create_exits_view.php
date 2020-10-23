<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateExitsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW view_exits AS
        (SELECT 
            e.id,
            e.date,
            e.quantity,
            (
                SELECT u.description
                FROM units u
                WHERE u.id = e.unit_id
            ) AS unit,
            (
                SELECT pl.description
                FROM places pl
                WHERE pl.id = e.place_id
            ) AS place,
            (
                SELECT o.description
                FROM observations o
                WHERE o.id = e.observation_id
            ) AS observation,
            (
                SELECT em.name
                FROM employees em
                WHERE em.id = e.employee_id
            ) AS employee,
            CONCAT(
                (
                    SELECT (
                        SELECT c1.prefix
                        FROM categories c1
                        WHERE c1.id = p1.category_id
                    )
                    FROM products p1
                    WHERE p1.id = e.product_id
                ), 
                (
                    SELECT p2.code
                    FROM products p2
                    WHERE p2.id = e.product_id
                )
            ) AS code,
            (
                SELECT p3.description
                FROM products p3
                WHERE p3.id = e.product_id
            ) AS description,
            (
                SELECT u.username
                FROM users u
                WHERE u.id = e.user_id
            ) AS user
        FROM exits e
        WHERE e.deleted_at IS NULL)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW view_exits;");
    }
}
