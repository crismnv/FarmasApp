<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Contiene;
use App\Models\Preparado;
use App\Models\Ingrediente;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;

class ReservaController extends Controller
{
    //


    public function CrearDetallado()
    {
        $ingredientes = Ingrediente::select('*')->get();
        // $preparados = Preparado::select('id' ,'descripcion')->get();

        if(Auth::user()->hasRole('cliente'))
        {
            $usuario_id = Auth::user()->id;
            $cliente = DB::table('clientes')->select('id')->where('user_id', $usuario_id)->get();
            // dd($cliente);
            // $cliente = DB::table('clientes')->select()->get();
            
            return view('adminlte::reservas.reservas_crear2', compact('ingredientes', 'cliente'));

        }else{
            $clientes = DB::table('clientes')->select('id', 'nombres', 'apellido1', 'apellido2')->get();
            return view('adminlte::reservas.reservas_crear2', compact('ingredientes', 'clientes'));
            
        }
    }
    public function GuardarReservaDetallado(Request $request)
    {
        $data = $request->all();
                    
        // dd($data);
        $bresultado = Reserva::GuardarReservaDetallado($data);

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

        $reserva = Reserva::select('cliente_id', 'preparado_id', 'imagen')->where('id', $reserva_id)->get();
        

        try {
            DB::beginTransaction();
            $nueva_reserva = new Reserva();
            $nueva_reserva->cliente_id = $reserva[0]->cliente_id;
            $nueva_reserva->preparado_id = $reserva[0]->preparado_id;
            $nueva_reserva->imagen = $reserva[0]->imagen;
            $nueva_reserva->fecha = date_create()->format('Y-m-d');
            $nueva_reserva->created_at = date_create()->format('Y-m-d H:i:s');
            $nueva_reserva->updated_at = date_create()->format('Y-m-d H:i:s');   
            dd($reserva, $nueva_reserva);   
            $nueva_reserva->save();
            DB::commit();
            $reserva = null;
            $nueva_reserva = null;
            // $categorias = null;
                        
            return true;
            
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }

    }
    public function RePedir($reserva_id)
    {
        // dd($reserva_id);
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
