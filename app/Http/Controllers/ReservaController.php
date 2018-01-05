<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;

class ReservaController extends Controller
{
    //

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
