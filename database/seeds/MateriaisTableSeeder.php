<?php

use Illuminate\Database\Seeder;

class MateriaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Material::class, 100)->create();
    }
}
