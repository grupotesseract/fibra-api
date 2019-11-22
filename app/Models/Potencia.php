<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Potencia.
 * @version September 18, 2019, 3:48 pm -03
 *
 * @property int valor
 */
class Potencia extends Model
{
    use SoftDeletes;

    public $table = 'potencias';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'valor',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'valor' => 'string',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'valor' => 'required|unique:potencias,valor',
    ];
}
