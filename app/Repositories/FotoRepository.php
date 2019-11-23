<?php

namespace App\Repositories;

use App\Models\Foto;
use App\Repositories\BaseRepository;

/**
 * Class FotoRepository
 * @package App\Repositories
 * @version November 22, 2019, 7:54 pm -03
*/

class FotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Foto::class;
    }

    /**
     * Salva um arquivo localmente
     *
     * @return string - path do arquivo
     */
    public function armazenaLocal($foto)
    {
        $pathStorage = '/fotos';
        return \Storage::put($pathStorage, $foto);
    }

    /**
     * Salve o arquivo localmente e retorna um model Foto
     *
     * @return void
     */
    public function createArmazenandoLocal($arquivoUploaded, $idProgramacao, $idItem)
    {
        $arquivoLocal = $this->armazenaLocal($arquivoUploaded);
        return $this->create([
            'path' => $arquivoLocal,
            'programacao_id' => $idProgramacao,
            'item_id' => $idItem
        ]);
    }

    /**
     * Metodo para iterar sob as fotos da request criando as entidades Foto.
     *
     * @return array - array com as fotos da request
     */
    public function sincronizarFotos($idProgramacao, $idItem, $request)
    {
        $fotos = is_array($request) ? $request['fotos'] : $request->fotos;
        $arrayFotos = [];

        foreach ($fotos as $foto) {
            $Foto = $this->createArmazenandoLocal($foto, $idProgramacao, $idItem);
            $arrayFotos[] = $Foto;
        }

        return $arrayFotos;
    }
}
