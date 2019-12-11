<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Collective\Html\Eloquent\FormAccessible;

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

    protected $dates = ['deleted_at', 'data_manutencao'];

    public $fillable = [
        'programacao_id',
        'item_id',
        'material_id',
        'quantidade_substituida',
        'data_manutencao',
    ];

    public $appends = [
        'data_manutencao_formatada',
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
        'data_manutencao' => 'required',
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
     * Acessor para data da manutenção.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function getDataManutencaoFormatadaAttribute()
    {
        return \Carbon\Carbon::parse($this->data_manutencao)->format('d/m/Y H:i:s');
    }

    /**
     * Mutator para o campo data_manutencao.
     *
     * @param string $value
     * @return Carbon
     */
    public function setDataManutencaoAttribute($value)
    {
        try {
            $this->attributes['data_manutencao'] = \Carbon\Carbon::parse($value);
        } catch (\Exception $e) {
            $this->attributes['data_manutencao'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value);
        }
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
