<?php

use Illuminate\Database\Seeder;

class QuantidadesMinimasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\QuantidadeMinima::class, 100)->create();
    }
}
