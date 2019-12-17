<?php

namespace App\Models;

use Collective\Html\Eloquent\FormAccessible;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Programacao.
 * @version September 13, 2019, 1:48 pm -03
 *
 * @property \App\Models\Planta planta
 * @property string data_inicio_prevista
 * @property string data_fim_prevista
 * @property string data_inicio_real
 * @property string data_fim_real
 * @property int planta_id
 */
class Programacao extends Model
{
    use SoftDeletes, FormAccessible;

    public $table = 'programacoes';

    protected $dates = [
        'deleted_at',
        'data_inicio_prevista',
        'data_fim_prevista',
        'data_inicio_real',
        'data_fim_real',
    ];

    public $fillable = [
        'data_inicio_prevista',
        'data_fim_prevista',
        'data_inicio_real',
        'data_fim_real',
        'planta_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'planta_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'data_inicio_prevista' => 'required',
        'data_fim_prevista' => 'required',
        'planta_id' => 'required',
    ];

    public $appends = [
        'dataInicioPrevistaFormatada',
        'dataFimPrevistaFormatada',
        'dataInicioRealFormatada',
        'dataFimRealFormatada',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function planta()
    {
        return $this->belongsTo(\App\Models\Planta::class, 'planta_id');
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
    public function entradasMateriais()
    {
        return $this->hasMany(\App\Models\EntradaMaterial::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function quantidadesSubstituidas()
    {
        return $this->hasMany(\App\Models\QuantidadeSubstituida::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function liberacoesDocumentos()
    {
        return $this->hasMany(\App\Models\LiberacaoDocumento::class, 'programacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function datasManutencoes()
    {
        return $this->hasMany(\App\Models\DataManutencao::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comentarios()
    {
        return $this->hasMany(\App\Models\Comentario::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function fotos()
    {
        return $this->hasMany(\App\Models\Foto::class, 'programacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function comentariosGerais()
    {
        return $this->hasMany(\App\Models\ComentarioGeral::class, 'programacao_id');
    }

    /**
     * Acessor para Data Inicio Prevista formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataInicioPrevistaFormatadaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_inicio_prevista)->format('d/m/Y H:i:s');
    }

    /**
     * Acessor para Data Fim Prevista formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataFimPrevistaFormatadaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_fim_prevista)->format('d/m/Y H:i:s');
    }

    /**
     * Acessor para Data Inicio Real formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataInicioRealFormatadaAttribute()
    {
        if (! is_null($this->data_inicio_real)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_inicio_real)->format('d/m/Y H:i:s');
        }
    }

    /**
     * Acessor para Data Fim Real formatada.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataFimRealFormatadaAttribute()
    {
        if (! is_null($this->data_fim_real)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_fim_real)->format('d/m/Y H:i:s');
        }
    }
}
