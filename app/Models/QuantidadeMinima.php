<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuantidadeMinima.
 * @version October 15, 2019, 2:49 pm -03
 *
 * @property \App\Models\Planta planta
 * @property \App\Models\Material material
 * @property int material_id
 * @property int planta_id
 * @property int quantidade_minima
 */
class QuantidadeMinima extends Model
{
    use SoftDeletes;

    public $table = 'quantidades_minimas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'material_id',
        'planta_id',
        'quantidade_minima',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'material_id' => 'integer',
        'planta_id' => 'integer',
        'quantidade_minima' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'material_id' => 'required|exists:materiais,id',
        'planta_id' => 'required|exists:plantas,id',
        'quantidade_minima' => 'required|integer|min:1',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function planta()
    {
        return $this->belongsTo(\App\Models\Planta::class, 'planta_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function material()
    {
        return $this->belongsTo(\App\Models\Material::class, 'material_id');
    }
}
