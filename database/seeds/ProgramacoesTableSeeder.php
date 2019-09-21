<?php

use Illuminate\Database\Seeder;

class ProgramacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Programacao::class, 30)->create();
    }
}
