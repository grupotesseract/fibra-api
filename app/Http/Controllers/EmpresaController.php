<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\EmpresaDataTable;
use App\DataTables\PlantaDataTable;
use App\DataTables\Scopes\PorIdEmpresaScope;
use App\Repositories\EmpresaRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateEmpresaRequest;
use App\Http\Requests\UpdateEmpresaRequest;

class EmpresaController extends AppBaseController
{
    /** @var EmpresaRepository */
    private $empresaRepository;

    public function __construct(EmpresaRepository $empresaRepo)
    {
        $this->empresaRepository = $empresaRepo;
    }

    /**
     * Display a listing of the Empresa.
     *
     * @param EmpresaDataTable $empresaDataTable
     * @return Response
     */
    public function index(EmpresaDataTable $empresaDataTable)
    {
        return $empresaDataTable->render('empresas.index');
    }

    /**
     * Show the form for creating a new Empresa.
     *
     * @return Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created Empresa in storage.
     *
     * @param CreateEmpresaRequest $request
     *
     * @return Response
     */
    public function store(CreateEmpresaRequest $request)
    {
        $input = $request->all();

        $empresa = $this->empresaRepository->create($input);

        Flash::success('Empresa salva com sucesso.');

        return redirect(route('empresas.index'));
    }

    /**
     * Display the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(PlantaDataTable $datatable, $id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa não encontrada');
            return redirect(route('empresas.index'));
        }

        return $datatable->addScope(new PorIdEmpresaScope($id))
            ->render('empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified Empresa.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa não encontrada');

            return redirect(route('empresas.index'));
        }

        return view('empresas.edit')->with('empresa', $empresa);
    }

    /**
     * Update the specified Empresa in storage.
     *
     * @param  int              $id
     * @param UpdateEmpresaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmpresaRequest $request)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa não encontrada');

            return redirect(route('empresas.index'));
        }

        $empresa = $this->empresaRepository->update($request->all(), $id);

        Flash::success('Empresa atualizada com sucesso.');

        return redirect(route('empresas.index'));
    }

    /**
     * Remove the specified Empresa from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empresa = $this->empresaRepository->find($id);

        if (empty($empresa)) {
            Flash::error('Empresa não encontrada');

            return redirect(route('empresas.index'));
        }

        $this->empresaRepository->delete($id);

        Flash::success('Empresa excluída com sucesso.');

        return redirect(route('empresas.index'));
    }
}
