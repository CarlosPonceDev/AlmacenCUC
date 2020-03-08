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
        
        $unit_name = 'Bidon';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Bidon 20 lt';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Bolsa(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Bote(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Bulto(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Caja(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Caja 5kg';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Cubeta(s)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Galón(es)';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Galón 4 lt';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Galón 4 lt';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Gramos';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
        
        $unit_name = 'Kilogramos';
        $unit = new Unit();
        $unit->name = replaceSpecialCharacters($unit_name);
        $unit->description = $unit_name;
        $unit->save();
    }
}
