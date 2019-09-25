<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Planta.
 * @version September 9, 2019, 4:03 pm -03
 *
 * @property \App\Models\Empresa empresa
 * @property \App\Models\Cidade cidade
 * @property string nome
 * @property string endereco
 * @property int cidade_id
 * @property int empresa_id
 */
class Planta extends Model
{
    use SoftDeletes;

    public $table = 'plantas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'endereco',
        'cidade_id',
        'empresa_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'endereco' => 'string',
        'cidade_id' => 'integer',
        'empresa_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'cidade_id' => 'required',
        'empresa_id' => 'required',
        'endereco' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function empresa()
    {
        return $this->belongsTo(\App\Models\Empresa::class, 'empresa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cidade()
    {
        return $this->belongsTo(\App\Models\Cidade::class, 'cidade_id');
    }
}