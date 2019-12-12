<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DataManutencao
 * @package App\Models
 * @version December 12, 2019, 3:50 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property integer programacao_id
 * @property integer item_id
 * @property string data_inicio
 * @property string data_fim
 */
class DataManutencao extends Model
{
    use SoftDeletes;

    public $table = 'datas_manutencoes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'programacao_id',
        'item_id',
        'data_inicio',
        'data_fim'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
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
        'item_id' => 'required',
        'data_inicio' => 'required',
        'data_fim' => 'required'
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
}
