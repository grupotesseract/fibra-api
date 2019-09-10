<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\MaterialDataTable;
use App\Repositories\MaterialRepository;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateMaterialRequest;
use App\Http\Requests\UpdateMaterialRequest;

class MaterialController extends AppBaseController
{
    /** @var MaterialRepository */
    private $materialRepository;

    public function __construct(MaterialRepository $materialRepo)
    {
        $this->materialRepository = $materialRepo;
    }

    /**
     * Display a listing of the Material.
     *
     * @param MaterialDataTable $materialDataTable
     * @return Response
     */
    public function index(MaterialDataTable $materialDataTable)
    {
        return $materialDataTable->render('materiais.index');
    }

    /**
     * Show the form for creating a new Material.
     *
     * @return Response
     */
    public function create()
    {
        return view('materiais.create');
    }

    /**
     * Store a newly created Material in storage.
     *
     * @param CreateMaterialRequest $request
     *
     * @return Response
     */
    public function store(CreateMaterialRequest $request)
    {
        $input = $request->all();

        $material = $this->materialRepository->create($input);

        Flash::success('Material salvo com sucesso.');

        return redirect(route('materiais.index'));
    }

    /**
     * Display the specified Material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material não encontrado');

            return redirect(route('materiais.index'));
        }

        return view('materiais.show')->with('material', $material);
    }

    /**
     * Show the form for editing the specified Material.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material não encontrado');

            return redirect(route('materiais.index'));
        }

        return view('materiais.edit')->with('material', $material);
    }

    /**
     * Update the specified Material in storage.
     *
     * @param  int              $id
     * @param UpdateMaterialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaterialRequest $request)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material não encontrado');

            return redirect(route('materiais.index'));
        }

        $material = $this->materialRepository->update($request->all(), $id);

        Flash::success('Material atualizado com sucesso.');

        return redirect(route('materiais.index'));
    }

    /**
     * Remove the specified Material from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $material = $this->materialRepository->find($id);

        if (empty($material)) {
            Flash::error('Material não encontrado');

            return redirect(route('materiais.index'));
        }

        $this->materialRepository->delete($id);

        Flash::success('Material excluído com sucesso.');

        return redirect(route('materiais.index'));
    }
}
