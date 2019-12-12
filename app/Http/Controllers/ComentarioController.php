<?php

namespace App\Http\Controllers;

use App\DataTables\ComentarioDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Repositories\ComentarioRepository;
use Flash;
use Response;

class ComentarioController extends AppBaseController
{
    /** @var ComentarioRepository */
    private $comentarioRepository;

    public function __construct(ComentarioRepository $comentarioRepo)
    {
        $this->comentarioRepository = $comentarioRepo;
    }

    /**
     * Display a listing of the Comentario.
     *
     * @param ComentarioDataTable $comentarioDataTable
     * @return Response
     */
    public function index(ComentarioDataTable $comentarioDataTable)
    {
        return $comentarioDataTable->render('comentarios.index');
    }

    /**
     * Show the form for creating a new Comentario.
     *
     * @return Response
     */
    public function create()
    {
        return view('comentarios.create');
    }

    /**
     * Store a newly created Comentario in storage.
     *
     * @param CreateComentarioRequest $request
     *
     * @return Response
     */
    public function store(CreateComentarioRequest $request)
    {
        $input = $request->all();

        $comentario = $this->comentarioRepository->create($input);

        Flash::success('Comentário salvo com sucesso.');

        return redirect(route('comentarios.index'));
    }

    /**
     * Display the specified Comentario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            Flash::error('Comentário não encontrado');

            return redirect(route('comentarios.index'));
        }

        return view('comentarios.show')->with('comentario', $comentario);
    }

    /**
     * Show the form for editing the specified Comentario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            Flash::error('Comentário não encontrado');

            return redirect(route('comentarios.index'));
        }

        return view('comentarios.edit')->with('comentario', $comentario);
    }

    /**
     * Update the specified Comentário in storage.
     *
     * @param  int              $id
     * @param UpdateComentarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComentarioRequest $request)
    {
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            Flash::error('Comentário não encontrado');

            return redirect(route('comentarios.index'));
        }

        $comentario = $this->comentarioRepository->update($request->all(), $id);

        Flash::success('Comentário atualizado com sucesso.');

        return redirect(route('programacoes.comentarios', $comentario->programacao_id));
    }

    /**
     * Remove the specified Comentário from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            Flash::error('Comentário não encontrado');

            return redirect(route('comentarios.index'));
        }

        $this->comentarioRepository->delete($id);

        Flash::success('Comentário removido com sucesso.');

        return redirect(route('programacoes.comentarios', $comentario->programacao_id));
    }
}
