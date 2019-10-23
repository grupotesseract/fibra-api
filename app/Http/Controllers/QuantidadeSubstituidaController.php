<?php

namespace App\Http\Controllers;

use App\DataTables\QuantidadeSubstituidaDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateQuantidadeSubstituidaRequest;
use App\Http\Requests\UpdateQuantidadeSubstituidaRequest;
use App\Repositories\QuantidadeSubstituidaRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class QuantidadeSubstituidaController extends AppBaseController
{
    /** @var  QuantidadeSubstituidaRepository */
    private $quantidadeSubstituidaRepository;

    public function __construct(QuantidadeSubstituidaRepository $quantidadeSubstituidaRepo)
    {
        $this->quantidadeSubstituidaRepository = $quantidadeSubstituidaRepo;
    }

    /**
     * Display a listing of the QuantidadeSubstituida.
     *
     * @param QuantidadeSubstituidaDataTable $quantidadeSubstituidaDataTable
     * @return Response
     */
    public function index(QuantidadeSubstituidaDataTable $quantidadeSubstituidaDataTable)
    {
        return $quantidadeSubstituidaDataTable->render('quantidades_substituidas.index');
    }

    /**
     * Show the form for creating a new QuantidadeSubstituida.
     *
     * @return Response
     */
    public function create()
    {
        return view('quantidades_substituidas.create');
    }

    /**
     * Store a newly created QuantidadeSubstituida in storage.
     *
     * @param CreateQuantidadeSubstituidaRequest $request
     *
     * @return Response
     */
    public function store(CreateQuantidadeSubstituidaRequest $request)
    {
        $input = $request->all();

        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->create($input);

        Flash::success('Quantidade Substituida salva com sucesso.');

        return redirect(route('quantidadesSubstituidas.index'));
    }

    /**
     * Display the specified QuantidadeSubstituida.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            Flash::error('Quantidade Substituida não encontrada');

            return redirect(route('quantidadesSubstituidas.index'));
        }

        return view('quantidades_substituidas.show')->with('quantidadeSubstituida', $quantidadeSubstituida);
    }

    /**
     * Show the form for editing the specified QuantidadeSubstituida.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            Flash::error('Quantidade Substituida não encontrada');

            return redirect(route('quantidadesSubstituidas.index'));
        }

        return view('quantidades_substituidas.edit')->with('quantidadeSubstituida', $quantidadeSubstituida);
    }

    /**
     * Update the specified QuantidadeSubstituida in storage.
     *
     * @param  int              $id
     * @param UpdateQuantidadeSubstituidaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuantidadeSubstituidaRequest $request)
    {
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            Flash::error('Quantidade Substituida não encontrada');

            return redirect(route('quantidadesSubstituidas.index'));
        }

        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->update($request->all(), $id);

        Flash::success('Quantidade Substituida atualizada com sucesso.');

        return redirect(route('quantidadesSubstituidas.index'));
    }

    /**
     * Remove the specified QuantidadeSubstituida from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $quantidadeSubstituida = $this->quantidadeSubstituidaRepository->find($id);

        if (empty($quantidadeSubstituida)) {
            Flash::error('Quantidade Substituida não encontrada');

            return redirect(route('quantidadesSubstituidas.index'));
        }

        $this->quantidadeSubstituidaRepository->delete($id);

        Flash::success('Quantidade Substituida excluída com sucesso.');

        return redirect(route('quantidadesSubstituidas.index'));
    }
}
