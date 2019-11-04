<?php

use Illuminate\Database\Seeder;

class QuantidadesSubstituidasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\QuantidadeSubstituida::class, 100)->create();
    }
}
