<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuantidadeSubstituida.
 * @version October 23, 2019, 3:09 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property \App\Models\Material material
 * @property int programacao_id
 * @property int item_id
 * @property int material_id
 * @property int quantidade_substituida
 */
class QuantidadeSubstituida extends Model
{
    use SoftDeletes, FormAccessible;

    public $table = 'quantidades_substituidas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_substituida',
        'base_id',
        'quantidade_substituida_base',
        'reator_id',
        'quantidade_substituida_reator',
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
        'quantidade_substituida' => 'integer',
        'base_id' => 'integer',
        'quantidade_substituida_base' => 'integer',
        'reator_id' => 'integer',
        'quantidade_substituida_reator' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required|exists:itens,id',
        'material_id' => 'required|exists:materiais,id',
        'programacao_id' => 'required|exists:programacoes,id',
        'quantidade_substituida' => 'required|integer',
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

    /**
     * Form Acessor para Data Inicio Prevista.
     *
     * @param string $value
     * @return Carbon
     */
    public function formDataManutencaoAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i:s');
    }
}
