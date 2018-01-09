<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Image;

class ImageController extends Controller
{
    
    public static function GuardarImagen($imagen, $nombre)
    {
    	$random = str_random(10);
    	$path = 'reservas/'.$random.$nombre;
    	
    	$image = Image::make($imagen->getRealPath());
        $image->resize(500, 500);
    	$image->save($path);
    	return $random.$nombre;
    }
   

    public static function GuardarImagen150($imagen, $nombre)
    {
        $random = str_random(10);
        $path = 'img/personas/'.$random.$nombre;
        
        $image = Image::make($imagen->getRealPath());
        $image->resize(150, 150);
        $image->save($path);
        return $random.$nombre;
    }
}
