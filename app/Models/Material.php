<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Material.
 * @version September 10, 2019, 4:11 pm -03
 *
 * @property \App\Models\TipoMaterial tipoMaterial
 * @property string nome
 * @property string potencia
 * @property string tensao
 * @property int tipo_material_id
 */
class Material extends Model
{
    use SoftDeletes;

    public $table = 'materiais';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'potencia',
        'tensao',
        'tipo_material_id',
        'reator_id',
        'receptaculo_id',
    ];

    public $appends = [
        'receptaculoNome',
        'reatorNome',
        'tipoMaterialNome',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'potencia' => 'string',
        'tensao' => 'string',
        'tipo_material_id' => 'integer',
        'reator_id'  => 'integer',
        'receptaculo_id'  => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoMaterial()
    {
        return $this->belongsTo(\App\Models\TipoMaterial::class, 'tipo_material_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reator()
    {
        return $this->belongsTo(\App\Models\Material::class, 'reator_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function receptaculo()
    {
        return $this->belongsTo(\App\Models\Material::class, 'receptaculo_id');
    }

    /**
     * Acessor para a informação de Tipo de Material
     *
     * @return integer
     */
    public function getTipoMaterialNomeAttribute()
    {
        if ($this->tipoMaterial()->exists()) {
            return $this->tipoMaterial->nome;
        }
    }

    /**
     * Acessor para a informação de Reator
     *
     * @return integer
     */
    public function getReatorNomeAttribute()
    {
        if ($this->reator()->exists()) {
            return $this->reator->nome;
        }
    }

    /**
     * Acessor para a informação de Receptaculo
     *
     * @return integer
     */
    public function getReceptaculoNomeAttribute()
    {
        if ($this->receptaculo()->exists()) {
            return $this->receptaculo->nome;
        }
    }
}
