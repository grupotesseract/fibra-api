<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EntradaMaterial
 * @package App\Models
 * @version October 29, 2019, 12:14 am -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Material material
 * @property integer material_id
 * @property integer programacao_id
 * @property integer quantidade
 */
class EntradaMaterial extends Model
{
    use SoftDeletes;

    public $table = 'entradas_materiais';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'material_id',
        'programacao_id',
        'quantidade'
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
        'quantidade' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'material_id' => 'required',
        'programacao_id' => 'required',
        'quantidade' => 'required'
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
