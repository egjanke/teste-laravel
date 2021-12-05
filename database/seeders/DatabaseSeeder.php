<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\States;
use Database\Seeders\Categories;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(States::class);
        $this->call(Categories::class);
    }
}
