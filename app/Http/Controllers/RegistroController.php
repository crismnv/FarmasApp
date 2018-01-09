<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisterController as RegistroLaravel;
use App\User;
use App\Models\Cliente;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    //

    public function mail()
    {
    	$reserva = Reserva::select('*')->where('id', '51')->get();
    	return view('adminlte::mail.mail', compact('reserva'));
    }
    public function registro()
    {
    	// return view('registro::registro');
    	return view('adminlte::registro.registro');
    }

    public function registrar(Request $request)
    {
	    	

        try {
        	$registroLaravel = new RegistroLaravel();
	    	$data = $request->all();
	    	// var_dump($data);
	    	$nombre = $data['nombres'] . " " . $data['apellido_paterno'] . " " . $data['apellido_materno'];

	    	$data_user = array(
	    		'name' => $nombre,
	    		'email' => $data['email'],
	    		'password' => $data['password'],
	    		 );

	    	$data_cliente = array(
	    		'nombres' => $data['nombres'], 
	    		'apellido1' => $data['apellido_paterno'], 
	    		'apellido2' => $data['apellido_materno'], 
	    		'telefono' => $data['telefono'], 
	    		'direccion' => $data['direccion'], 
	    		'dni' => $data['dni'], 
		    );

	    	$usuario = $registroLaravel->create($data_user);
	    	$id_usuario = $usuario['id'];


	    	
	    	$bresultado = Cliente::GuardarCliente($data, $id_usuario);
	    	

	        if ($bresultado && Auth::attempt(['email' => $data['email'] , 'password' => $data['password']])) 
        	{
	            
	            return redirect('/home');

	        } else {
	            
	            return redirect('/registro');

	        }
        	
        } catch (Exception $e) {
        	var_dump($e);
        }



    }
}
