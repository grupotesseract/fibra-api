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
        'potencia_id',
        'tensao_id',
        'tipo_material_id',
    ];

    public $appends = [
        'tipoMaterialNome',
        'potenciaValor',
        'tensaoValor',
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
        'potencia_id'  => 'integer',
        'tensao_id'  => 'integer',
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
    public function potencia()
    {
        return $this->belongsTo(\App\Models\Potencia::class, 'potencia_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tensao()
    {
        return $this->belongsTo(\App\Models\Tensao::class, 'tensao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function items()
    {
        return $this
            ->belongsToMany(\App\Models\Item::class, 'itens_materiais', 'material_id', 'item_id')
            ->withPivot('quantidade_instalada');
    }

    /**
     * Acessor para a informação de Tipo de Material.
     *
     * @return int
     */
    public function getTipoMaterialNomeAttribute()
    {
        if ($this->tipoMaterial()->exists()) {
            return $this->tipoMaterial->nome;
        }
    }

    /**
     * Acessor para a informação de Potencia.
     *
     * @return int
     */
    public function getPotenciaValorAttribute()
    {
        if ($this->potencia()->exists()) {
            return $this->potencia->valor;
        }
    }

    /**
     * Acessor para a informação de Tensão.
     *
     * @return int
     */
    public function getTensaoValorAttribute()
    {
        if ($this->tensao()->exists()) {
            return $this->tensao->valor;
        }
    }
}