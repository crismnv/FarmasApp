<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\ReniecApi;

class DniController extends Controller
{
    public function getUsuario($dni)
    {

    	$valor = new ReniecApi();
    	$usuario = $valor->buscarDni($dni);
    	return $usuario;
    }
}
