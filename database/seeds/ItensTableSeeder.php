<?php

use Illuminate\Database\Seeder;

class ItensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Item::class, 100)->create();
    }
}
