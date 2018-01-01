<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
class IngredienteController extends Controller
{
    //
    public function MostrarCrud(Request $request)
    {
    	// var_dump($request);
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

    public function ModificarGuardarIngrediente(Request $request)
	{
		$data= $request->all();

        // dd($data);

        $bresultado = Ingrediente::EditarIngrediente($data);

        if ($bresultado) {
            
            return redirect('ingredientes/crud')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('ingredientes/crud')->with('errors','La Datos No se actualizaron correctamente.');

        }
	}

    public function ModificarIngrediente($id)
	{
		$ingrediente = Ingrediente::Listar_Ingrediente_Id($id);
		// dd($ingrediente);
		return view('adminlte::ingredientes.ingrediente_modificar', compact('ingrediente'));
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

    public function VerIngrediente($id)
    {
    	$ingrediente = Ingrediente::Listar_Ingrediente_Id($id);
		// dd($ingrediente);
		return view('adminlte::ingredientes.ingrediente_ver', compact('ingrediente'));
    } 

    public function DesactivarIngrediente($id)
    {

    	Ingrediente::DesactivarIngrediente($id);
    	// return 'true';

    }

    public function ActivarIngrediente($id)
    {
    	Ingrediente::ActivarIngrediente($id);
    }
}
