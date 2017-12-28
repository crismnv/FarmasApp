<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Role;

class Role_User extends Model
{
    protected $table = 'role_user';
    public $primarykey = 'id';


   	public static function asignarCliente($user_id)
   	{
   		// $rol_id = Role::obtenerId_x_rol('cliente');
   		// var_dump($rol_id['id']);
   		$role_user = new Role_user();
   		$role_user->user_id = $user_id;
   		$role_user->role_id = '2';
   		$role_user->save();
   		
   	}

   	public static function asignarAdmin($user_id)
   	{
   		$rol_id = Role::obtenerId_x_rol('admin');

   		$role_user = new Role_user();
   		$role_user->user_id = $user_id;
   		$role_user->role_id = $rol_id['id'][0];
   		$role_user->save();
   		
   	}

   	public static function asignarTrabajador($user_id)
   	{
   		$rol_id = Role::obtenerId_x_rol('trabajador');

   		$role_user = new Role_user();
   		$role_user->user_id = $user_id;
   		$role_user->role_id = $rol_id['id'][0];
   		$role_user->save();
   		
   	}

   	public static function asignarQuimico($user_id)
   	{
   		$rol_id = Role::obtenerId_x_rol('quimico');

   		$role_user = new Role_user();
   		$role_user->user_id = $user_id;
   		$role_user->role_id = $rol_id['id'];
   		$role_user->save();
   		
   	}
}
