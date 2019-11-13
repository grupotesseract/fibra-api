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
        factory(App\Models\Planta::class, 15)->create()->each(
            function ($planta) {
                $planta->itens()->saveMany(
                    factory(\App\Models\Item::class, 20)->create()->each(
                        function ($item) {
                            $materiaisIds = \App\Models\Material::all()->random(10)->pluck('id');
                            
                            foreach ($materiaisIds as $materialId) {
                                $qtdeInstalada = rand(20, 100);
                                $item->materiais()->attach($materialId, ['quantidade_instalada' => $qtdeInstalada]);
                            }
                        }
                    )
                );
            }
        ); 
    }
}
