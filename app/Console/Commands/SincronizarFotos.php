<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SincronizarFotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fibra:sincronizarFotos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza as fotos com o Cloudinary, removendo os arquivos locais';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** Envio das fotos representadas pelo App\Models\Foto **/
        $fotoRepository = new \App\Repositories\FotoRepository(app());
        $fotosLocais = $fotoRepository->model()::whereNull('cloudinary_id')->get();

        \Log::info('[SincronizaFotos] Fotos para enviar: '.$fotosLocais->count());

        $fotosLocais->each(function ($Foto) use ($fotoRepository) {
            $ambiente = \App::environment();
            $pathCloudinary = "$ambiente/$Foto->pathCloudinary";

            $enviou = $fotoRepository->enviarCloudinary($Foto, $Foto->id, $pathCloudinary);
            if ($enviou) {
                $fotoRepository->deleteLocal($Foto->id);
            }
        });



        /** Envio das fotos representadas pelo App\Models\FotoRdo **/
        $fotoRdoRepository = new \App\Repositories\FotoRdoRepository(app());
        $fotoRdosLocais = $fotoRdoRepository->model()::whereNull('cloudinary_id')->get();

        \Log::info('[SincronizaFotoRdos] FotoRdos para enviar: '.$fotoRdosLocais->count());
        $fotoRdosLocais->each(function ($FotoRdo) use ($fotoRdoRepository) {
            $ambiente = \App::environment();
            $pathCloudinary = "$ambiente/$FotoRdo->pathCloudinary";

            $enviou = $fotoRdoRepository->enviarCloudinary($FotoRdo, $FotoRdo->id, $pathCloudinary);
            if ($enviou) {
                $fotoRdoRepository->deleteLocal($FotoRdo->id);
            }
        });
    }
}
