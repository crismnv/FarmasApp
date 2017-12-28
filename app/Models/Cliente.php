<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role_User;
use Illuminate\Support\Facades\DB as DB;

class Cliente extends Model
{
    //
    protected $table = 'clientes';
    public $primarykey = 'id';

    public static function GuardarCliente($data, $user_id)
    {
    	$cliente = new Cliente();

    	$cliente->nombres = $data['nombres'];
    	$cliente->apellido1 = $data['apellido_paterno'];
    	$cliente->apellido2 = $data['apellido_materno'];
    	$cliente->telefono = $data['telefono'];
    	$cliente->direccion = $data['direccion'];
    	$cliente->dni = $data['dni'];
    	$cliente->user_id = $user_id;
    	$cliente->save();

    	DB::table('role_user')->insert(['user_id' => $user_id, 'role_id' => '2']
);
    	// Role_User::asignarCliente($user_id);


    	return true;    
    }
}
