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
        $category->icon = 'fan';
        $category->save();
        
        $category_name = 'Electricidad';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'E';
        $category->icon = 'bolt';
        $category->save();
        
        $category_name = 'Fontanería';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'F';
        $category->icon = 'toilet-paper';
        $category->save();
        
        $category_name = 'General';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'G';
        $category->icon = 'cog';
        $category->save();
        
        $category_name = 'Herramienta';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'H';
        $category->icon = 'tools';
        $category->save();
        
        $category_name = 'Jardinería';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'J';
        $category->icon = 'oil-can';
        $category->save();
        
        $category_name = 'Limpieza';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'L';
        $category->icon = 'broom';
        $category->save();
        
        $category_name = 'Pintura';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'P';
        $category->icon = 'brush';
        $category->save();
        
        $category_name = 'Equipo de servicio';
        $category = new Category();
        $category->name = replaceSpecialCharacters($category_name);
        $category->description = $category_name;
        $category->prefix = 'S';
        $category->icon = 'people-carry';
        $category->save();
    }
}
