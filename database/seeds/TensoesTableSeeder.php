<?php

use Illuminate\Database\Seeder;

class TensoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Tensao::class, 10)->create();
    }
}
