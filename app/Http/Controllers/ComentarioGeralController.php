<?php

namespace App\Http\Controllers;

use App\DataTables\ComentarioGeralDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateComentarioGeralRequest;
use App\Http\Requests\UpdateComentarioGeralRequest;
use App\Repositories\ComentarioGeralRepository;
use Flash;
use Response;

class ComentarioGeralController extends AppBaseController
{
    /** @var ComentarioGeralRepository */
    private $comentarioGeralRepository;

    public function __construct(ComentarioGeralRepository $comentarioGeralRepo)
    {
        $this->comentarioGeralRepository = $comentarioGeralRepo;
    }

    /**
     * Display a listing of the ComentarioGeral.
     *
     * @param ComentarioGeralDataTable $comentarioGeralDataTable
     * @return Response
     */
    public function index(ComentarioGeralDataTable $comentarioGeralDataTable)
    {
        return $comentarioGeralDataTable->render('comentarios_gerais.index');
    }

    /**
     * Show the form for creating a new ComentarioGeral.
     *
     * @return Response
     */
    public function create()
    {
        return view('comentarios_gerais.create');
    }

    /**
     * Store a newly created ComentarioGeral in storage.
     *
     * @param CreateComentarioGeralRequest $request
     *
     * @return Response
     */
    public function store(CreateComentarioGeralRequest $request)
    {
        $input = $request->all();

        $comentarioGeral = $this->comentarioGeralRepository->create($input);

        Flash::success('Comentario Geral saved successfully.');

        return redirect(route('comentariosGerais.index'));
    }

    /**
     * Display the specified ComentarioGeral.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            Flash::error('Comentario Geral não encontrado');

            return redirect(route('comentariosGerais.index'));
        }

        return view('comentarios_gerais.show')->with('comentarioGeral', $comentarioGeral);
    }

    /**
     * Show the form for editing the specified ComentarioGeral.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            Flash::error('Comentario Geral não encontrado');

            return redirect(route('comentariosGerais.index'));
        }

        return view('comentarios_gerais.edit')->with('comentarioGeral', $comentarioGeral);
    }

    /**
     * Update the specified ComentarioGeral in storage.
     *
     * @param  int              $id
     * @param UpdateComentarioGeralRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComentarioGeralRequest $request)
    {
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            Flash::error('Comentario Geral não encontrado');

            return redirect(route('comentariosGerais.index'));
        }

        $comentarioGeral = $this->comentarioGeralRepository->update($request->all(), $id);

        Flash::success('Comentario Geral atualizado com sucesso.');

        return redirect(route('programacoes.comentariosGerais', $comentarioGeral->programacao_id));
    }

    /**
     * Remove the specified ComentarioGeral from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            Flash::error('Comentario Geral não encontrado');

            return redirect(route('comentariosGerais.index'));
        }

        $this->comentarioGeralRepository->delete($id);

        Flash::success('Comentario Geral removido com sucesso.');

        return redirect(route('programacoes.comentariosGerais', $comentarioGeral->programacao_id));
    }
}
