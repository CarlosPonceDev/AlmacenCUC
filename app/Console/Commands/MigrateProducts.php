<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the products from the old database to the new database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mysql = DB::connection('mysql');
        $old = DB::connection('old');
        $insertar = [];
        $insertar_inventario = [];
        $lost = [];
        $unit_id = null;

        $inventario = $old->table('tbl_inventario')->get();

        $categorias = [];
        $categories = $mysql->table('categories')->get();
        foreach ($categories as $category) {
            $categorias[$category->prefix] = $category->id;
        }
        $i = 1;
        foreach ($inventario as $producto) {
            if (preg_replace('/\s+/', '', $producto->unidad) != '') {
                $unit = $mysql->table('units')->where('name', replaceSpecialCharacters($producto->unidad))->first();
                if (!$unit) {
                    $unit_id = $mysql->table('units')->insertGetId([
                        'name'          => replaceSpecialCharacters($producto->unidad),
                        'description'   => htmlspecialchars($producto->unidad),
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $unit_id = $unit->id;
                }
            }
            if (array_key_exists($producto->descripcion_producto, $insertar)) {
                $lost[] = [
                    'info'  => json_encode($producto),
                    'table' => 'tbl_inventario'
                ];
            } else {
                $insertar[$producto->descripcion_producto] = [
                    'code'          => substr($producto->codigo_producto, 1),
                    'description'   => htmlspecialchars($producto->descripcion_producto),
                    'unit_id'       => $unit_id,
                    'category_id'   => $categorias[substr($producto->codigo_producto, 0, 1)],
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $insertar_inventario[] = [
                    'initial_stock'     => $producto->stock_inicial,
                    'minimum'           => $producto->minima,
                    'product_id'        => $i,
                    'created_at'        => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'        => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $i++;
            }
        }
        $insertar = array_values($insertar);
        $mysql->table('lostrecords')->insert($lost);
        $mysql->table('products')->insert($insertar);
        $mysql->table('inventory')->insert($insertar_inventario);
    }
}
