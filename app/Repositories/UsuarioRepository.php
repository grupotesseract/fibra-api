<?php

namespace App\Repositories;

use App\Models\Usuario;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class UsuarioRepository.
 * @version August 30, 2019, 9:38 pm -03
 */
class UsuarioRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'email',
        'email_verified_at',
        'password',
        'telefone',
        'endereco',
        'cidade_id',
        'remember_token',
    ];

    /**
     * Return searchable fields.
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model.
     **/
    public function model()
    {
        return Usuario::class;
    }

    /**
     * Cria o usuário e então associa o App\Models\Role.
     *
     * @return App\Models\Usuario
     */
    public function create($input)
    {
        $model = parent::create($input);

        //Se vier role, associar.
        if ($input['role_id']) {
            $model->roles()->sync([$input['role_id']]);
        }
    }

    /**
     * Faz o update do usuário e entao associa ao Role
     *
     * @return App\Models\Usuario
     */
    public function update($input, $id)
    {
        $model = parent::update($input, $id);

        //Se vier role, associar.
        if ($input['role_id']) {
            $model->roles()->sync([$input['role_id']]);
        }
    }

    /**
     * Autenticação via API.
     *
     * @return \Illuminate\Http\Response
     * @return Response
     */
    public function login($usuario, $request)
    {
        if (Hash::check($request->password, $usuario->password)) {
            $token = $usuario->createToken(env('PASSPORT_CLIENT', 'Laravel Password Grant Client'))->accessToken;
            $response = ['token' => $token];

            return $response;
        } else {
            return false;
        }
    }
}
