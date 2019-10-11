<?php

namespace App\Http\Controllers;

use App\DataTables\UsuarioLiberacaoDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUsuarioLiberacaoRequest;
use App\Http\Requests\UpdateUsuarioLiberacaoRequest;
use App\Repositories\UsuarioLiberacaoRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UsuarioLiberacaoController extends AppBaseController
{
    /** @var  UsuarioLiberacaoRepository */
    private $usuarioLiberacaoRepository;

    public function __construct(UsuarioLiberacaoRepository $usuarioLiberacaoRepo)
    {
        $this->usuarioLiberacaoRepository = $usuarioLiberacaoRepo;
    }

    /**
     * Display a listing of the UsuarioLiberacao.
     *
     * @param UsuarioLiberacaoDataTable $usuarioLiberacaoDataTable
     * @return Response
     */
    public function index(UsuarioLiberacaoDataTable $usuarioLiberacaoDataTable)
    {
        return $usuarioLiberacaoDataTable->render('usuarios_liberacoes.index');
    }

    /**
     * Show the form for creating a new UsuarioLiberacao.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuarios_liberacoes.create');
    }

    /**
     * Store a newly created UsuarioLiberacao in storage.
     *
     * @param CreateUsuarioLiberacaoRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioLiberacaoRequest $request)
    {
        $input = $request->all();

        $usuarioLiberacao = $this->usuarioLiberacaoRepository->create($input);

        Flash::success('Usuario Liberacao saved successfully.');

        return redirect(route('usuariosLiberacoes.index'));
    }

    /**
     * Display the specified UsuarioLiberacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            Flash::error('Usuario Liberacao not found');

            return redirect(route('usuariosLiberacoes.index'));
        }

        return view('usuarios_liberacoes.show')->with('usuarioLiberacao', $usuarioLiberacao);
    }

    /**
     * Show the form for editing the specified UsuarioLiberacao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            Flash::error('Usuario Liberacao not found');

            return redirect(route('usuariosLiberacoes.index'));
        }

        return view('usuarios_liberacoes.edit')->with('usuarioLiberacao', $usuarioLiberacao);
    }

    /**
     * Update the specified UsuarioLiberacao in storage.
     *
     * @param  int              $id
     * @param UpdateUsuarioLiberacaoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioLiberacaoRequest $request)
    {
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            Flash::error('Usuario Liberacao not found');

            return redirect(route('usuariosLiberacoes.index'));
        }

        $usuarioLiberacao = $this->usuarioLiberacaoRepository->update($request->all(), $id);

        Flash::success('Usuario Liberacao updated successfully.');

        return redirect(route('usuariosLiberacoes.index'));
    }

    /**
     * Remove the specified UsuarioLiberacao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioLiberacao = $this->usuarioLiberacaoRepository->find($id);

        if (empty($usuarioLiberacao)) {
            Flash::error('Usuario Liberacao not found');

            return redirect(route('usuariosLiberacoes.index'));
        }

        $this->usuarioLiberacaoRepository->delete($id);

        Flash::success('Usuario Liberacao deleted successfully.');

        return redirect(route('usuariosLiberacoes.index'));
    }
}
