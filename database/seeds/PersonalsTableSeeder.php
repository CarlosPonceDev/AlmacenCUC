<?php

use App\Personal;
use Illuminate\Database\Seeder;

class PersonalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personal = new Personal();
        $personal->name = 'Ninguno';
        $personal->save();
    }
}
