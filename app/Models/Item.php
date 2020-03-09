<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item.
 * @version September 12, 2019, 4:33 pm -03
 *
 * @property \App\Models\Planta planta
 * @property string nome
 * @property string qrcode
 * @property string circuito
 * @property int planta_id
 */
class Item extends Model
{
    use SoftDeletes;

    public $table = 'itens';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'nome',
        'qrcode',
        'circuito',
        'planta_id',
    ];

    public $appends = [
        'qrCodeNome',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'qrcode' => 'string',
        'circuito' => 'string',
        'planta_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'nome' => 'required',
        'qrcode' => 'required|unique:itens,qrcode,NULL,id,deleted_at,NULL',
        'circuito' => 'required',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function materiais()
    {
        return $this->belongsToMany(\App\Models\Material::class, 'itens_materiais', 'item_id', 'material_id')
            ->withPivot('quantidade_instalada');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quantidadesSubstituidas()
    {
        return $this->hasMany(\App\Models\QuantidadeSubstituida::class, 'item_id');
    }

    /**
     * Relacionamento com Fotos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fotos()
    {
        return $this->hasMany(\App\Models\Foto::class, 'item_id');
    }

    public function getQrCodeNomeAttribute()
    {
        return $this->qrcode.' - '.$this->nome;
    }
}
