<?php

namespace App\Http\Controllers;

use App\DataTables\UsuarioDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Repositories\UsuarioRepository;
use Flash;
use Response;

class UsuarioController extends AppBaseController
{
    /** @var UsuarioRepository */
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepo)
    {
        $this->usuarioRepository = $usuarioRepo;
    }

    /**
     * Display a listing of the Usuario.
     *
     * @param UsuarioDataTable $usuarioDataTable
     * @return Response
     */
    public function index(UsuarioDataTable $usuarioDataTable)
    {
        return $usuarioDataTable->render('usuarios.index');
    }

    /**
     * Show the form for creating a new Usuario.
     *
     * @return Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created Usuario in storage.
     *
     * @param CreateUsuarioRequest $request
     *
     * @return Response
     */
    public function store(CreateUsuarioRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        $input['passwordsha256'] = hash('sha256', $request->password);

        $this->usuarioRepository->create($input);
        Flash::success('Usuário salvo com sucesso.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Display the specified Usuario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuario = $this->usuarioRepository->find($id);

        if (empty($usuario)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.show')->with('usuario', $usuario);
    }

    /**
     * Show the form for editing the specified Usuario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuario = $this->usuarioRepository->find($id);

        if (empty($usuario)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('usuarios.index'));
        }

        return view('usuarios.edit')->with('usuario', $usuario);
    }

    /**
     * Update the specified Usuario in storage.
     *
     * @param  int              $id
     * @param UpdateUsuarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUsuarioRequest $request)
    {
        $usuario = $this->usuarioRepository->find($id);
        $input = $request->all();

        if ($request->password && $request->password !== '') {
            $input['password'] = bcrypt($request->password);
            $input['passwordsha256'] = hash('sha256', $request->password);
        } else {
            $input['password'] = $usuario->password;
            $input['passwordsha256'] = $usuario->passwordsha256;
        }

        if (empty($usuario)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('usuarios.index'));
        }

        $usuario = $this->usuarioRepository->update($input, $id);
        Flash::success('Usuario atualizado com sucesso.');

        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified Usuario from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuario = $this->usuarioRepository->find($id);

        if (empty($usuario)) {
            Flash::error('Usuário não encontrado');

            return redirect(route('usuarios.index'));
        }

        $this->usuarioRepository->delete($id);
        Flash::success('Usuário removido com sucesso.');

        return redirect(route('usuarios.index'));
    }
}
