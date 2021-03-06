<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RelatorioQuantidade.
 * @version January 9, 2020, 7:49 pm -03
 *
 * @property \App\Models\Programacao programacao
 * @property int programacao_id
 */
class RelatorioQuantidade extends Model
{
    use SoftDeletes;

    public $table = 'relatorios_quantidades';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'programacao_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'programacao_id' => 'integer',
    ];

    /**
     * Validation rules.
     *
     * @var array
     */
    public static $rules = [
        'programacao_id' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function programacao()
    {
        return $this->belongsTo(\App\Models\Programacao::class, 'programacao_id');
    }

    /**
     * Acessor para o nome do arquivo.
     */
    public function getNomeArquivoAttribute()
    {
        $data = $this->created_at->format('Y-m-d');
        $nomeArquivo = $data.'-PROG'.$this->programacao_id.'-QNTDS.xls';

        return $nomeArquivo;
    }

    /**
     * Acessor para o nome do arquivo no storage.
     */
    public function getPathExcelAttribute()
    {
        $pathStorage = 'relatorios-quantidades';
        $nomeArquivo = $this->nomeArquivo;

        return "$pathStorage/$nomeArquivo";
    }

    /**
     * Acessor para o nome do arquivo no storage.
     */
    public function getPathArquivoAttribute()
    {
        $pathStorage = 'relatorios-quantidades';
        $nomeArquivo = $this->nomeArquivo;

        return \Storage::path("$pathStorage/$nomeArquivo");
    }

    /**
     * Acessor para determinar se o arquivo existe.
     */
    public function getDisponivelAttribute()
    {
        return \File::exists($this->pathArquivo);
    }
}
