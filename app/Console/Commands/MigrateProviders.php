<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigrateProviders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:providers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the providers from the old database to the new database';

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

        $providers = $old->table('tbl_proveedores')->get();

        foreach ($providers as $provider) {
            if (!$mysql->table('providers')->where('name', $provider->nombre_proveedor)->first()) {
                $insertar[] = [
                    'name'  => $provider->nombre_proveedor,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }
        $mysql->table('providers')->insert($insertar);
    }
}
