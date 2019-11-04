<?php

use Illuminate\Database\Seeder;

class LiberacoesDocumentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\LiberacaoDocumento::class, 100)->create();
    }
}
