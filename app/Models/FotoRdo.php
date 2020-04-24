<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FotoRdo.
 * @version April 24, 2020, 2:50 pm -03
 *
 * @property \App\Models\ManutencaoCivilEletrica manutencao
 * @property string cloudinary_id
 * @property string path
 * @property int manutencao_id
 */
class FotoRdo extends Model
{
    use SoftDeletes;

    public $table = 'fotos_rdo';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'cloudinary_id',
        'path',
        'manutencao_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cloudinary_id' => 'string',
        'path' => 'string',
        'manutencao_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'manutencao_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function manutencao()
    {
        return $this->belongsTo(\App\Models\ManutencaoCivilEletrica::class, 'manutencao_id');
    }

    /**
     * Acessor para o path completo da foto no filesystem.
     */
    public function getPathCompletoAttribute()
    {
        return storage_path().'/app/'.$this->path;
    }

    /**
     * getURLCloudinaryAttribute.
     *
     * @return string
     */
    public function getURLCloudinaryAttribute()
    {
        return 'https://res.cloudinary.com/'
            .config('cloudinary.CLOUDINARY_CLOUD_NAME')
            .'/image/upload/f_auto,q_auto/'
            ."$this->cloudinary_id";
    }

    /**
     * Acessor para a URL sem SSL do cloudinary com o encoding de caracteres e extensao .jpeg.
     *
     * @return string
     */
    public function getURLParaRelatorioAttribute()
    {
        return 'http://res.cloudinary.com/'
            .config('cloudinary.CLOUDINARY_CLOUD_NAME')
            .'/image/upload/q_auto'
            .urlencode("/$this->cloudinary_id.jpeg");
    }

    /**
     * Path de pastas no Cloudinary.
     *
     * @return string
     */
    public function getPathCloudinaryAttribute()
    {
        return "MANUTENCAO_$this->manutencao_id/";
    }
}
