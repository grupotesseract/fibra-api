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

    protected $with = ['tipoMaterial', 'base', 'reator', 'potencia', 'tensao'];

    public $fillable = [
        'nome',
        'potencia_id',
        'tensao_id',
        'tipo_material_id',
        'base_id',
        'reator_id',
        'tipo_reator_qtde',
        'abreviacao',
    ];

    public $appends = [
        'tipoMaterialNome',
        'tipoMaterialTipo',
        'potenciaValor',
        'tensaoValor',
        'nomePotenciaTensao',
        'baseNome',
        'reatorNome',
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
        'abreviacao' => 'string',
        'tipo_material_id' => 'integer',
        'base_id' => 'integer',
        'reator_id' => 'integer',
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
    public function base()
    {
        return $this->belongsTo(self::class, 'base_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function reator()
    {
        return $this->belongsTo(self::class, 'reator_id');
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function estoques()
    {
        return $this->hasMany(\App\Models\Estoque::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function entradas()
    {
        return $this->hasMany(\App\Models\EntradaMaterial::class); 
    }

    /**
     * Programações relacionadas a esse material.
     *
     * @return Collection
     **/
    public function programacoes()
    {
        return $this->estoques()->with('programacao')->get()->pluck('programacao');
    }

    /**
     * Acessor para conseguir obter as programacoes desse material como propriedade.
     *
     * @return Collection
     */
    public function getProgramacoesAttribute()
    {
        return $this->programacoes();
    }

    /**
     * Acessor para a informação de Tipo de Material.
     *
     * @return int
     */
    public function getTipoMaterialNomeAttribute()
    {
        if ($this->tipoMaterial) {
            return $this->tipoMaterial->nome;
        }
    }

    /**
     * Acessor para a informação de tipo do Tipo de Material.
     *
     * @return int
     */
    public function getTipoMaterialTipoAttribute()
    {
        if ($this->tipoMaterial) {
            return $this->tipoMaterial->tipo;
        }
    }

    /**
     * Acessor para a informação de Potencia.
     *
     * @return int
     */
    public function getPotenciaValorAttribute()
    {
        if ($this->potencia) {
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
        if ($this->tensao) {
            return $this->tensao->valor;
        }
    }

    /**
     * Acessor para a informação de Base.
     *
     * @return int
     */
    public function getBaseNomeAttribute()
    {
        if ($this->base) {
            return $this->base->nomePotenciaTensao;
        }
    }

    /**
     * Acessor para a informação de Reator.
     *
     * @return int
     */
    public function getReatorNomeAttribute()
    {
        if ($this->reator) {
            return $this->reator->nomePotenciaTensao;
        }
    }

    /**
     * Acessor para obter uma string com 'Nome - Potencia W - Tensão V'.
     *
     * @return string
     */
    public function getNomePotenciaTensaoAttribute()
    {
        $reatorTipo = ! is_null($this->tipo_reator_qtde) && ! is_null($this->potenciaValor) ? "$this->tipo_reator_qtde".'x'."$this->potenciaValor" : '';
        $nome = ! is_null($this->nome) ? $this->nome : "$this->tipoMaterialTipo - $this->tipoMaterialNome";
        $potencia = ! is_null($this->potenciaValor) ? "- $this->potenciaValor W" : '';
        $tensao = ! is_null($this->tensaoValor) ? "- $this->tensaoValor V" : '';
        $base = ! is_null($this->baseNome) ? "- Base $this->baseNome" : '';

        $reator = ! is_null($this->reatorNome) ? "- Reator $this->reatorNome" : '';

        return "$nome $reatorTipo $potencia $tensao $base $reator";
    }
}
