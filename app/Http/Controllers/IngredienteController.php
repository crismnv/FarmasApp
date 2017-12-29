<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
class IngredienteController extends Controller
{
    //
    public function MostrarCrud()
    {
    	return view('adminlte::ingredientes.ingrediente_crud');
    }

    public function ListarIngredientes(Request $request)
    {
    	$datos = $request->all();
    	return Ingrediente::ListarIngredientes($datos);
    }

    public function AñadirIngrediente()
    {
    	return view('adminlte::ingredientes.ingrediente_añadir');
    }

    public function GuardarIngrediente(Request $request)
    {
    	$data = $request->all();
    	$bresultado = Ingrediente::GuardarIngrediente($data);
    	 if ($bresultado) 
    	 {
            // Exito
            return redirect()->back()->with('status','Los Datos han sido guardados exitosamente');
            //echo "Grabacion Correcta";
        } else {
                
            //echo "Grabacion no realizada";    
            return redirect()->back()->with('errors','Los Datos no han sido guardados correctamente.');

        }
    } 
}
