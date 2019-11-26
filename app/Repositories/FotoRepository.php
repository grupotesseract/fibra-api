<?php

namespace App\Repositories;

use App\Models\Foto;
use App\Repositories\BaseRepository;

/**
 * Class FotoRepository.
 * @version November 22, 2019, 7:54 pm -03
 */
class FotoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'programacao_id',
        'item_id',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Foto::class;
    }

    /**
     * Salva um arquivo localmente.
     *
     * @return string - path do arquivo
     */
    public function armazenaLocal($foto)
    {
        $pathStorage = '/fotos';

        return \Storage::put($pathStorage, $foto);
    }

    /**
     * Salve o arquivo localmente e retorna um model Foto.
     *
     * @return void
     */
    public function createArmazenandoLocal($arquivoUploaded, $idProgramacao, $idItem)
    {
        $arquivoLocal = $this->armazenaLocal($arquivoUploaded);

        return $this->create([
            'path' => $arquivoLocal,
            'programacao_id' => $idProgramacao,
            'item_id' => $idItem,
        ]);
    }

    /**
     * Metodo para enviar a foto para o cloudinary e atualizar o cloudinary_id da foto.
     *
     * @param App\Models\Foto $foto - instancia de Foto.
     * @param string $publicId - public id desejado para a foto
     * @param string $pasta - pasta do cloudinary caso esteja usando alguma
     */
    public function enviarCloudinary($foto, $publicId, $pasta = null)
    {
        $pasta = $pasta ? ['folder' => $pasta] : [];

        //Se existir o file
        if (\File::exists($foto->pathCompleto)) {
            $retornoCloudinary = \Cloudder::upload($foto->pathCompleto, $publicId, $pasta);

            if ($retornoCloudinary) {
                $idCloudinary = $pasta ? $pasta['folder'].$publicId : $publicId;

                return  $foto->update([
                    'cloudinary_id' => $idCloudinary,
                ]);
            }

            return false;
        } else {
            return false;
        }
    }

    /**
     * Remove a imagem do Cloudinary.
     *
     * @param $fotoID
     * @return bool
     */
    public function deleteCloudinary($idFoto)
    {
        $foto = $this->find($idFoto);
        $retornoCloudinary = \Cloudder::destroyImage($foto->cloudinary_id);

        return empty($retornoCloudinary->deleted) ? false : true;
    }

    /**
     * Deleta o arquivo do filesystem.
     *
     * @param mixed $id
     */
    public function deleteLocal($id)
    {
        $foto = Foto::find($id);

        if ($foto && \File::exists($foto->pathCompleto)) {
            \File::delete($foto->pathCompleto);
            $foto->update(['path' => null]);
        }
    }

    /**
     * Override BaseRepository@delete - para remover também do cloudinary.
     *
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $this->deleteCloudinary($id);
        $this->deleteLocal($id);

        return parent::delete($id);
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
