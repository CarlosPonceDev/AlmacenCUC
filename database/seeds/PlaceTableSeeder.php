<?php

use App\Place;
use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place_name = 'CUCOSTA';
        $place = new Place();
        $place->name = replaceSpecialCharacters($place_name);
        $place->description = $place_name;
        $place->save();

        $place_name = 'Tomatlán';
        $place = new Place();
        $place->name = replaceSpecialCharacters($place_name);
        $place->description = $place_name;
        $place->save();

        $place_name = 'Estación Gourmet';
        $place = new Place();
        $place->name = replaceSpecialCharacters($place_name);
        $place->description = $place_name;
        $place->save();

        $place_name = 'Otros';
        $place = new Place();
        $place->name = replaceSpecialCharacters($place_name);
        $place->description = $place_name;
        $place->save();
    }
}
