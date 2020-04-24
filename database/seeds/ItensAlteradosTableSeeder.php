<?php

use Illuminate\Database\Seeder;

class ItensAlteradosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\ItemAlterado::class, 100)->create();
    }
}
