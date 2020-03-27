<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUsuarioManutencaoAPIRequest;
use App\Http\Requests\API\UpdateUsuarioManutencaoAPIRequest;
use App\Models\UsuarioManutencao;
use App\Repositories\UsuarioManutencaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class UsuarioManutencaoController
 * @package App\Http\Controllers\API
 */

class UsuarioManutencaoAPIController extends AppBaseController
{
    /** @var  UsuarioManutencaoRepository */
    private $usuarioManutencaoRepository;

    public function __construct(UsuarioManutencaoRepository $usuarioManutencaoRepo)
    {
        $this->usuarioManutencaoRepository = $usuarioManutencaoRepo;
    }

    /**
     * Display a listing of the UsuarioManutencao.
     * GET|HEAD /usuariosManutencoes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $usuariosManutencoes = $this->usuarioManutencaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($usuariosManutencoes->toArray(), 'Usuarios Manutencoes listados com sucesso');
    }

    /**
     * Store a newly created UsuarioManutencao in storage.
     * POST /usuariosManutencoes
     *
     * @param CreateUsuarioManutencaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioManutencaoAPIRequest $request)
    {
        $input = $request->all();

        $usuarioManutencao = $this->usuarioManutencaoRepository->create($input);

        return $this->sendResponse($usuarioManutencao->toArray(), 'Usuario Manutencao salvo com sucesso');
    }

    /**
     * Display the specified UsuarioManutencao.
     * GET|HEAD /usuariosManutencoes/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UsuarioManutencao $usuarioManutencao */
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            return $this->sendError('Usuario Manutencao não encontrado');
        }

        return $this->sendResponse($usuarioManutencao->toArray(), 'Usuario Manutencao listado com sucesso');
    }

    /**
     * Update the specified UsuarioManutencao in storage.
     * PUT/PATCH /usuariosManutencoes/{id}
     *
     * @param int $id
     * @param UpdateUsuarioManutencaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioManutencaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var UsuarioManutencao $usuarioManutencao */
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            return $this->sendError('Usuario Manutencao não encontrado');
        }

        $usuarioManutencao = $this->usuarioManutencaoRepository->update($input, $id);

        return $this->sendResponse($usuarioManutencao->toArray(), 'Usuario Manutencao atualizado com sucesso');
    }

    /**
     * Remove the specified UsuarioManutencao from storage.
     * DELETE /usuariosManutencoes/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UsuarioManutencao $usuarioManutencao */
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            return $this->sendError('Usuario Manutencao não encontrado');
        }

        $usuarioManutencao->delete();

        return $this->sendSuccess('Usuario Manutencao excluído com sucesso');
    }
}
