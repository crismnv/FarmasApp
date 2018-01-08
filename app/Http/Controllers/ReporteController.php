<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB as DB;

use App\Models\Reserva;
// use App\Models\User;
use App\Models\Cliente;
use App\User;
use PDF;

class ReporteController extends Controller
{
    public function Ver()
    {
        // Funcion para reportes.
        return view("adminlte::reportes.reportes_ver",compact('reportes'));
    }

    public function CrearReporteUsuarios($tipo)
    {
    	$vistaurl="adminlte::reportes.reportes_usuarios";
        $usuarios=DB::select('call sp_reporte_usuarios');
     
     	return $this->CrearUsuarioPDF($usuarios, $vistaurl,$tipo);

    }

    public function CrearReporteReservas($tipo)
    {
        $vistaurl="adminlte::reportes.reportes_reservas";
        $reservas=Reserva::Reporte();
     
     return $this->CrearReservasPDF($reservas, $vistaurl,$tipo);

    }

    private function CrearUsuarioPDF($datos,$vistaurl,$tipo)
    {

        $usuarios = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('usuarios', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo=='ver'){return $pdf->stream('reporte');}
        if($tipo=='descargar'){return $pdf->download('reportes_usuarios.pdf'); }

    }

private function CrearReservasPDF($datos,$vistaurl,$tipo)
    {

        $reservas = $datos;
        $date = date('Y-m-d');
        $view =  \View::make($vistaurl, compact('reservas', 'date'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        if($tipo=='ver'){return $pdf->stream('reporte');}
        if($tipo=='descargar'){return $pdf->download('reportes_reservas.pdf'); }
        
    }
}
