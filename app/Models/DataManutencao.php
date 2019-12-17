<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DataManutencao.
 * @version December 12, 2019, 3:50 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property int programacao_id
 * @property int item_id
 * @property string data_inicio
 * @property string data_fim
 */
class DataManutencao extends Model
{
    use SoftDeletes;

    public $table = 'datas_manutencoes';

    protected $dates = ['deleted_at', 'data_inicio', 'data_fim'];

    public $fillable = [
        'programacao_id',
        'item_id',
        'data_inicio',
        'data_fim',
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
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'item_id' => 'required',
        'data_inicio' => 'required',
        'data_fim' => 'required',
    ];

    public $appends = [
        'dataInicioFormatada',
        'dataFimFormatada',
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
     * Acessor para Data Inicio  formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataInicioFormatadaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_inicio)->format('d/m/Y H:i:s');
    }

    /**
     * Acessor para Data Fim  formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataFimFormatadaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_fim)->format('d/m/Y H:i:s');
    }

    /**
     * Mutator pra data inicio.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataInicioAttribute($value)
    {
        try {
            $this->attributes['data_inicio'] = \Carbon\Carbon::parse($value);
        } catch (\Exception $e) {
            $this->attributes['data_inicio'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value);
        }
    }

    /**
     * Mutator pra data fim.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataFimAttribute($value)
    {
        try {
            $this->attributes['data_fim'] = \Carbon\Carbon::parse($value);
        } catch (\Exception $e) {
            $this->attributes['data_fim'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value);
        }
    }
}
