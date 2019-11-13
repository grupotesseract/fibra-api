<?php

use Illuminate\Database\Seeder;

class PlantasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Planta::class, 15)->create()->each(function ($planta) {
            $planta->itens()->saveMany(factory(\App\Models\Item::class, 20)->create());
        }); 
    }
}
