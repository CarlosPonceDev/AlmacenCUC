<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateRepairs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:repairs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the repairs from the old database to the new database';

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
        
        $reparaciones = $old->table('tbl_reparaciones')->get();

        foreach ($reparaciones as $reparacion) {
            if (preg_replace('/\s+/', '', $reparacion->personal) != '') {
                $personal = $mysql->table('personals')->where('name', $reparacion->personal)->first();
                if (!$personal) {
                    $personal_id = $mysql->table('personals')->insertGetId([
                        'name'          => $reparacion->personal,
                        'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                    ]);
                } else {
                    $personal_id = $personal->id;
                }
            } else {
                $personal_id = $mysql->table('personals')->where('name', 'Ninguno')->first()->id;
            }

            $business = $mysql->table('businesses')->where('name', $reparacion->empresa)->first();
            if (!$business) {
                $business_id = $mysql->table('businesses')->insertGetId([
                    'name'          => $reparacion->empresa,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            } else {
                $business_id = $business->id;
            }

            $insertar[] = [
                'description'   => $reparacion->descripcion_reparacion,
                'product_id'    => $reparacion->id_producto,
                'reason'        => $reparacion->motivo,
                'exit_date'     => $reparacion->fecha_salida,
                'delivery_date' => $reparacion->fecha_entrega,
                'personal_id'   => $personal_id,
                'business_id'   => $business_id,
                'user_id'       => $mysql->table('users')->first()->id,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }

        $mysql->table('repairs')->insert($insertar);
    }
}
