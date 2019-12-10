<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComentarioAPIRequest;
use App\Http\Requests\API\UpdateComentarioAPIRequest;
use App\Models\Comentario;
use App\Repositories\ComentarioRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ComentarioController
 * @package App\Http\Controllers\API
 */

class ComentarioAPIController extends AppBaseController
{
    /** @var  ComentarioRepository */
    private $comentarioRepository;

    public function __construct(ComentarioRepository $comentarioRepo)
    {
        $this->comentarioRepository = $comentarioRepo;
    }

    /**
     * Display a listing of the Comentario.
     * GET|HEAD /comentarios
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $comentarios = $this->comentarioRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($comentarios->toArray(), 'Listagem de Comentarios obtida com sucesso');
    }

    /**
     * Store a newly created Comentario in storage.
     * POST /comentarios
     *
     * @param CreateComentarioAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateComentarioAPIRequest $request)
    {
        $input = $request->all();

        $comentario = $this->comentarioRepository->create($input);

        return $this->sendResponse($comentario->toArray(), 'Comentario salvo com sucesso');
    }

    /**
     * Display the specified Comentario.
     * GET|HEAD /comentarios/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Comentario $comentario */
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            return $this->sendError('Comentario não encontrado');
        }

        return $this->sendResponse($comentario->toArray(), 'Comentario obtido com sucesso');
    }

    /**
     * Update the specified Comentario in storage.
     * PUT/PATCH /comentarios/{id}
     *
     * @param int $id
     * @param UpdateComentarioAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComentarioAPIRequest $request)
    {
        $input = $request->all();

        /** @var Comentario $comentario */
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            return $this->sendError('Comentario não encontrado');
        }

        $comentario = $this->comentarioRepository->update($input, $id);

        return $this->sendResponse($comentario->toArray(), 'Comentario atualizado com sucesso');
    }

    /**
     * Remove the specified Comentario from storage.
     * DELETE /comentarios/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Comentario $comentario */
        $comentario = $this->comentarioRepository->find($id);

        if (empty($comentario)) {
            return $this->sendError('Comentario não encontrado');
        }

        $comentario->delete();

        return $this->sendSuccess('Comentario removido com sucesso');
    }
}
