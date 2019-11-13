<?php

use Illuminate\Database\Seeder;

class EmpresasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Empresa::class, 15)->create()->each(
            function ($empresa) {
                $empresa->plantas()->saveMany(
                    factory(App\Models\Planta::class, 1)->create()->each(
                        function ($planta) {
                            $planta->itens()->saveMany(
                                factory(\App\Models\Item::class, 5)->create()->each(
                                    function ($item) {
                                        $materiaisIds = \App\Models\Material::all()->random(10)->pluck('id');
                                        
                                        foreach ($materiaisIds as $materialId) {
                                            $qtdeInstalada = rand(20, 100);
                                            $item->materiais()->attach($materialId, ['quantidade_instalada' => $qtdeInstalada]);
                                        }
                                    }
                                )
                            );
                            $planta->programacoes()->saveMany(
                                factory(App\Models\Programacao::class, 1)->create()
                            );
                        }
                    ) 
                );
            }
        );
    }
}
