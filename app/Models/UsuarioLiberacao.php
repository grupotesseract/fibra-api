<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UsuarioLiberacao.
 * @version October 11, 2019, 4:39 pm -03
 *
 * @property \App\Models\LiberacaoDocumento liberacaoDocumento
 * @property \App\Models\Usuario usuario
 * @property int liberacao_documento_id
 * @property int usuario_id
 */
class UsuarioLiberacao extends Model
{
    use SoftDeletes;

    public $table = 'usuarios_liberacoes';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'liberacao_documento_id',
        'usuario_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'liberacao_documento_id' => 'integer',
        'usuario_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'liberacao_documento_id' => 'required',
        'usuario_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function liberacaoDocumento()
    {
        return $this->belongsTo(\App\Models\LiberacaoDocumento::class, 'liberacao_documento_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id');
    }
}
