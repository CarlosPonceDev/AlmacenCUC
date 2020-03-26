<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class MigarteEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the employees from the old database to the new database';

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
        $insertar_departamentos = [];
        $department = null;

        $personals = $old->table('tbl_empleados')->get();

        $i = 1;

        foreach ($personals as $personal) {
            $department = $mysql->table('departments')->where('description', $personal->departamento)->first();
            if (!$department) {
                $department_id = $mysql->table('departments')->insertGetId([
                    'name'          => replaceSpecialCharacters($personal->departamento),
                    'description'   => $personal->departamento,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ]);
            } else {
                $department_id = $department->id;
            }
            if (!$mysql->table('employees')->where('name', $personal->nombre_empleado)->first()) {
                $insertar[] = [
                    'name'          => $personal->nombre_empleado,
                    'department_id' => $department_id,
                    'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at'    => Carbon::now()->format('Y-m-d H:i:s')
                ];
            }
        }
        $mysql->table('departments')->insert($insertar_departamentos);
        $mysql->table('employees')->insert($insertar);
    }
}
