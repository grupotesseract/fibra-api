<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FotoRdo
 * @package App\Models
 * @version April 24, 2020, 2:50 pm -03
 *
 * @property \App\Models\ManutencaoCivilEletrica manutencao
 * @property string cloudinary_id
 * @property string path
 * @property integer manutencao_id
 */
class FotoRdo extends Model
{
    use SoftDeletes;

    public $table = 'fotos_rdo';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'cloudinary_id',
        'path',
        'manutencao_id'
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
        'manutencao_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'manutencao_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function manutencao()
    {
        return $this->belongsTo(\App\Models\ManutencaoCivilEletrica::class, 'manutencao_id');
    }
}
