<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LiberacaoDocumento
 * @package App\Models
 * @version September 25, 2019, 2:34 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property integer programacao_id
 * @property string data_hora
 */
class LiberacaoDocumento extends Model
{
    use SoftDeletes;

    public $table = 'liberacoes_documentos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'programacao_id',
        'data_hora'
    ];

    protected $appends = ['data_hora_formatada'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'programacao_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'data_hora' => 'required'
    ];
 
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programacao()
    {
        return $this->belongsTo(\App\Models\Programacao::class, 'programacao_id');
    }
    
    
    /**
     * Acessor para Data Hora.
     *
     * @param string $value
     * @return Carbon
     */
    public function getDataHoraFormatadaAttribute()
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->data_hora)->format('d/m/Y H:i:s');
    }
}
