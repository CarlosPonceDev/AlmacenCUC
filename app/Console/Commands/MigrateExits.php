<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateExits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:exits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the exits from the old database to the new database';

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
        $lost = [];

        $observation_id = null;

        $salidas = $old->table('tbl_salidas')->get();

        foreach ($salidas as $salida) {
            $product = $mysql->table('products')->where('description', $salida->descripcion_producto)->first();
            if (!$product) {
                $lost[] = [
                    'info'  => json_encode($salida),
                    'table' => 'tbl_salidas'
                ];
            } else {
                $unit = $mysql->table('units')->where('name', replaceSpecialCharacters($salida->unidad_salida))->first();
                if (!$unit) {
                    $unit_id = $mysql->table('units')->insertGetId([
                        'name'          => replaceSpecialCharacters($salida->unidad_salida),
                        'description'   => htmlspecialchars($salida->unidad_salida),
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $unit_id = $unit->id;
                }

                $place_id = $mysql->table('places')->where('name', replaceSpecialCharacters($salida->lugar))->first()->id;

                if (preg_replace('/\s+/', '', $salida->observaciones) != '') {
                    $observation_id = $mysql->table('observations')->insertGetId([
                        'description'   => htmlspecialchars($salida->observaciones),
                        'product_id'    => $product->id,
                        'created_at'    => Carbon::parse($salida->fecha_salida)->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }

                $employee = $mysql->table('employees')->where('name', $salida->empleado)->first();
                if (!$employee) {
                    $employee_id = $mysql->table('employees')->insertGetId([
                        'name'          => htmlspecialchars($salida->empleado),
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $employee_id = $employee->id;
                }

                $insertar[] = [
                    'date'          => $salida->fecha_salida,
                    'quantity'      => $salida->cantidad_salida,
                    'unit_id'       => $unit_id,
                    'place_id'      => $place_id,
                    'observation_id'=> $observation_id,
                    'employee_id'   => $employee_id,
                    'product_id'    => $product->id,
                    'user_id'       => $mysql->table('users')->first()->id,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }

        $mysql->table('exits')->insert($insertar);
        $mysql->table('lostrecords')->insert($lost);
    }
}
