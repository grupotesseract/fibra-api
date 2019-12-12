<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateComentarioGeralAPIRequest;
use App\Http\Requests\API\UpdateComentarioGeralAPIRequest;
use App\Models\ComentarioGeral;
use App\Repositories\ComentarioGeralRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ComentarioGeralController
 * @package App\Http\Controllers\API
 */

class ComentarioGeralAPIController extends AppBaseController
{
    /** @var  ComentarioGeralRepository */
    private $comentarioGeralRepository;

    public function __construct(ComentarioGeralRepository $comentarioGeralRepo)
    {
        $this->comentarioGeralRepository = $comentarioGeralRepo;
    }

    /**
     * Display a listing of the ComentarioGeral.
     * GET|HEAD /comentariosGerais
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $comentariosGerais = $this->comentarioGeralRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($comentariosGerais->toArray(), 'Comentarios Gerais retrieved successfully');
    }

    /**
     * Store a newly created ComentarioGeral in storage.
     * POST /comentariosGerais
     *
     * @param CreateComentarioGeralAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateComentarioGeralAPIRequest $request)
    {
        $input = $request->all();

        $comentarioGeral = $this->comentarioGeralRepository->create($input);

        return $this->sendResponse($comentarioGeral->toArray(), 'Comentario Geral saved successfully');
    }

    /**
     * Display the specified ComentarioGeral.
     * GET|HEAD /comentariosGerais/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ComentarioGeral $comentarioGeral */
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            return $this->sendError('Comentario Geral not found');
        }

        return $this->sendResponse($comentarioGeral->toArray(), 'Comentario Geral retrieved successfully');
    }

    /**
     * Update the specified ComentarioGeral in storage.
     * PUT/PATCH /comentariosGerais/{id}
     *
     * @param int $id
     * @param UpdateComentarioGeralAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateComentarioGeralAPIRequest $request)
    {
        $input = $request->all();

        /** @var ComentarioGeral $comentarioGeral */
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            return $this->sendError('Comentario Geral not found');
        }

        $comentarioGeral = $this->comentarioGeralRepository->update($input, $id);

        return $this->sendResponse($comentarioGeral->toArray(), 'ComentarioGeral updated successfully');
    }

    /**
     * Remove the specified ComentarioGeral from storage.
     * DELETE /comentariosGerais/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ComentarioGeral $comentarioGeral */
        $comentarioGeral = $this->comentarioGeralRepository->find($id);

        if (empty($comentarioGeral)) {
            return $this->sendError('Comentario Geral not found');
        }

        $comentarioGeral->delete();

        return $this->sendSuccess('Comentario Geral deleted successfully');
    }
}
