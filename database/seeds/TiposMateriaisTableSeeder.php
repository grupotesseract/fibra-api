<?php

use Illuminate\Database\Seeder;

class TiposMateriaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\TipoMaterial::class, 50)->create();
    }
}
