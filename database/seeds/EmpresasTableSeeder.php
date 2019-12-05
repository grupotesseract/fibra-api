<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

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
                            $materiaisIds = \App\Models\Material::all()->random(10)->pluck('id');
                            $planta->itens()->saveMany(
                                factory(\App\Models\Item::class, 5)->create()->each(
                                    function ($item) use ($materiaisIds) {
                                        foreach ($materiaisIds as $materialId) {
                                            $qtdeInstalada = rand(20, 100);
                                            $item->materiais()->attach($materialId, ['quantidade_instalada' => $qtdeInstalada]);
                                        }
                                    }
                                )
                            );
                            $planta->programacoes()->saveMany(
                                factory(App\Models\Programacao::class, 1)->create()->each(
                                    function ($programacao) use ($materiaisIds, $planta) {
                                        foreach ($materiaisIds as $materialId) {
                                            $qtdeEntrada = rand(0, 10);
                                            $qtdeSubstituida = rand(0, 5);
                                            $qtdeInicialEstoque = rand(15, 30);

                                            \App\Models\EntradaMaterial::create(
                                                [
                                                    'programacao_id' => $programacao->id,
                                                    'material_id' => $materialId,
                                                    'quantidade' => $qtdeEntrada,
                                                ]
                                            );

                                            $timestamp = mt_rand(1, time());
                                            $randomDate = date('Y-m-d H:i:s', $timestamp);
                                            \App\Models\QuantidadeSubstituida::create(
                                                [
                                                    'programacao_id' => $programacao->id,
                                                    'quantidade_substituida' => $qtdeSubstituida,
                                                    'material_id' => $materialId,
                                                    'data_manutencao' => $randomDate,
                                                    'item_id' => $planta->itens->random(1)->first()->id,
                                                ]
                                            );

                                            \App\Models\Estoque::create(
                                                [
                                                    'programacao_id' => $programacao->id,
                                                    'material_id' => $materialId,
                                                    'quantidade_inicial' => $qtdeInicialEstoque,
                                                    'quantidade_final' => $qtdeInicialEstoque + $qtdeEntrada - $qtdeSubstituida,
                                                ]
                                            );
                                        }
                                    }
                                )
                            );

                            foreach ($materiaisIds as $materialId) {
                                \App\Models\QuantidadeMinima::create(
                                    [
                                        'planta_id' => $planta->id,
                                        'material_id' => $materialId,
                                        'quantidade_minima' => rand(50, 100),
                                    ]
                                );
                            }
                        }
                    )
                );
            }
        );
    }
}
