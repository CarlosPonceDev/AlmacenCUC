<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the entries from the old database to the new database';

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

        $entradas = $old->table('tbl_entradas')->get();

        foreach ($entradas as $entrada) {
            $product = $mysql->table('products')->where('description', $entrada->descripcion_producto)->first();
            if (!$product) {
                $lost[] = [
                    'info'  => json_encode($entrada),
                    'table' => 'tbl_entradas'
                ];
            } else {
                $unit = $mysql->table('units')->where('name', replaceSpecialCharacters($entrada->unidad_entrada))->first();
                if (!$unit) {
                    $unit_id = $mysql->table('units')->insertGetId([
                        'name'          => replaceSpecialCharacters($entrada->unidad_entrada),
                        'description'   => $entrada->unidad_entrada,
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $unit_id = $unit->id;
                }

                $place_id = $mysql->table('places')->where('name', replaceSpecialCharacters($entrada->lugar))->first()->id;

                if (preg_replace('/\s+/', '', $entrada->observaciones) != '') {
                    $observation_id = $mysql->table('observations')->insertGetId([
                        'description'   => $entrada->observaciones,
                        'product_id'    => $product->id,
                        'created_at'    => Carbon::parse($entrada->fecha_entrada)->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                }

                $provider = $mysql->table('providers')->where('name', $entrada->proveedor)->first();
                if (!$provider) {
                    $provider_id = $mysql->table('providers')->insertGetId([
                        'name'          => $entrada->proveedor,
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $provider_id = $provider->id;
                }

                $insertar[] = [
                    'date'          => $entrada->fecha_entrada,
                    'quantity'      => $entrada->cantidad_entrada,
                    'bill'          => $entrada->factura,
                    'unit_id'       => $unit_id,
                    'place_id'      => $place_id,
                    'observation_id'=> $observation_id,
                    'provider_id'   => $provider_id,
                    'product_id'    => $product->id,
                    'user_id'       => $mysql->table('users')->first()->id,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }

        $mysql->table('entries')->insert($insertar);
        $mysql->table('lostrecords')->insert($lost);
    }
}
