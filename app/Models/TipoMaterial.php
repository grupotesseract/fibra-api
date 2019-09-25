<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoMaterial.
 * @version September 4, 2019, 3:51 pm -03
 *
 * @property string nome
 */
class TipoMaterial extends Model
{
    use SoftDeletes;

    public $table = 'tipos_materiais';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'abreviacao',
        'tipo',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'abreviacao' => 'string',
        'tipo' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'abreviacao' => 'required',
        'tipo' => 'required',
    ];
}