<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateUsuarioLiberacaoAPIRequest;
use App\Http\Requests\API\UpdateUsuarioLiberacaoAPIRequest;
use App\Models\UsuarioLiberacao;
use App\Repositories\UsuarioLiberacaoRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class UsuarioLiberacaoController.
 */
class UsuarioLiberacaoAPIController extends AppBaseController
{
    /** @var UsuarioLiberacaoRepository */
    private $usuarioLiberacaoRepository;

    public function __construct(UsuarioLiberacaoRepository $usuarioLiberacaoRepo)
    {
        $this->usuarioLiberacaoRepository = $usuarioLiberacaoRepo;
    }

    /**
     * Display a listing of the UsuarioLiberacao.
     * GET|HEAD /usuariosLiberacoes.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $usuariosLiberacoes = $this->usuarioLiberacaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($usuariosLiberacoes->toArray(), 'Colaboradores listados com sucesso');
    }

    /**
     * Store a newly created UsuarioLiberacao in storage.
     * POST /usuariosLiberacoes.
     *
     * @param CreateUsuarioLiberacaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioLiberacaoAPIRequest $request)
    {
        $input = $request->all();

        $usuarioLiberacao = $this->usuarioLiberacaoRepository->create($input);

        return $this->sendResponse($usuarioLiberacao->toArray(), 'Colaborador salvo com sucesso');
    }

    /**
     * Display the specified UsuarioLiberacao.
     * GET|HEAD /usuariosLiberacoes/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var UsuarioLiberacao $usuarioLiberacao */
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            return $this->sendError('Colaborador não encontrado');
        }

        return $this->sendResponse($usuarioLiberacao->toArray(), 'Colaborador listado com sucesso');
    }

    /**
     * Update the specified UsuarioLiberacao in storage.
     * PUT/PATCH /usuariosLiberacoes/{id}.
     *
     * @param int $id
     * @param UpdateUsuarioLiberacaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioLiberacaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var UsuarioLiberacao $usuarioLiberacao */
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            return $this->sendError('Colaborador não encontrado');
        }

        $usuarioLiberacao = $this->usuarioLiberacaoRepository->update($input, $id);

        return $this->sendResponse($usuarioLiberacao->toArray(), 'Colaborador atualizado com sucesso');
    }

    /**
     * Remove the specified UsuarioLiberacao from storage.
     * DELETE /usuariosLiberacoes/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var UsuarioLiberacao $usuarioLiberacao */
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            return $this->sendError('Colaborador não encontrado');
        }

        $usuarioLiberacao->delete();

        return $this->sendResponse($id, 'Colaborador excluído com sucesso');
    }
}
