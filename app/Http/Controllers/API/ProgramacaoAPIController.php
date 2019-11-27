<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateProgramacaoAPIRequest;
use App\Http\Requests\API\UpdateProgramacaoAPIRequest;
use App\Models\Programacao;
use App\Repositories\FotoRepository;
use App\Repositories\ItemRepository;
use App\Repositories\ProgramacaoRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class ProgramacaoController.
 */
class ProgramacaoAPIController extends AppBaseController
{
    /** @var ProgramacaoRepository */
    private $programacaoRepository;
    private $fotoRepository;
    private $itemRepository;

    public function __construct(ProgramacaoRepository $programacaoRepo, ItemRepository $itemRepo, FotoRepository $fotoRepo)
    {
        $this->programacaoRepository = $programacaoRepo;
        $this->itemRepository = $itemRepo;
        $this->fotoRepository = $fotoRepo;
    }

    /**
     * Display a listing of the Programacao.
     * GET|HEAD /programacoes.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $programacoes = $this->programacaoRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($programacoes->toArray(), 'Programações listadas com sucesso');
    }

    /**
     * Store a newly created Programacao in storage.
     * POST /programacoes.
     *
     * @param CreateProgramacaoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateProgramacaoAPIRequest $request)
    {
        $input = $request->all();

        $programacao = $this->programacaoRepository->create($input);

        return $this->sendResponse($programacao->toArray(), 'Programação salva com sucesso');
    }

    /**
     * Display the specified Programacao.
     * GET|HEAD /programacoes/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Programacao $programacao */
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            return $this->sendError('Programação não encontrada');
        }

        return $this->sendResponse($programacao->toArray(), 'Programação listada com sucesso');
    }

    /**
     * Update the specified Programacao in storage.
     * PUT/PATCH /programacoes/{id}.
     *
     * @param int $id
     * @param UpdateProgramacaoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProgramacaoAPIRequest $request)
    {
        $input = $request->all();

        /** @var Programacao $programacao */
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            return $this->sendError('Programação não encontrada');
        }

        $programacao = $this->programacaoRepository->update($input, $id);

        return $this->sendResponse($programacao->toArray(), 'Programação atualizada com sucesso');
    }

    /**
     * Remove the specified Programacao from storage.
     * DELETE /programacoes/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Programacao $programacao */
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            return $this->sendError('Programação não encontrada');
        }

        $programacao->delete();

        return $this->sendResponse($id, 'Programação excluída com sucesso');
    }

    /**
     * Sincronização das fotos de um item de uma programação.
     *
     * @param int $idProgramacao
     * @param int $idItem
     * @param Request $request
     * @return Response - Fotos criadas
     */
    public function syncProgramacaoItemFotos($idProgramacao, $idItem, Request $request)
    {
        $programacao = $this->programacaoRepository->find($idProgramacao);
        if (empty($programacao)) {
            return $this->sendError('Programação não encontrada');
        }

        $item = $this->itemRepository->find($idItem);
        if (empty($item)) {
            return $this->sendError('Item não encontrado');
        }

        $fotos = $this->fotoRepository->sincronizarFotos($idProgramacao, $idItem, $request);

        return $this->sendResponse($fotos, 'Fotos do item salva com sucesso');
    }

    /**
     * Sincronização da programação e quantidades inseridas pelos técnicos.
     *
     * @param int $id
     * @return Response
     */
    public function syncProgramacoes($id, Request $request)
    {
        $input = $request->all();
        $programacao = $this->programacaoRepository->find($id);
        $this->programacaoRepository->sincronizaProgramação($programacao, $input);

        return $this->sendResponse($programacao->toArray(), 'Programação sincronizada com sucesso');
    }
}
