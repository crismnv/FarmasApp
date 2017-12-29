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
}
