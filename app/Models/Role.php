<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    const ROLE_ADMIN = 1;
    const ROLE_TECNICO = 2;
    const ROLE_CLIENTE = 3;

    /**
     * Retorna um array de Roles no formato [id => 'nome'].
     *
     * @return array
     */
    public static function getArrayParaSelect()
    {
        return self::pluck('display_name', 'id')->all();
    }

}
