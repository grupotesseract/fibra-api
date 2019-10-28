<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estoque.
 * @version October 23, 2019, 7:50 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Material material
 * @property int material_id
 * @property int programacao_id
 * @property int quantidade_inicial
 * @property int quantidade_final
 */
class Estoque extends Model
{
    use SoftDeletes;

    public $table = 'estoque';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'material_id',
        'programacao_id',
        'quantidade_inicial',
        'quantidade_final',
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
        'quantidade_inicial' => 'integer',
        'quantidade_final' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'material_id' => 'required|exists:materiais,id',
        'programacao_id' => 'required|exists:programacoes,id',
        'quantidade_inicial' => 'required|integer|min:1',
        'quantidade_final' => 'nullable|integer|min:0',
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
