<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seeds que devem ser executados em production
        if (\App::environment('production')) {
            $this->call(EstadosTableSeeder::class);
            $this->call(CidadesSQLSeeder::class);
            $this->call(LaratrustSeeder::class);
            $this->call(AdminUserSeeder::class);
        } else {
            $this->call(EstadosTableSeeder::class);
            $this->call(CidadesSQLSeeder::class);
            $this->call(LaratrustSeeder::class);
            $this->call(AdminUserSeeder::class);
            $this->call(TecnicoUserSeeder::class);
            $this->call(PotenciasTableSeeder::class);
            $this->call(TensoesTableSeeder::class);
            $this->call(TiposMateriaisTableSeeder::class);
            $this->call(MateriaisTableSeeder::class);
            $this->call(EmpresasTableSeeder::class);
            $this->call(LiberacoesDocumentosTableSeeder::class);
            $this->call(UsuariosLiberacoesTableSeeder::class);
            $this->call(ManutencoesCivilEletricaTableSeeder::class);
            $this->call(UsuariosManutencoesTableSeeder::class);
            $this->call(AtividadesRealizadasTableSeeder::class);
            $this->call(ItensAlteradosTableSeeder::class);
        }
    }
}
