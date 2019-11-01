<?php

namespace App\Http\Controllers;

use App\DataTables\EstoqueDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateEstoqueRequest;
use App\Http\Requests\UpdateEstoqueRequest;
use App\Repositories\EstoqueRepository;
use Flash;
use Response;

class EstoqueController extends AppBaseController
{
    /** @var EstoqueRepository */
    private $estoqueRepository;

    public function __construct(EstoqueRepository $estoqueRepo)
    {
        $this->estoqueRepository = $estoqueRepo;
    }

    /**
     * Display a listing of the Estoque.
     *
     * @param EstoqueDataTable $estoqueDataTable
     * @return Response
     */
    public function index(EstoqueDataTable $estoqueDataTable)
    {
        return $estoqueDataTable->render('estoque.index');
    }

    /**
     * Show the form for creating a new Estoque.
     *
     * @return Response
     */
    public function create()
    {
        return view('estoque.create');
    }

    /**
     * Store a newly created Estoque in storage.
     *
     * @param CreateEstoqueRequest $request
     *
     * @return Response
     */
    public function store(CreateEstoqueRequest $request)
    {
        $input = $request->all();

        $estoque = $this->estoqueRepository->create($input);

        Flash::success('Estoque criado com sucesso.');

        return redirect(route('estoque.index'));
    }

    /**
     * Display the specified Estoque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error('Estoque não encontrado');

            return redirect(route('estoque.index'));
        }

        return view('estoque.show')->with('estoque', $estoque);
    }

    /**
     * Show the form for editing the specified Estoque.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error('Estoque não encontrado');

            return redirect(route('estoque.index'));
        }

        return view('estoque.edit')->with('estoque', $estoque);
    }

    /**
     * Update the specified Estoque in storage.
     *
     * @param  int              $id
     * @param UpdateEstoqueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstoqueRequest $request)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error('Estoque não encontrado');

            return redirect(route('estoque.index'));
        }

        $estoque = $this->estoqueRepository->update($request->all(), $id);

        Flash::success('Estoque atualizado');

        return redirect(route('programacoes.estoque', $estoque->programacao_id));
    }

    /**
     * Remove the specified Estoque from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            Flash::error('Estoque não encontrado');

            return redirect(route('estoque.index'));
        }

        $this->estoqueRepository->delete($id);

        Flash::success('Estoque removido com sucesso.');

        return redirect()->back();
    }
}
