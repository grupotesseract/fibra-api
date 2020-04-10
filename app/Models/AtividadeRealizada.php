<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AtividadeRealizada.
 * @version March 27, 2020, 3:31 pm -03
 *
 * @property \App\Models\ManutencaoCivilEletrica manutencao
 * @property string texto
 * @property bool status
 * @property int manutencao_id
 */
class AtividadeRealizada extends Model
{
    use SoftDeletes;

    public $table = 'atividades_realizadas';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'texto',
        'status',
        'manutencao_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'texto' => 'string',
        'status' => 'boolean',
        'manutencao_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'texto' => 'required',
        'status' => 'required',
        'manutencao_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function manutencao()
    {
        return $this->belongsTo(\App\Models\ManutencaoCivilEletrica::class, 'manutencao_id');
    }
}
