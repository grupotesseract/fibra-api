<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RelatorioFotografico
 * @package App\Models
 * @version December 30, 2019, 10:11 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property integer programacao_id
 */
class RelatorioFotografico extends Model
{
    use SoftDeletes;

    public $table = 'relatorios_fotograficos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'programacao_id'
    ];

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
        'programacao_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programacao()
    {
        return $this->belongsTo(\App\Models\Programacao::class, 'programacao_id');
    }
}
