<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Foto
 * @package App\Models
 * @version November 22, 2019, 7:52 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property \App\Models\Item item
 * @property string cloudinary_id
 * @property string path
 * @property integer programacao_id
 * @property integer item_id
 */
class Foto extends Model
{
    use SoftDeletes;

    public $table = 'fotos';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'cloudinary_id',
        'path',
        'programacao_id',
        'item_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cloudinary_id' => 'string',
        'path' => 'string',
        'programacao_id' => 'integer',
        'item_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
        'item_id' => 'required'
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
    public function item()
    {
        return $this->belongsTo(\App\Models\Item::class, 'item_id');
    }
}
