<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ComentarioGeral
 * @package App\Models
 * @version December 11, 2019, 9:03 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property integer programacao_id
 * @property string comentario
 */
class ComentarioGeral extends Model
{
    use SoftDeletes;

    public $table = 'comentarios_gerais';

    protected $dates = ['deleted_at'];

    public $fillable = [
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
        'programacao_id' => 'integer',
        'comentario' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
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
}
