<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Trabajador;

class UsuarioController extends Controller
{
    //
    public function MostrarModificarUsuario($id)
    {
    	$usuario = Cliente::ListarCliente_x_IdUsuario($id);
    	if (count($usuario) == 0) 
    	{
	    	$usuario = Trabajador::ListarTrabajador_x_IdUsuario($id);
    	}
    	// var_dump($usuario);
    	return view('adminlte::usuarios.usuarios_modificar', compact('usuario'));
    }

    public function GuardarModificarUsuario(Request $request)
    {
    	$data= $request->all();

        // dd($data);

    	$bresultado = Cliente::ModificarCliente($data);

        if (!$bresultado) 
        {
        	
    		$bresultado = Trabajador::ModificarTrabajador($data);
        }

        if ($bresultado) {
            
            return redirect('admin/users')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('admin/users')->with('errors','La Datos No se actualizaron correctamente.');

        }
    }
}
