<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

/**
 * Class Usuario.
 * @version August 30, 2019, 9:38 pm -03
 *
 * @property \App\Models\Cidade cidade
 * @property string nome
 * @property string email
 * @property string|\Carbon\Carbon email_verified_at
 * @property string password
 * @property string telefone
 * @property string endereco
 * @property int cidade_id
 * @property string remember_token
 */
class Usuario extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, SoftDeletes;

    public $table = 'usuarios';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'email',
        'email_verified_at',
        'password',
        'telefone',
        'endereco',
        'cidade_id',
        'remember_token',
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
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'telefone' => 'string',
        'endereco' => 'string',
        'cidade_id' => 'integer',
        'remember_token' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'email' => 'required|email|unique:usuarios,email,NULL,id,deleted_at,NULL',
        'password' => 'required',
        'cidade_id' => 'required',
    ];

    protected $hidden = [
        'password',
        'email_verified_at',
        'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cidade()
    {
        return $this->belongsTo(\App\Models\Cidade::class, 'cidade_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function liberacoesDocumentos()
    {
        return $this->belongsToMany(\App\Models\LiberacaoDocumento::class, 'usuarios_liberacoes', 'usuario_id', 'liberacao_documento_id');
    }
}
