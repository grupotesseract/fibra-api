<?php

namespace App\Http\Controllers;

use App\DataTables\ItemDataTable;
use App\DataTables\MateriaisDoItemDataTable;
use App\DataTables\Scopes\MateriaisDoItemScope;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\AssociaMaterialItemRequest;
use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\DesassociaMaterialItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Requests\UpdateQuantidadeMaterialItemRequest;
use App\Repositories\ItemRepository;
use Flash;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use App\Exports\ItensExport;
use Maatwebsite\Excel\Facades\Excel;

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

        return redirect(route('plantas.itens', $item->planta_id));
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

        return redirect(route('plantas.itens', $item->planta_id));
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

        return redirect(route('plantas.itens', $item->planta_id));
    }

    /**
     * Associa um material com determinada quantidade ao Item.
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

        //Se ja tiver esse material associado, erro.
        if ($item->materiais->find($request->material_id)) {
            return \Response::json([
                'errors' => ['O Material selecionado já está associado ao item'],
            ], 422);
        }

        $fezUpdate = $item->materiais()->attach([
            $request->material_id => [
                'quantidade_instalada' => $request->qnt_instalada,
            ],
        ]);

        return $this->sendResponse($fezUpdate, 'Material adicionado');
    }

    /**
     * Desassocia um material de um Item.
     *
     * @param  int              $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function postDesassociarMaterial($idItem, $idMaterial)
    {
        $item = $this->itemRepository->find($idItem);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect()->back();
        }

        //Se nao tiver esse material associado, erro.
        if (! $item->materiais->find($idMaterial)) {
            return \Response::json([
                'errors' => ['Material não associado ao item'],
            ], 422);
        }

        $item->materiais()->detach($idMaterial);

        Flash::success('Material removido com sucesso');

        return redirect()->back();
    }

    /**
     * Metodo para servir a view para editar a qntInstalada de um material.
     *
     * @return view
     */
    public function getEditarQuantidadeMaterial($idItem, $idMaterial)
    {
        $item = $this->itemRepository->find($idItem);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect()->back();
        }

        //Se nao tiver esse material associado, erro.
        if (! $item->materiais->find($idMaterial)) {
            Flash::error('Material não associado ao item');

            return redirect()->back();
        }

        $qntInstalada = $item->materiais->find($idMaterial)->pivot->quantidade_instalada;

        return view('itens.edit-quantidade-material', compact('item', 'idMaterial', 'qntInstalada'));
    }

    /**
     * Metodo para receber a request de atualizar quantidade instalada de um material.
     *
     * @param UpdateQuantidadeMaterialItemRequest $request
     * @param mixed $idItem
     */
    public function putEditarQuantidadeMaterial(UpdateQuantidadeMaterialItemRequest $request, $idItem)
    {
        $item = $this->itemRepository->find($idItem);

        if (empty($item)) {
            Flash::error('Item não encontrado');

            return redirect()->back();
        }

        //Se nao tiver esse material associado, erro.
        if (! $item->materiais->find($request->id_material)) {
            Flash::error('Material não associado ao item');

            return redirect()->back();
        }

        $this->itemRepository->updateQuantidadeInstaladaMaterial($item, $request->id_material, $request->quantidade_instalada);

        Flash::success('Quantidade instalada atualizada.');

        return redirect(route('itens.show', $idItem));
    }

    public function export($planta_id) 
    {                
        return Excel::download(new ItensExport($planta_id), 'itens.xlsx'); 
    }
}
