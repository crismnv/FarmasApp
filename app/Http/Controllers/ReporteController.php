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

    public function CrearReporteUsuarios($tipo, $año, $mes)
    {
        if ($año == 0 || $mes == 0) 
        {
            $usuarios = DB::select('call sp_reporte_usuarios');
        }else{

           // return Reserva::join('clientes', 'clientes.id', 'reservas.cliente_id')
           //  ->join('preparados', 'preparados.id', 'reservas.preparado_id')
           //  ->select('reservas.id', 'clientes.apellido1', 'clientes.apellido2', 'preparados.descripcion', 'reservas.estado_reserva', 'reservas.fecha')
           //  ->where(DB::raw('year(reservas.fecha)'), $año)->get();
            $usuarios =  DB::select('call sp_reporte_usuarios_mes(' . $año . ', ' . $mes .')');
        }
        $vistaurl="adminlte::reportes.reportes_usuarios";
     
     	return $this->CrearUsuarioPDF($usuarios, $vistaurl,$tipo);

    }

    public function CrearReporteReservas($tipo, $año, $mes)
    {

        $vistaurl="adminlte::reportes.reportes_reservas";
        $reservas=Reserva::Reporte($año, $mes);
     
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
