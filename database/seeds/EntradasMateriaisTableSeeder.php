<?php

use Illuminate\Database\Seeder;

class EntradasMateriaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\EntradaMaterial::class, 50)->create();
    }
}
