<?php

namespace App\Http\Controllers;

use App\DataTables\ItemAlteradoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateItemAlteradoRequest;
use App\Http\Requests\UpdateItemAlteradoRequest;
use App\Repositories\ItemAlteradoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class ItemAlteradoController extends AppBaseController
{
    /** @var  ItemAlteradoRepository */
    private $itemAlteradoRepository;

    public function __construct(ItemAlteradoRepository $itemAlteradoRepo)
    {
        $this->itemAlteradoRepository = $itemAlteradoRepo;
    }

    /**
     * Display a listing of the ItemAlterado.
     *
     * @param ItemAlteradoDataTable $itemAlteradoDataTable
     * @return Response
     */
    public function index(ItemAlteradoDataTable $itemAlteradoDataTable)
    {
        return $itemAlteradoDataTable->render('itens_alterados.index');
    }

    /**
     * Show the form for creating a new ItemAlterado.
     *
     * @return Response
     */
    public function create()
    {
        return view('itens_alterados.create');
    }

    /**
     * Store a newly created ItemAlterado in storage.
     *
     * @param CreateItemAlteradoRequest $request
     *
     * @return Response
     */
    public function store(CreateItemAlteradoRequest $request)
    {
        $input = $request->all();

        $itemAlterado = $this->itemAlteradoRepository->create($input);

        Flash::success('Item Alterado salvo com sucesso.');

        return redirect(route('itensAlterados.index'));
    }

    /**
     * Display the specified ItemAlterado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            Flash::error('Item Alterado não encontrado');

            return redirect(route('itensAlterados.index'));
        }

        return view('itens_alterados.show')->with('itemAlterado', $itemAlterado);
    }

    /**
     * Show the form for editing the specified ItemAlterado.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            Flash::error('Item Alterado não encontrado');

            return redirect(route('itensAlterados.index'));
        }

        return view('itens_alterados.edit')->with('itemAlterado', $itemAlterado);
    }

    /**
     * Update the specified ItemAlterado in storage.
     *
     * @param  int              $id
     * @param UpdateItemAlteradoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemAlteradoRequest $request)
    {
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            Flash::error('Item Alterado não encontrado');

            return redirect(route('itensAlterados.index'));
        }

        $itemAlterado = $this->itemAlteradoRepository->update($request->all(), $id);

        Flash::success('Item Alterado atualizado com sucesso.');

        return redirect(route('itensAlterados.index'));
    }

    /**
     * Remove the specified ItemAlterado from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $itemAlterado = $this->itemAlteradoRepository->find($id);

        if (empty($itemAlterado)) {
            Flash::error('Item Alterado não encontrado');

            return redirect(route('itensAlterados.index'));
        }

        $this->itemAlteradoRepository->delete($id);

        Flash::success('Item Alterado excluído com sucesso.');

        return redirect(route('itensAlterados.index'));
    }
}
