<?php

use Illuminate\Database\Seeder;

class PotenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Potencia::class, 10)->create();
    }
}
