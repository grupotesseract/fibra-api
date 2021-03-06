<?php

namespace App\Http\Controllers;

use App\DataTables\AtividadeRealizadaDataTable;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests;
use App\Http\Requests\CreateAtividadeRealizadaRequest;
use App\Http\Requests\UpdateAtividadeRealizadaRequest;
use App\Repositories\AtividadeRealizadaRepository;
use Flash;
use Response;

class AtividadeRealizadaController extends AppBaseController
{
    /** @var AtividadeRealizadaRepository */
    private $atividadeRealizadaRepository;

    public function __construct(AtividadeRealizadaRepository $atividadeRealizadaRepo)
    {
        $this->atividadeRealizadaRepository = $atividadeRealizadaRepo;
    }

    /**
     * Display a listing of the AtividadeRealizada.
     *
     * @param AtividadeRealizadaDataTable $atividadeRealizadaDataTable
     * @return Response
     */
    public function index(AtividadeRealizadaDataTable $atividadeRealizadaDataTable)
    {
        return $atividadeRealizadaDataTable->render('atividades_realizadas.index');
    }

    /**
     * Show the form for creating a new AtividadeRealizada.
     *
     * @return Response
     */
    public function create()
    {
        return view('atividades_realizadas.create');
    }

    /**
     * Store a newly created AtividadeRealizada in storage.
     *
     * @param CreateAtividadeRealizadaRequest $request
     *
     * @return Response
     */
    public function store(CreateAtividadeRealizadaRequest $request)
    {
        $input = $request->all();

        $atividadeRealizada = $this->atividadeRealizadaRepository->create($input);

        Flash::success('Atividade Realizada salva com sucesso.');

        return redirect(route('manutencoesCivilEletrica.show', $atividadeRealizada->manutencao_id));
    }

    /**
     * Display the specified AtividadeRealizada.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            Flash::error('Atividade Realizada não encontrada');

            return redirect()->back();
        }

        return view('atividades_realizadas.show')->with('atividadeRealizada', $atividadeRealizada);
    }

    /**
     * Show the form for editing the specified AtividadeRealizada.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            Flash::error('Atividade Realizada não encontrada');

            return redirect()->back();
        }

        return view('atividades_realizadas.edit')->with('atividadeRealizada', $atividadeRealizada);
    }

    /**
     * Update the specified AtividadeRealizada in storage.
     *
     * @param  int              $id
     * @param UpdateAtividadeRealizadaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAtividadeRealizadaRequest $request)
    {
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            Flash::error('Atividade Realizada não encontrada');

            return redirect()->back();
        }

        $atividadeRealizada = $this->atividadeRealizadaRepository->update($request->all(), $id);

        Flash::success('Atividade Realizada atualizada com sucesso.');

        return redirect(route('manutencoesCivilEletrica.show', $atividadeRealizada->manutencao_id));
    }

    /**
     * Remove the specified AtividadeRealizada from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $atividadeRealizada = $this->atividadeRealizadaRepository->find($id);

        if (empty($atividadeRealizada)) {
            Flash::error('Atividade Realizada não encontrada');

            return redirect()->back();
        }

        $this->atividadeRealizadaRepository->delete($id);

        Flash::success('Atividade Realizada excluída com sucesso.');

        return redirect(route('manutencoesCivilEletrica.show', $atividadeRealizada->manutencao_id));
    }
}
