<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Diamante', 'description' => 'Clientes categoria diamante'],
            ['name' => 'Ouro', 'description' => 'Clientes categoria ouro'],
            ['name' => 'Prata', 'description' => 'Clientes categoria prata'],
            ['name' => 'Bronze', 'description' => 'Clientes categoria bronze']
        ];
        foreach ($categories as $category){
            Category::updateOrCreate($category);
        }
    }
}
