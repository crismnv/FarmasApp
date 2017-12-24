<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\ReniecApi;

class DniController extends Controller
{
    public function getUsuario(Request $Request)
    {
    	$valor = new ReniecApi();
    	$usuario = $valor->buscarDni('70660619');
    	dd($usuario);
    }
}
