<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\ProgramacaoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProgramacaoRepository;
use App\Http\Requests\CreateEstoqueRequest;
use App\DataTables\EstoqueProgramacaoDataTable;
use App\DataTables\LiberacaoDocumentoDataTable;
use App\Http\Requests\CreateProgramacaoRequest;
use App\Http\Requests\UpdateProgramacaoRequest;
use App\DataTables\Scopes\PorIdProgramacaoScope;

class ProgramacaoController extends AppBaseController
{
    /** @var ProgramacaoRepository */
    private $programacaoRepository;

    public function __construct(ProgramacaoRepository $programacaoRepo)
    {
        $this->programacaoRepository = $programacaoRepo;
    }

    /**
     * Display a listing of the Programacao.
     *
     * @param ProgramacaoDataTable $programacaoDataTable
     * @return Response
     */
    public function index(ProgramacaoDataTable $programacaoDataTable)
    {
        return $programacaoDataTable->render('programacoes.index');
    }

    /**
     * Show the form for creating a new Programacao.
     *
     * @return Response
     */
    public function create()
    {
        return view('programacoes.create');
    }

    /**
     * Store a newly created Programacao in storage.
     *
     * @param CreateProgramacaoRequest $request
     *
     * @return Response
     */
    public function store(CreateProgramacaoRequest $request)
    {
        $input = $request->all();

        $programacao = $this->programacaoRepository->create($input);

        Flash::success('Programação salva com sucesso.');

        return redirect(route('programacoes.index'));
    }

    /**
     * Display the specified Programacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return view('programacoes.show')->with('programacao', $programacao);
    }

    /**
     * Show the form for editing the specified Programacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return view('programacoes.edit')->with('programacao', $programacao);
    }

    /**
     * Update the specified Programacao in storage.
     *
     * @param  int              $id
     * @param UpdateProgramacaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProgramacaoRequest $request)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        $programacao = $this->programacaoRepository->update($request->all(), $id);

        Flash::success('Programação atualizada com sucesso.');

        return redirect(route('programacoes.index'));
    }

    /**
     * Remove the specified Programacao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        $this->programacaoRepository->delete($id);

        Flash::success('Programação excluída com sucesso');

        return redirect(route('programacoes.index'));
    }

    /**
     * Metodo para servir a view de Liberações de Documentos de 1 Programação.
     *
     * @return void
     */
    public function getLiberacoesDocumentos(LiberacaoDocumentoDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');
            return redirect(route('programacoes.index'));
        }

        $datatable->programacaoID = $id;

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_liberacoes_documentos', compact('programacao'));
    }

    /**
     * Metodo para servir a view de Gerenciar Estoque de 1 Programação.
     *
     * @return void
     */
    public function getGerenciarEstoque(EstoqueProgramacaoDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');
            return redirect(route('programacoes.index'));
        }

        $datatable->programacaoID = $id;

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_estoque', compact('programacao'));
    }

    /**
     * Metodo para recebe o POST para criar um novo registro de Estoque
     * a partir de uma programacao
     *
     * @param CreateEstoqueRequest $request
     *
     * @return Response
     */
    public function postAdicionarEstoque(CreateEstoqueRequest $request, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');
            return redirect(route('programacoes.index'));
        }

        //Se ja tiver estoque para esse mateiral, erro.
        $jaExisteEstoque = $programacao->estoques()
           ->where('material_id', $request->material_ida)
           ->count();

        if ($jaExisteEstoque) {
            return \Response::json([
                'errors' => ['Já existe um estoque para o material selecionado'],
            ], 422);
        }

        $result = $programacao->estoques()->create($request->all());
        return $this->sendResponse($result, 'Estoque adicionado');
    }
}
