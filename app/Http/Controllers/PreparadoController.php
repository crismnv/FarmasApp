<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;
use App\Models\Preparado;
use App\Models\Contiene;
use Illuminate\Support\Facades\DB as DB;


class PreparadoController extends Controller
{
    //

     public function ModificarGuardarPreparado(Request $request)
     {
        $data= $request->all();

        // dd($data);

        try {
             DB::table('contiene')->where('preparado_id', '=', $data['id'])->delete();
             DB::table('preparados')->where('id', '=', $data['id'])->delete();
             $bresultado = Preparado::ModificarPreparado($data);
        } catch (\Exception $e) {
            $bresultado = false;
        }
        // dd($bresultado);
        // $bresultado = Preparado::ModificarPreparado($data);

        if ($bresultado) {
            
            return redirect('preparados/crud')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('preparados/crud')->with('errors','No se puede actualizar porque esta siendo usada  en una reserva.');

        }
     }
     public function ModificarPreparado($id)
     {
        $preparado = Preparado::Listar_Preparado_x_Id($id);
        $ingredientes = Contiene::Listar_Ingredientes_x_IdPreparado($id);
    	$ingredientestotales = Ingrediente::select('*')->get();
        // dd($ingredientes);
        return view('adminlte::preparados.preparados_modificar', compact('ingredientes', 'preparado', 'ingredientestotales'));

     }
     public function VerPreparado($id)
    {
        $preparado = Preparado::Listar_Preparado_x_Id($id);
        $ingredientes = Contiene::Listar_Ingredientes_x_IdPreparado($id);
        // dd($ingredientes);
        return view('adminlte::preparados.preparados_ver', compact('ingredientes', 'preparado'));
    } 
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
