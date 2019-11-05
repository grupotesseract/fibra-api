<?php

namespace App\Http\Controllers;

use App\DataTables\TensaoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateTensaoRequest;
use App\Http\Requests\UpdateTensaoRequest;
use App\Repositories\TensaoRepository;
use Flash;
use Response;

class TensaoController extends AppBaseController
{
    /** @var TensaoRepository */
    private $tensaoRepository;

    public function __construct(TensaoRepository $tensaoRepo)
    {
        $this->tensaoRepository = $tensaoRepo;
    }

    /**
     * Display a listing of the Tensao.
     *
     * @param TensaoDataTable $tensaoDataTable
     * @return Response
     */
    public function index(TensaoDataTable $tensaoDataTable)
    {
        return $tensaoDataTable->render('tensoes.index');
    }

    /**
     * Show the form for creating a new Tensao.
     *
     * @return Response
     */
    public function create()
    {
        return view('tensoes.create');
    }

    /**
     * Store a newly created Tensao in storage.
     *
     * @param CreateTensaoRequest $request
     *
     * @return Response
     */
    public function store(CreateTensaoRequest $request)
    {
        $input = $request->all();

        $tensao = $this->tensaoRepository->create($input);

        Flash::success('Tensão salva com sucesso');

        return redirect(route('tensoes.index'));
    }

    /**
     * Display the specified Tensao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            Flash::error('Tensão não encontrada');

            return redirect(route('tensoes.index'));
        }

        return view('tensoes.show')->with('tensao', $tensao);
    }

    /**
     * Show the form for editing the specified Tensao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            Flash::error('Tensão não encontrada');

            return redirect(route('tensoes.index'));
        }

        return view('tensoes.edit')->with('tensao', $tensao);
    }

    /**
     * Update the specified Tensao in storage.
     *
     * @param  int              $id
     * @param UpdateTensaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTensaoRequest $request)
    {
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            Flash::error('Tensão não encontrada');

            return redirect(route('tensoes.index'));
        }

        $tensao = $this->tensaoRepository->update($request->all(), $id);

        Flash::success('Tensão atualizada com sucesso');

        return redirect(route('tensoes.index'));
    }

    /**
     * Remove the specified Tensao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tensao = $this->tensaoRepository->find($id);

        if (empty($tensao)) {
            Flash::error('Tensão não encontrada');

            return redirect(route('tensoes.index'));
        }

        $this->tensaoRepository->delete($id);

        Flash::success('Tensão excluída com sucesso');

        return redirect(route('tensoes.index'));
    }
}
