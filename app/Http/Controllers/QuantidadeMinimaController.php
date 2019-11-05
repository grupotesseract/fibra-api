<?php

namespace App\Http\Controllers;

use App\DataTables\QuantidadeMinimaDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateQuantidadeMinimaRequest;
use App\Http\Requests\UpdateQuantidadeMinimaRequest;
use App\Repositories\QuantidadeMinimaRepository;
use Flash;
use Response;

class QuantidadeMinimaController extends AppBaseController
{
    /** @var QuantidadeMinimaRepository */
    private $quantidadeMinimaRepository;

    public function __construct(QuantidadeMinimaRepository $quantidadeMinimaRepo)
    {
        $this->quantidadeMinimaRepository = $quantidadeMinimaRepo;
    }

    /**
     * Display a listing of the QuantidadeMinima.
     *
     * @param QuantidadeMinimaDataTable $quantidadeMinimaDataTable
     * @return Response
     */
    public function index(QuantidadeMinimaDataTable $quantidadeMinimaDataTable)
    {
        return $quantidadeMinimaDataTable->render('quantidades_minimas.index');
    }

    /**
     * Show the form for creating a new QuantidadeMinima.
     *
     * @return Response
     */
    public function create()
    {
        return view('quantidades_minimas.create');
    }

    /**
     * Store a newly created QuantidadeMinima in storage.
     *
     * @param CreateQuantidadeMinimaRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantidadeMinimaRequest $request)
    {
        $input = $request->all();

        $quantidadeMinima = $this->quantidadeMinimaRepository->create($input);

        Flash::success('Quantidade Minima salva com sucesso.');

        return redirect(route('plantas.quantidadesMinimas', $quantidadeMinima->planta_id));
    }

    /**
     * Display the specified QuantidadeMinima.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            Flash::error('Quantidade Minima não encontrada');

            return redirect(route('quantidadesMinimas.index'));
        }

        return view('quantidades_minimas.show')->with('quantidadeMinima', $quantidadeMinima);
    }

    /**
     * Show the form for editing the specified QuantidadeMinima.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            Flash::error('Quantidade Minima não encontrada');

            return redirect(route('quantidadesMinimas.index'));
        }

        return view('quantidades_minimas.edit')->with('quantidadeMinima', $quantidadeMinima);
    }

    /**
     * Update the specified QuantidadeMinima in storage.
     *
     * @param  int              $id
     * @param UpdateQuantidadeMinimaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuantidadeMinimaRequest $request)
    {
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            Flash::error('Quantidade Minima não encontrada');

            return redirect(route('quantidadesMinimas.index'));
        }

        $quantidadeMinima = $this->quantidadeMinimaRepository->update($request->all(), $id);

        Flash::success('Quantidade Minima atualizada com sucesso.');

        return redirect(route('plantas.quantidadesMinimas', $quantidadeMinima->planta_id));
    }

    /**
     * Remove the specified QuantidadeMinima from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quantidadeMinima = $this->quantidadeMinimaRepository->find($id);

        if (empty($quantidadeMinima)) {
            Flash::error('Quantidade Minima não encontrada');

            return redirect(route('quantidadesMinimas.index'));
        }

        $this->quantidadeMinimaRepository->delete($id);

        Flash::success('Quantidade Minima excluída com sucesso.');

        return redirect(route('plantas.quantidadesMinimas', $quantidadeMinima->planta_id));
    }
}
