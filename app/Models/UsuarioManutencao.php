<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UsuarioManutencao
 * @package App\Models
 * @version March 27, 2020, 4:30 pm -03
 *
 * @property \App\Models\ManutencaoCivilEletrica manutencao
 * @property \App\Models\Usuario usuario
 * @property integer manutencao_id
 * @property integer usuario_id
 */
class UsuarioManutencao extends Model
{
    use SoftDeletes;

    public $table = 'usuarios_manutencoes';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'manutencao_id',
        'usuario_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'manutencao_id' => 'integer',
        'usuario_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'manutencao_id' => 'required',
        'usuario_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function manutencao()
    {
        return $this->belongsTo(\App\Models\ManutencaoCivilEletrica::class, 'manutencao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function usuario()
    {
        return $this->belongsTo(\App\Models\Usuario::class, 'usuario_id');
    }
}
