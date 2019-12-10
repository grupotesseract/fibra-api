<?php

namespace App\Http\Controllers;

use App\DataTables\ComentarioDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateComentarioRequest;
use App\Http\Requests\UpdateComentarioRequest;
use App\Repositories\ComentarioRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ComentarioController extends AppBaseController
{
    /** @var  ComentarioRepository */
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

        Flash::success('Comentario salvo com sucesso.');

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
            Flash::error('Comentario não encontrado');

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
            Flash::error('Comentario não encontrado');

            return redirect(route('comentarios.index'));
        }

        return view('comentarios.edit')->with('comentario', $comentario);
    }

    /**
     * Update the specified Comentario in storage.
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
            Flash::error('Comentario não encontrado');

            return redirect(route('comentarios.index'));
        }

        $comentario = $this->comentarioRepository->update($request->all(), $id);

        Flash::success('Comentario atualizado com sucesso.');

        return redirect(route('comentarios.index'));
    }

    /**
     * Remove the specified Comentario from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            Flash::error('Comentario não encontrado');

            return redirect(route('comentarios.index'));
        }

        $this->comentarioRepository->delete($id);

        Flash::success('Comentario removido com sucesso.');

        return redirect(route('comentarios.index'));
    }
}
