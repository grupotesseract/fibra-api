<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PlantasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Planta::class, 30)->create();
    }
}
