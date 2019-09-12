<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item
 * @package App\Models
 * @version September 12, 2019, 4:33 pm -03
 *
 * @property \App\Models\Planta planta
 * @property string nome
 * @property string qrcode
 * @property string circuito
 * @property integer planta_id
 */
class Item extends Model
{
    use SoftDeletes;

    public $table = 'itens';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'qrcode',
        'circuito',
        'planta_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'qrcode' => 'string',
        'circuito' => 'string',
        'planta_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'qrcode' => 'required',
        'circuito' => 'required',
        'planta_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function planta()
    {
        return $this->belongsTo(\App\Models\Planta::class, 'planta_id');
    }
}
