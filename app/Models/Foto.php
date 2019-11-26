<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Foto
 * @package App\Models
 * @version November 22, 2019, 7:52 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property string cloudinary_id
 * @property string path
 * @property integer programacao_id
 * @property integer item_id
 */
class Foto extends Model
{
    use SoftDeletes;

    public $table = 'fotos';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'cloudinary_id',
        'path',
        'programacao_id',
        'item_id'
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
        'programacao_id' => 'integer',
        'item_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'item_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programacao()
    {
        return $this->belongsTo(\App\Models\Programacao::class, 'programacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }

    /**
     * Acessor para o path completo da foto no filesystem
     */
     public function getPathCompletoAttribute()
     {
        return storage_path()."/app/".$this->path;
     }

    /**
     * getURLCloudinaryAttribute
     *
     * @return string
     */
    public function getURLCloudinaryAttribute()
    {
        return 'https://res.cloudinary.com/'
            .env('CLOUDINARY_CLOUD_NAME')
            .'/image/upload/f_auto,q_auto/'
            ."$this->cloudinary_id";
    }

    /**
     * Path de pastas no Cloudinary
     *
     * @return string
     */
    public function getPathCloudinaryAttribute()
    {
        return "PROGRAMAÇÃO_$this->programacao_id/ITEM_$this->item_id/";
    }
}
