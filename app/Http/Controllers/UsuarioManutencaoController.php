<?php

namespace App\Http\Controllers;

use App\DataTables\UsuarioManutencaoDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateUsuarioManutencaoRequest;
use App\Http\Requests\UpdateUsuarioManutencaoRequest;
use App\Repositories\UsuarioManutencaoRepository;
use Flash;
use Response;

class UsuarioManutencaoController extends AppBaseController
{
    /** @var UsuarioManutencaoRepository */
    private $usuarioManutencaoRepository;

    public function __construct(UsuarioManutencaoRepository $usuarioManutencaoRepo)
    {
        $this->usuarioManutencaoRepository = $usuarioManutencaoRepo;
    }

    /**
     * Display a listing of the UsuarioManutencao.
     *
     * @param UsuarioManutencaoDataTable $usuarioManutencaoDataTable
     * @return Response
     */
    public function index(UsuarioManutencaoDataTable $usuarioManutencaoDataTable)
    {
        return $usuarioManutencaoDataTable->render('usuarios_manutencoes.index');
    }

    /**
     * Show the form for creating a new UsuarioManutencao.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuarios_manutencoes.create');
    }

    /**
     * Store a newly created UsuarioManutencao in storage.
     *
     * @param CreateUsuarioManutencaoRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioManutencaoRequest $request)
    {
        $input = $request->all();

        $usuarioManutencao = $this->usuarioManutencaoRepository->create($input);

        Flash::success('Usuario Manutencao salvo com sucesso.');

        return redirect(route('usuariosManutencoes.index'));
    }

    /**
     * Display the specified UsuarioManutencao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            Flash::error('Usuario Manutencao não encontrado');

            return redirect(route('usuariosManutencoes.index'));
        }

        return view('usuarios_manutencoes.show')->with('usuarioManutencao', $usuarioManutencao);
    }

    /**
     * Show the form for editing the specified UsuarioManutencao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            Flash::error('Usuario Manutencao não encontrado');

            return redirect(route('usuariosManutencoes.index'));
        }

        return view('usuarios_manutencoes.edit')->with('usuarioManutencao', $usuarioManutencao);
    }

    /**
     * Update the specified UsuarioManutencao in storage.
     *
     * @param  int              $id
     * @param UpdateUsuarioManutencaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioManutencaoRequest $request)
    {
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            Flash::error('Usuario Manutencao não encontrado');

            return redirect(route('usuariosManutencoes.index'));
        }

        $usuarioManutencao = $this->usuarioManutencaoRepository->update($request->all(), $id);

        Flash::success('Usuario Manutencao atualizado com sucesso.');

        return redirect(route('usuariosManutencoes.index'));
    }

    /**
     * Remove the specified UsuarioManutencao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioManutencao = $this->usuarioManutencaoRepository->find($id);

        if (empty($usuarioManutencao)) {
            Flash::error('Usuario Manutencao não encontrado');

            return redirect(route('usuariosManutencoes.index'));
        }

        $this->usuarioManutencaoRepository->delete($id);

        Flash::success('Usuario Manutencao excluído com sucesso.');

        return redirect(route('usuariosManutencoes.index'));
    }
}
