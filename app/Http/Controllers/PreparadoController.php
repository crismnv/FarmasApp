<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Preparado;
use Illuminate\Support\Facades\DB as DB;


class PreparadoController extends Controller
{
    //

	 public function DesactivarPreparado($id)
    {

    	Preparado::DesactivarPreparado($id);
    	// return 'true';

    }

    public function ActivarPreparado($id)
    {
    	Preparado::ActivarPreparado($id);
    }

	 public function ListarPreparados(Request $request)
    {
    	$datos = $request->all();
    	return Preparado::ListarPreparados($datos);
    }

	public function MostrarCrud(Request $request)
    {
    	// var_dump($request);
    	return view('adminlte::preparados.preparados_crud');
    }

    public function AñadirPreparado()
    {
    	$ingredientes = Ingrediente::select('*')->get();
    	return view('adminlte::preparados.preparados_añadir', compact('ingredientes'));
    }

    public function AñadirGuardarPreparado(Request $request)
    {
    	$data = $request->all();
    	// dd($data);
    	$bresultado = Preparado::AñadirPreparado($data);

    	 if ($bresultado) {
            
            return redirect('preparados/crud')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('preparados/crud')->with('errors','La Datos No se actualizaron correctamente.');

        }

    }


}
