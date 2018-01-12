<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Ingrediente;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB as DB;

class PedidoController extends Controller
{
    //
    public function MostrarCrud()
    {
    	
    }


    
    public function CrearGuardar(Request $request)
    {
    	$data= $request->all();
    	// dd($data);
    	$bresultado = Pedido::Guardar($data);
    	if ($bresultado) {
            
            return redirect('home')->with('status','Los Datos se guardaron correctamente.');

        } else {
            
            return redirect('home')->with('errors','No se pudo guardar.');

        }
    }
    public function Crear()
    {
        $ingredientes = Ingrediente::select('*')->get();

    	$proveedores = DB::table('proveedores')->select('*')->where('estado', '!=', 'INACTIVO')->get();
    	// dd($proveedores);
    	return view('adminlte::pedidos.pedidos_crear', compact('proveedores', 'ingredientes'));
    }


}
