<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Trabajador extends Model
{
    //
    protected $table = 'trabajadores';
    public $primarykey = 'id';


    public static function ModificarTrabajador($data)
    {
    	 try {
            
            DB::beginTransaction();

            $trabajador = array(
                'nombres' => $data['nombres'],
                'apellido1' => $data['apellido_paterno'],
                'apellido2' => $data['apellido_materno'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion'],
                'estado' => $data['estado'],
                                    
                            );


           // $productos = array('precio' => 9999999);
            Trabajador::where('user_id', $data['user_id'])
                            ->update($trabajador);

            DB::commit();

            $trabajador = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
    public static function ListarTrabajador_x_IdUsuario($id)
    {
        return Trabajador::select('trabajadores.nombres', 'trabajadores.dni', 'trabajadores.id',  'trabajadores.user_id','trabajadores.apellido1', 'trabajadores.estado', 'trabajadores.apellido2', 'trabajadores.telefono', 'trabajadores.direccion')->where('trabajadores.user_id', $id)->get();

    }

    public static function EditarPersonaNatural($data)
    {
    	try {
                        DB::beginTransaction();

            $trabajador = array(
            	'nombres' => $data['nombres'],
            	'apellido1' => $data['apellido1'],
            	'apellido2' => $data['apellido2'],
            	'telefono' => $data['telefono'],
            	'direccion' => $data['direccion'],
            	'estado' => $data['estado'],
                                    );


           // $productos = array('precio' => 9999999);
            Trabajador::where('id', $data['id'])
                            ->update($trabajador);

            DB::commit();

            $trabajador = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
}
