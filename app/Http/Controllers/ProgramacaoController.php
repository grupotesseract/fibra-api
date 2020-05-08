<?php

namespace App\Http\Controllers;

use App\DataTables\ComentarioDataTable;
use App\DataTables\ComentarioGeralDataTable;
use App\DataTables\DataManutencaoDataTable;
use App\DataTables\EntradaMateriaisProgramacaoDataTable;
use App\DataTables\EstoqueProgramacaoDataTable;
use App\DataTables\ItemAlteradoDataTable;
use App\DataTables\LiberacaoDocumentoDataTable;
use App\DataTables\ProgramacaoDataTable;
use App\DataTables\QuantidadeSubstituidaDataTable;
use App\DataTables\Scopes\PorIdProgramacaoScope;
use App\Exports\ProgramacaoExport;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateComentarioGeralRequest;
use App\Http\Requests\CreateComentarioRequest;
use App\Http\Requests\CreateEntradaMaterialRequest;
use App\Http\Requests\CreateEstoqueRequest;
use App\Http\Requests\CreateProgramacaoRequest;
use App\Http\Requests\CreateQuantidadeSubstituidaRequest;
use App\Http\Requests\UpdateProgramacaoRequest;
use App\Repositories\ComentarioGeralRepository;
use App\Repositories\ComentarioRepository;
use App\Repositories\ProgramacaoRepository;
use App\Repositories\QuantidadeSubstituidaRepository;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Response;

class ProgramacaoController extends AppBaseController
{
    /** @var ProgramacaoRepository */
    private $programacaoRepository;

    private $comentarioRepository;

    private $comentarioGeralRepository;

    private $qntSubstituidaRepository;

    public function __construct(ProgramacaoRepository $programacaoRepo, QuantidadeSubstituidaRepository $quantidadeSubstituidaRepo, ComentarioRepository $comentarioRepo, ComentarioGeralRepository $comentarioGeralRepo)
    {
        $this->programacaoRepository = $programacaoRepo;
        $this->comentarioRepository = $comentarioRepo;
        $this->comentarioGeralRepository = $comentarioGeralRepo;
        $this->qntSubstituidaRepository = $quantidadeSubstituidaRepo;
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

        return redirect(route('plantas.programacoes', $programacao->planta_id));
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

        return redirect(route('plantas.programacoes', $programacao->planta_id));
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

        return redirect(route('plantas.programacoes', $programacao->planta_id));
    }

    /**
     * Metodo para servir a view de Itens Alterados de 1 Programação.
     *
     * @return void
     */
    public function getItensAlterados(ItemAlteradoDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        $datatable->programacaoID = $id;

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_itens_alterados', compact('programacao'));
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
     * a partir de uma programacao.
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
           ->where('material_id', $request->material_id)
           ->count();

        if ($jaExisteEstoque) {
            return \Response::json([
                'errors' => ['Já existe um estoque para o material selecionado'],
            ], 422);
        }

        $result = $programacao->estoques()->create($request->all());

        return $this->sendResponse($result, 'Estoque adicionado');
    }

    /**
     * Metodo para servir a view de Entradas de Materiais de 1 Programação.
     *
     * @return void
     */
    public function getEntradasMateriais(EntradaMateriaisProgramacaoDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        $datatable->programacaoID = $id;

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_entradas_materiais', compact('programacao'));
    }

    /**
     * Metodo para recebe o POST para criar um novo registro de EntradaMaterial
     * a partir de uma programacao.
     *
     * @param CreateEntradaMaterialRequest $request
     *
     * @return Response
     */
    public function postAdicionarEntradaMaterial(CreateEntradaMaterialRequest $request, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        //Se ja tiver uma entrada de mateiral para essa programacao: erro.
        $jaExisteEntrada = $programacao->entradasMateriais()
           ->where('material_id', $request->material_id)
           ->count();

        if ($jaExisteEntrada) {
            return \Response::json([
                'errors' => ['Já existe uma entrada desse material'],
            ], 422);
        }

        $result = $programacao->entradasMateriais()->create($request->all());

        return $this->sendResponse($result, 'Entrada de material adicionada com sucesso');
    }

    /**
     * Metodo para servir a view de QuantidadeSubstituida de Materiais de 1 Programação.
     *
     * @return void
     */
    public function getQuantidadesSubstituidas(QuantidadeSubstituidaDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_quantidades_substituidas', compact('programacao'));
    }

    /**
     * Metodo para recebe o POST para criar um novo registro de QuantidadeSubstituida
     * a partir de uma programacao.
     */
    public function postQuantidadesSubstituidas(CreateQuantidadeSubstituidaRequest $request, $id)
    {

        //Se ja tiver uma entrada de mateiral para essa programacao: erro.
        $jaExisteQntSubstituida = $this->qntSubstituidaRepository
            ->checaEntradaExistente($request->item_id, $request->programacao_id, $request->material_id);

        if ($jaExisteQntSubstituida) {
            return \Response::json([
                'errors' => ['Já existe uma quantidade substituída para esse material'],
            ], 422);
        }

        $result = $this->qntSubstituidaRepository->create($request->all());

        return $this->sendResponse($result, 'Entrada de material adicionada com sucesso');
    }

    /**
     * Metodo para servir a view de comentarios de 1 Programação.
     *
     * @return View
     */
    public function getGerenciarComentarios(ComentarioDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_comentarios', compact('programacao'));
    }

    /**
     * Metodo para servir a view de Datas de Manutenções de Itens de 1 Programação.
     *
     * @return View
     */
    public function getDatasManutencoes(DataManutencaoDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_datas_manutencoes', compact('programacao'));
    }

    /**
     * Recebe o POST de criar um novo comentario via ajax.
     *
     * @param CreateComentarioRequest $request
     * @param mixed $id
     */
    public function postGerenciarComentarios(CreateComentarioRequest $request, $id)
    {
        $result = $this->comentarioRepository->create($request->all());

        return $this->sendResponse($result, 'Comentário adicionado com sucesso');
    }

    /**
     * Metodo para servir a view de comentarios gerais de 1 Programação.
     *
     * @return View
     */
    public function getGerenciarComentariosGerais(ComentarioGeralDataTable $datatable, $id)
    {
        $programacao = $this->programacaoRepository->find($id);

        if (empty($programacao)) {
            Flash::error('Programação não encontrada');

            return redirect(route('programacoes.index'));
        }

        return $datatable->addScope(new PorIdProgramacaoScope($id))
            ->render('programacoes.show_comentarios_gerais', compact('programacao'));
    }

    /**
     * Recebe o POST de criar um novo comentario via ajax.
     *
     * @param CreateComentarioRequest $request
     * @param mixed $id
     */
    public function postGerenciarComentariosGerais(CreateComentarioGeralRequest $request, $id)
    {
        $result = $this->comentarioGeralRepository->create($request->all());

        return $this->sendResponse($result, 'Comentário Geral adicionado com sucesso');
    }
}
