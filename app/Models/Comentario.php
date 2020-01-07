<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comentario.
 * @version December 10, 2019, 12:27 am -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property int item_id
 * @property int programacao_id
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
        'comentario',
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
        'comentario' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'item_id' => 'required|exists:itens,id',
        'programacao_id' => 'required|exists:programacoes,id',
        'comentario' => 'required',
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
     * Mutator pra inserir comentário vazio
     *
     * @param string $value
     * @return string
     */
    public function setComentarioAttribute($value)
    {
        $this->attributes['comentario'] = !is_null($value) ? $value : '';
    }
}
