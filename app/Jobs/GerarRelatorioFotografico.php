<?php

namespace App\Jobs;

use App\Models\Programacao;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\RelatorioFotograficoRepository;

class GerarRelatorioFotografico implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $programacao;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Programacao $programacao)
    {
        $this->programacao = $programacao;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RelatorioFotograficoRepository $relatorioFotosRepo)
    {
        \Log::info("\n## JOB GerarRelatorioFotografico disparado");
        $relatorioFotosRepo->gerarRelatorioFotos($this->programacao);
    }
}
