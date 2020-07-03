<?php

namespace App\Transformers;

use App\Models\Usuario;
use League\Fractal\TransformerAbstract;

class UsuarioTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Usuario $usuario)
    {
        return [
            'id' => $usuario->id,
            'login' => $usuario->login,
            'nome' => $usuario->nome,
            'role' => $usuario->roles->first()->name,
            'password' => $usuario->password,
            'passwordsha256' => $usuario->passwordsha256,
        ];
    }
}
