<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estoque
 * @package App\Models
 * @version October 23, 2019, 7:50 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Material material
 * @property integer material_id
 * @property integer programacao_id
 * @property integer quantidade_inicial
 * @property integer quantidade_final
 */
class Estoque extends Model
{
    use SoftDeletes;

    public $table = 'estoque';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'material_id',
        'programacao_id',
        'quantidade_inicial',
        'quantidade_final'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'material_id' => 'integer',
        'programacao_id' => 'integer',
        'quantidade_inicial' => 'integer',
        'quantidade_final' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'material_id' => 'required',
        'programacao_id' => 'required',
        'quantidade_inicial' => 'required',
        'quantidade_final' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programacao()
    {
        return $this->belongsTo(\App\Models\Programacao::class, 'programacao_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function material()
    {
        return $this->belongsTo(\App\Models\Material::class, 'material_id');
    }
}
