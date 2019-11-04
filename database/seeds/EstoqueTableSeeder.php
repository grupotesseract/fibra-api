<?php

use Illuminate\Database\Seeder;

class EstoqueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Estoque::class, 20)->create();
    }
}
