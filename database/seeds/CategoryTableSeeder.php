<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_name = 'Aires Acondicionados';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'A';
        $category->save();
        
        $category_name = 'Electricidad';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'E';
        $category->save();
        
        $category_name = 'Fontanería';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'F';
        $category->save();
        
        $category_name = 'General';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'G';
        $category->save();
        
        $category_name = 'Herramienta';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'H';
        $category->save();
        
        $category_name = 'Jardinería';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'J';
        $category->save();
        
        $category_name = 'Limpieza';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'L';
        $category->save();
        
        $category_name = 'Pintura';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'P';
        $category->save();
        
        $category_name = 'Equipo de servicio';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'S';
        $category->save();
    }
}
