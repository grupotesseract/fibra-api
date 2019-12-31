<?php

namespace App\Jobs;

use App\Models\RelatorioFotografico;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\RelatorioFotograficoRepository;

class GerarRelatorioFotografico implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $relatorio;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RelatorioFotografico $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RelatorioFotograficoRepository $relatorioFotosRepo)
    {
        $relatorioFotosRepo->gerarRelatorioFotos($this->relatorio);
    }
}
