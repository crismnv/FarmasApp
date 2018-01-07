<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\User;

class GraficaController extends Controller
{
    //
    public function getUltimoDiaMes($elAnio,$elMes) 
    {
        return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }	
    public function Reservas($anio, $mes)
    {
    	$primer_dia=1;
       $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
       $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
       $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
       $reservas=Reserva::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();

  
       $ct=count($reservas);
       for($d=1;$d<=$ultimo_dia;$d++){
           $registros[$d]=0;     
       }
       foreach($reservas as $reserva){
       $diasel=intval(date("d",strtotime($reserva->created_at) ) );
       $registros[$diasel]++;    
       }
       $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
       return   json_encode($data);
    }
    public function Registros($anio, $mes)
    {
    	 $primer_dia=1;
       $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
       $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
       $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
       $usuarios=User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();

  
       $ct=count($usuarios);
       for($d=1;$d<=$ultimo_dia;$d++){
           $registros[$d]=0;     
       }
       foreach($usuarios as $usuario){
       $diasel=intval(date("d",strtotime($usuario->created_at) ) );
       $registros[$diasel]++;    
       }
       $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
       return   json_encode($data);
    }

    public function Ver()
    {
        return view("adminlte::graficas.graficas_ver");
    }
}
