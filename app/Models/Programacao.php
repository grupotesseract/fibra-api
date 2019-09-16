<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Stmt\TryCatch;

/**
 * Class Programacao
 * @package App\Models
 * @version September 13, 2019, 1:48 pm -03
 *
 * @property \App\Models\Planta planta
 * @property string data_inicio_prevista
 * @property string data_fim_prevista
 * @property string data_inicio_real
 * @property string data_fim_real
 * @property integer planta_id
 */
class Programacao extends Model
{
    use SoftDeletes;

    public $table = 'programacoes';
    

    protected $dates = [
        'deleted_at',         
    ];

    public $fillable = [
        'data_inicio_prevista',
        'data_fim_prevista',
        'data_inicio_real',
        'data_fim_real',
        'planta_id'
    ];
    

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'planta_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'data_inicio_prevista' => 'required',
        'data_fim_prevista' => 'required',
        'planta_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function planta()
    {
        return $this->belongsTo(\App\Models\Planta::class, 'planta_id');
    }

    /**
     * Mutator para o campo data_inicio_prevista    
     * 
     * @param string $value
     * @return Carbon
     */
    public function setDataInicioPrevistaAttribute($value)
    {
        try {
            \Carbon\Carbon::parse($value);
            $this->attributes['data_inicio_prevista'] = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('Y-m-d H:m');
        } catch (\Exception $e) {
            $this->attributes['data_inicio_prevista'] = \Carbon\Carbon::createFromFormat('d/m/Y H:m', $value);
        }
    }

    /**
     * Mutator para o campo data_fim_prevista
     *
     * @param string $value
     * @return Carbon
     */
    public function setDataFimPrevistaAttribute($value)
    {
        try {
            \Carbon\Carbon::parse($value);
            $this->attributes['data_fim_prevista'] = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('Y-m-d H:m');
        } catch (\Exception $e) {
            $this->attributes['data_fim_prevista'] = \Carbon\Carbon::createFromFormat('d/m/Y H:m', $value);
        }        
    }
    
    /**
     * Mutator para o campo data_inicio_real
     *
     * @param string $value
     * @return Carbon
     */
    public function setDataInicioRealAttribute($value)
    {
        try {
            \Carbon\Carbon::parse($value);
            $this->attributes['data_inicio_real'] = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('Y-m-d H:m');
        } catch (\Exception $e) {
            $this->attributes['data_inicio_real'] = \Carbon\Carbon::createFromFormat('d/m/Y H:m', $value);
        }
    }

    /**
     * Mutator para o campo data_fim_real
     *
     * @param string $value
     * @return Carbon
     */
    public function setDataFimRealAttribute($value)
    {
        try {
            \Carbon\Carbon::parse($value);
            $this->attributes['data_fim_real'] = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('Y-m-d H:m');
        } catch (\Exception $e) {
            $this->attributes['data_fim_real'] = \Carbon\Carbon::createFromFormat('d/m/Y H:m', $value);
        }
    }

    /**
     * Acessor para Data Inicio Prevista
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataInicioPrevistaAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('d/m/Y H:m');
    }

    /**
     * Acessor para Data Fim Prevista
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataFimPrevistaAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('d/m/Y H:m');
    }

    /**
     * Acessor para Data Inicio Real
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataInicioRealAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('d/m/Y H:m');
    }

    /**
     * Acessor para Data Fim Real
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataFimRealAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', $value)->format('d/m/Y H:m');
    }
}
