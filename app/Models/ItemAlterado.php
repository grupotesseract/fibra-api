<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ItemAlterado.
 * @version April 24, 2020, 3:13 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property \App\Models\Material material
 * @property int programacao_id
 * @property int item_id
 * @property int material_id
 * @property int quantidade_instalada
 */
class ItemAlterado extends Model
{
    use SoftDeletes;

    public $table = 'itens_alterados';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_instalada',
        'quantidade_base',
        'quantidade_reator',
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
        'quantidade_instalada' => 'integer',
        'quantidade_base' => 'integer',
        'quantidade_reator' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'item_id' => 'required',
        'material_id' => 'required',
        'quantidade_instalada' => 'required',
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
