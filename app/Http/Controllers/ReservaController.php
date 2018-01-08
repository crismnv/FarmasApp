<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Contiene;
use App\Models\Preparado;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;

class ReservaController extends Controller
{
    //


    public function Crear()
    {
        $preparados = Preparado::select('id' ,'descripcion')->get();

        if(Auth::user()->hasRole('cliente'))
        {
            $usuario_id = Auth::user()->id;
            $cliente = DB::table('clientes')->select('id')->where('user_id', $usuario_id)->get();
            // dd($cliente);
            // $cliente = DB::table('clientes')->select()->get();
            
            return view('adminlte::reservas.reservas_crear', compact('preparados', 'cliente'));

        }else{
            $clientes = DB::table('clientes')->select('id', 'nombres', 'apellido1', 'apellido2')->get();
            return view('adminlte::reservas.reservas_crear', compact('preparados', 'clientes'));
            
        }

    } 

    public function GuardarReserva(Request $request)
    {
        $data = $request->all();
                    
        // dd($data);
        $bresultado = Reserva::GuardarReserva($data);

        if ($bresultado) {
            if(Auth::user()->hasRole('cliente'))
                {
                    return redirect('reservas/historial')->with('status','La reserva ha sido creada.');
                }else{
                    
                    return redirect('reservas/crud')->with('status','La reserva ha sido creada.');
                }


        } else {
            if(Auth::user()->hasRole('cliente'))
                {
                    return redirect('reservas/historial')->with('errors','La reserva no ha podido ser creada.');
                }else{
                    
                    return redirect('reservas/crud')->with('errors','La reserva no ha podido ser creada.');
                }

        }

    }
    public function Modificar($id)
    {
        $reserva = Reserva::ListarReserva_x_Id($id);
        // $preparado = Preparado::Listar_Preparado_x_Id($id);
        // $preparado_id = DB::table('preparados')
        $ingredientes = Contiene::Listar_Ingredientes_x_IdPreparado($reserva[0]->preparado_id);
        // dd($reserva, $ingredientes);
        return view('adminlte::reservas.reservas_modificar', compact('reserva', 'ingredientes'));
    }

    public function ModificarGuardar(Request $request)
    {
        $data = $request->all();
        // dd($data);
       
        $bresultado =  Reserva::Modificar($data);

        if ($bresultado) {
            
            return redirect('reservas/crud')->with('status','Los Datos se actualizaron correctamente.');

        } else {
            
            return redirect('reservas/crud')->with('errors','La Datos No se actualizaron correctamente.');

        }
    }
    public function Ver($id)
    {
        $reserva = Reserva::ListarReserva_x_Id($id);
        // $preparado = Preparado::Listar_Preparado_x_Id($id);
        // $preparado_id = DB::table('preparados')
        $ingredientes = Contiene::Listar_Ingredientes_x_IdPreparado($reserva[0]->preparado_id);
        // dd($reserva, $ingredientes);
        return view('adminlte::reservas.reservas_ver', compact('reserva', 'ingredientes'));
    }
    public function prueba($reserva_id)
    {
        $reserva = Reserva::select('cliente_id', 'preparado_id')->where('id', $reserva_id);
        dd($reserva);

    }
    public function RePedir($reserva_id)
    {
        // $data = $request->all();
        Reserva::RePedir($reserva_id);
    }
    public function VerHistorial()
    {
        return view('adminlte::reservas.reservas_historial');
    }

    public function ListarHistorial(Request $request)
    {
        $datos = $request->all();

        //  $usuario_id = Auth::user()->id;
        // $usuario = DB::table('clientes')->select('*')->where('user_id', $usuario_id)->get()->toArray();

        // $total_records = DB::table('reservas')
        //              ->select(DB::raw('count(*)'))
        //              ->where('cliente_id',  intval($usuario[0]->id))
        //              ->get();
        // dd($total_records);
        return Reserva::ListarHistorial($datos);
        // $asd = Reserva::ListarHistorial($datos, $usuario_id);
        // dd($asd);
    }

    public function MostrarCrud()
    {
    	return view('adminlte::reservas.reservas_crud');
    }

    public function ListarReservas(Request $request)
    {
    	$datos = $request->all();
    	return Reserva::ListarReservas($datos);
    }

    public function DesactivarReserva($id)
    {

    	Reserva::DesactivarReserva($id);
    	// return 'true';

    }

    public function ActivarReserva($id)
    {
    	Reserva::ActivarReserva($id);
    }
}
