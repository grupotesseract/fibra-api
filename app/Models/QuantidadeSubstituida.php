<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuantidadeSubstituida
 * @package App\Models
 * @version October 23, 2019, 3:09 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property \App\Models\Material material
 * @property integer programacao_id
 * @property integer item_id
 * @property integer material_id
 * @property integer quantidade_substituida
 */
class QuantidadeSubstituida extends Model
{
    use SoftDeletes;

    public $table = 'quantidades_substituidas';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_substituida'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'programacao_id' => 'integer',
        'item_id' => 'integer',
        'material_id' => 'integer',
        'quantidade_substituida' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'item_id' => 'required',
        'material_id' => 'required',
        'quantidade_substituida' => 'required'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function material()
    {
        return $this->belongsTo(\App\Models\Material::class, 'material_id');
    }
}
