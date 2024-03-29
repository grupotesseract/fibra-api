<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateEmpresaAPIRequest;
use App\Http\Requests\API\UpdateEmpresaAPIRequest;
use App\Models\Empresa;
use App\Models\Usuario;
use App\Repositories\EmpresaRepository;
use App\Transformers\EmpresaTransformer;
use App\Transformers\UsuarioTransformer;
use Illuminate\Http\Request;
use Response;

/**
 * Class EmpresaController.
 */
class EmpresaAPIController extends AppBaseController
{
    /** @var EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
    }

    /**
     * Display a listing of the Empresa.
     * GET|HEAD /empresas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $empresas = $this->empresaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit'),
            'plantas'
        );

        return $this->sendResponse($empresas->toArray(), 'Empresas listadas com sucesso');
    }

    /**
     * Store a newly created Empresa in storage.
     * POST /empresas.
     *
     * @param CreateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        $empresa = $this->empresaRepository->create($input);

        return $this->sendResponse($empresa->toArray(), 'Empresa salva com sucesso');
    }

    /**
     * Display the specified Empresa.
     * GET|HEAD /empresas/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa não encontrada');
        }

        return $this->sendResponse($empresa->toArray(), 'Empresa listada com sucesso');
    }

    /**
     * Update the specified Empresa in storage.
     * PUT/PATCH /empresas/{id}.
     *
     * @param int $id
     * @param UpdateEmpresaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaAPIRequest $request)
    {
        $input = $request->all();

        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa não encontrada');
        }

        $empresa = $this->empresaRepository->update($input, $id);

        return $this->sendResponse($empresa->toArray(), 'Empresa atualizada com sucesso');
    }

    /**
     * Remove the specified Empresa from storage.
     * DELETE /empresas/{id}.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Empresa $empresa */
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            return $this->sendError('Empresa não encontrada');
        }

        $empresa->delete();

        return $this->sendResponse($id, 'Empresa excluída com sucesso');
    }

    /**
     * Método para sincronização de entrada de dados do Mobile.
     *
     * @return Response
     */
    public function syncEmpresas()
    {
        $empresas = Empresa::with(
            [
                'plantas.proximaProgramacao',
                'plantas.itens.materiais.tipoMaterial',
                'plantas.programacaoAnteriorMaisRecente.estoques.material.tipoMaterial',
                'plantas.atividadesRealizadas'
            ]
        )->get();

        $usuarios = Usuario::all();

        $empresas = fractal($empresas, new EmpresaTransformer())->toArray();
        $usuarios = fractal($usuarios, new UsuarioTransformer())->toArray();

        $retorno = [
            'usuarios' => $usuarios['data'],
            'empresas' => $empresas['data'],
        ];

        return $this->sendResponse($retorno, 'Empresas e usuários sincronizados com sucesso');
    }
}
