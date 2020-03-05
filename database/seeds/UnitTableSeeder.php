<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_name = 'Litro(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Kilo(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Metro(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Pieza(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Rollo(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Tramo(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
    }
}
