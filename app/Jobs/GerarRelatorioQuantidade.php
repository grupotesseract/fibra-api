<?php

namespace App\Jobs;

use App\Models\RelatorioQuantidade;
use App\Repositories\RelatorioQuantidadeRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GerarRelatorioQuantidade implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $relatorio;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(RelatorioQuantidade $relatorio)
    {
        $this->relatorio = $relatorio;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(RelatorioQuantidadeRepository $repo)
    {
        $repo->gerarArquivoRelatorio($this->relatorio);
    }
}
