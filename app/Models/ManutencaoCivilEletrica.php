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
        'os'
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
}
