<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comentario
 * @package App\Models
 * @version December 10, 2019, 12:27 am -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property integer item_id
 * @property integer programacao_id
 * @property string comentario
 */
class Comentario extends Model
{
    use SoftDeletes;

    public $table = 'comentarios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'item_id',
        'programacao_id',
        'comentario'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'item_id' => 'integer',
        'programacao_id' => 'integer',
        'comentario' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required',
        'programacao_id' => 'required',
        'comentario' => 'required'
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
