<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Empresa.
 * @version September 3, 2019, 4:23 pm -03
 *
 * @property \App\Models\Cidade cidade
 * @property string nome
 * @property string email
 * @property string telefone
 * @property string endereco
 * @property int cidade_id
 */
class Empresa extends Model
{
    use SoftDeletes;

    public $table = 'empresas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
        'cidade_id',
        'path_imagem'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'email' => 'string',
        'telefone' => 'string',
        'endereco' => 'string',
        'cidade_id' => 'integer',
        'path_imagem' => 'string'
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'email' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cidade()
    {
        return $this->belongsTo(\App\Models\Cidade::class, 'cidade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function plantas()
    {
        return $this->hasMany(\App\Models\Planta::class, 'empresa_id');
    }
}
