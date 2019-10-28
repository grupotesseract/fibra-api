<?php

namespace App\Http\Controllers\API;

use Response;
use App\Models\Estoque;
use Illuminate\Http\Request;
use App\Repositories\EstoqueRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProgramacaoRepository;
use App\Http\Requests\API\CreateEstoqueAPIRequest;
use App\Http\Requests\API\UpdateEstoqueAPIRequest;

/**
 * Class EstoqueController.
 */
class EstoqueAPIController extends AppBaseController
{
    /** @var EstoqueRepository */
    private $estoqueRepository;

    /** @var ProgramacaoRepository */
    private $programacaoRepository;

    public function __construct(EstoqueRepository $estoqueRepo, ProgramacaoRepository $programacaoRepo)
    {
        $this->estoqueRepository = $estoqueRepo;
        $this->programacaoRepository = $programacaoRepo;
    }

    /**
     * Display a listing of the Estoque.
     * GET|HEAD /estoque.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $estoque = $this->estoqueRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($estoque->toArray(), 'Listagem de estoques obtida com sucesso');
    }

    /**
     * Store a newly created Estoque in storage.
     * POST /estoque.
     *
     * @param CreateEstoqueAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEstoqueAPIRequest $request)
    {
        $input = $request->all();

        $programacao = $this->programacaoRepository->find($request->programacao_id);

        //Se ja tiver estoque para esse mateiral, erro.
        $jaExisteEstoque = $programacao->estoques()
           ->where('material_id', $request->material_id)
           ->count();

        if ($jaExisteEstoque) {
            return \Response::json([
                'errors' => ['Já existe um estoque para o material selecionado'],
            ], 422);
        }

        $estoque = $this->estoqueRepository->create($input);

        return $this->sendResponse($estoque->toArray(), 'Estoque criado com sucesso');
    }

    /**
     * Display the specified Estoque.
     * GET|HEAD /estoque/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque não encontrado');
        }

        return $this->sendResponse($estoque->toArray(), 'Estoque obtido com sucesso');
    }

    /**
     * Update the specified Estoque in storage.
     * PUT/PATCH /estoque/{id}.
     *
     * @param int $id
     * @param UpdateEstoqueAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEstoqueAPIRequest $request)
    {
        $input = $request->all();

        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque não encontrado');
        }

        $estoque = $this->estoqueRepository->update($input, $id);

        return $this->sendResponse($estoque->toArray(), 'Estoque atualizado com sucesso');
    }

    /**
     * Remove the specified Estoque from storage.
     * DELETE /estoque/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Estoque $estoque */
        $estoque = $this->estoqueRepository->find($id);

        if (empty($estoque)) {
            return $this->sendError('Estoque não encontrado');
        }

        $estoque->delete();

        return $this->sendResponse($id, 'Estoque removido com sucesso');
    }
}
