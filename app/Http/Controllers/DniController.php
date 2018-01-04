<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\ReniecApi;
use Illuminate\Support\Facades\DB as DB;


class DniController extends Controller
{
    public function getUsuario($dni)
    {

    	$valor = new ReniecApi();
    	$usuario = $valor->buscarDni($dni);
    	return $usuario;
    }

    // public function sql()
    // {
    // 	DB::select('CALL array(\'21, 22\')');
    // 	$data = DB::table('clientes')->select('clientes.id', 'clientes.estado')->where('clientes.estado','INACTIVO')->get();
    // 	dd($data);
    // }
}

