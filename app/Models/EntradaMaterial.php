<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EntradaMaterial.
 * @version October 29, 2019, 12:14 am -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Material material
 * @property int material_id
 * @property int programacao_id
 * @property int quantidade
 */
class EntradaMaterial extends Model
{
    use SoftDeletes;

    public $table = 'entradas_materiais';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'material_id',
        'programacao_id',
        'quantidade',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'material_id' => 'integer',
        'programacao_id' => 'integer',
        'quantidade' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'material_id' => 'required|exists:materiais,id',
        'programacao_id' => 'required|exists:programacoes,id',
        'quantidade' => 'required|integer',
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
    public function material()
    {
        return $this->belongsTo(\App\Models\Material::class, 'material_id');
    }
}
