<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Http\Requests;
use App\DataTables\ItemDataTable;
use App\Repositories\ItemRepository;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Requests\AssociaMaterialItemRequest;
use App\Http\Controllers\AppBaseController;
use App\DataTables\MateriaisDoItemDataTable;
use App\DataTables\Scopes\MateriaisDoItemScope;

class ItemController extends AppBaseController
{
    /** @var ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     *
     * @param ItemDataTable $itemDataTable
     * @return Response
     */
    public function index(ItemDataTable $itemDataTable)
    {
        return $itemDataTable->render('itens.index');
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create()
    {
        return view('itens.create');
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();

        $item = $this->itemRepository->create($input);

        Flash::success('Item salvo com sucesso.');

        return redirect(route('itens.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(MateriaisDoItemDataTable $mateiriasDataTable, $id)
    {
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect(route('itens.index'));
        }

        $mateiriasDataTable->itemID = $id;
        return $mateiriasDataTable->addScope(new MateriaisDoItemScope($id))
            ->render('itens.show', compact('item'));
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect(route('itens.index'));
        }

        return view('itens.edit')->with('item', $item);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateItemRequest $request)
    {
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect(route('itens.index'));
        }

        $item = $this->itemRepository->update($request->all(), $id);

        Flash::success('Item atualizado com sucesso.');

        return redirect(route('itens.index'));
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect(route('itens.index'));
        }

        $this->itemRepository->delete($id);

        Flash::success('Item excluído com sucesso.');

        return redirect(route('itens.index'));
    }


    /**
     * Associa um material com determinada quantidade ao Item
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function postAssociarMaterial($id, AssociaMaterialItemRequest $request)
    {
        $item = $this->itemRepository->find($id);

        if (empty($item)) {
            Flash::error('Item não encontrado');
            return redirect(route('itens.index'));
        }

        $fezUpdate = $item->materiais()->attach([
            $request->material_id => [
                'quantidade_instalada' => $request->qnt_instalada
            ]
        ]);

        return $this->sendResponse($fezUpdate, 'Material adicionado');
    }





}
