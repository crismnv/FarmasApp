<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
class ProveedorController extends Controller
{
    //

   public function VerProveedor($id)
    {
    	$proveedor = Proveedor::ListarProveedor_x_Id($id);
		// dd($Proveedor);
		return view('adminlte::proveedores.proveedores_ver', compact('proveedor'));
    } 
    public function MostrarCrud()
    {
    	return view('adminlte::proveedores.proveedores_crud');
    }
    public function ModificarProveedor($id)
    {
    	$proveedor = Proveedor::ListarProveedor_x_Id($id);
    	return view('adminlte::proveedores.proveedores_modificar', compact('proveedor'));
    }


    public function ModificarGuardarProveedor(Request $request)
	{
		$data= $request->all();

        // dd($data);

        $bresultado = Proveedor::EditarProveedor($data);

        if ($bresultado) {
            
            return redirect('proveedores/crud')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('proveedores/crud')->with('errors','La Datos No se actualizaron correctamente.');

        }
	}

    public function ListarProveedores(Request $request)
    {
    	$datos = $request->all();
    	return Proveedor::ListarProveedores($datos);
    }

    public function AñadirProveedor()
    {
    	return view('adminlte::proveedores.proveedores_añadir');
    }
    public function AñadirGuardarProveedor(Request $request)
    {

    	$data = $request->all();
    	$bresultado = Proveedor::GuardarProveedor($data);

        if ($bresultado) {
            
            return redirect('home')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('home')->with('errors','La Datos No se actualizaron correctamente.');

        }

    }

     public function DesactivarProveedor($id)
    {

    	Proveedor::DesactivarProveedor($id);
    	// return 'true';

    }

    public function ActivarProveedor($id)
    {
    	Proveedor::ActivarProveedor($id);
    }



}
