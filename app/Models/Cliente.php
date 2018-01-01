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


    public static function ModificarCliente($data)
    {
        try {
            
            DB::beginTransaction();

            $cliente = array(
                'nombres' => $data['nombres'],
                'apellido1' => $data['apellido_paterno'],
                'apellido2' => $data['apellido_materno'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'estado' => $data['estado'],
                                    
                            );


           // $productos = array('precio' => 9999999);
            Cliente::where('user_id', $data['user_id'])
                            ->update($cliente);

            DB::commit();

            $cliente = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
    

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

    	DB::table('role_user')->insert(['user_id' => $user_id, 'role_id' => '2']);
    	// Role_User::asignarCliente($user_id);


    	return true;    
    }

    public static function ListarCliente_x_IdUsuario($id)
    {
        return Cliente::select('clientes.nombres', 'clientes.id', 'clientes.dni', 'clientes.user_id', 'clientes.apellido1', 'clientes.apellido2', 'clientes.telefono', 'clientes.estado', 'clientes.direccion')->where('clientes.user_id', $id)->get();
    }
}
