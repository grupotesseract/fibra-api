<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ManutencaoCivilEletrica.
 * @version March 20, 2020, 2:54 pm -03
 *
 * @property \App\Models\Planta planta
 * @property string data_hora_entrada
 * @property string data_hora_saida
 * @property string data_hora_inicio_lem
 * @property string data_hora_final_lem
 * @property string data_hora_inicio_let
 * @property string data_hora_final_let
 * @property string data_hora_inicio_atividades
 * @property int planta_id
 */
class ManutencaoCivilEletrica extends Model
{
    use SoftDeletes;

    public $table = 'manutencoes_civil_eletrica';

    protected $dates = [
        'deleted_at',
        'data_hora_entrada',
        'data_hora_saida',
        'data_hora_inicio_lem',
        'data_hora_final_lem',
        'data_hora_inicio_let',
        'data_hora_final_let',
        'data_hora_inicio_atividades',
    ];

    public $fillable = [
        'problemas_encontrados',
        'informacoes_adicionais',
        'observacoes',
        'obra_atividade',
        'equipe_cliente',
        'data_hora_entrada',
        'data_hora_saida',
        'data_hora_inicio_lem',
        'data_hora_final_lem',
        'data_hora_inicio_let',
        'data_hora_final_let',
        'data_hora_inicio_atividades',
        'it',
        'lem',
        'let',
        'os',
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
        'problemas_encontrados' => 'required',
        'informacoes_adicionais' => 'required',
        'observacoes' => 'required',
        'obra_atividade' => 'required',
        'equipe_cliente' => 'required',
        'data_hora_entrada' => 'required',
        'data_hora_saida' => 'required',
        'data_hora_inicio_atividades' => 'required',
        'planta_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function planta()
    {
        return $this->belongsTo(\App\Models\Planta::class, 'planta_id');
    }

    /**
     * Relacionamento com Atividades Realizadas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function atividadesRealizadas()
    {
        return $this->hasMany(\App\Models\AtividadeRealizada::class, 'manutencao_id');
    }

    /**
     * Relacionamento com Usuarios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarios()
    {
        return $this->hasMany(\App\Models\UsuarioManutencao::class, 'manutencao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function fotos()
    {
        return $this->hasMany(\App\Models\FotoRdo::class, 'manutencao_id');
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraEntradaAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_entrada'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraSaidaAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_saida'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraInicioLemAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_inicio_lem'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraFinalLemAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_final_lem'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraInicioLetAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_inicio_let'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraFinalLetAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_final_let'] = $dataDB;
    }

    /**
     * Mutator pra data.
     *
     * @param Carbon $value
     * @return Carbon
     */
    public function setDataHoraInicioAtividadesAttribute($value)
    {
        if (! is_null($value)) {
            if (strpos($value, 'T')) {
                $dataDB = \Carbon\Carbon::parse($value)->setTimezone(-3);
            } else {
                $dataDB = \Carbon\Carbon::parse($value);
            }
        } else {
            $dataDB = null;
        }

        $this->attributes['data_hora_inicio_atividades'] = $dataDB;
    }
}
