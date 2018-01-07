<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as DB;
use App\Models\Contiene;


class ContieneController extends Controller
{
    //

    public function Listar_Ingredientes_x_IdPreparado($id)
    {
        return Contiene::Listar_Ingredientes_x_IdPreparado($id);
    }

    public function BuscarPreparado_x_Ingredientes($ingredientes, $cantidad)
    {
    	// $ingredientes = array(1, 2, 19);
    	
    	$cantidad_ingredientes = count($ingredientes);
    	//buscamos los preparados con el numero de ingredientes que coincidan
    	$preparados_base =  $this->BuscarPreparados_x_CantdadIngredientes($cantidad_ingredientes);

    	// $r = '';

    	//recorremos los preparados sacados de la base de datos que coinciden con el numero de ingredientes
    	foreach ($preparados_base as &$preparado_base) 
    	{

    		//por cada preparado sacamos sus ingredientes
    		$lista_ingredientes = DB::table('contiene')->select('contiene.preparado_id', 'ingrediente_id', 'cantidad')->where('contiene.preparado_id', $preparado_base->preparado_id)->get();
    		// dd($lista_ingredientes);
    		$bandera = 0;
    		$i = 0;
    		//comparamos sus ingredientes con los que tenemos en un doble bucle
    		foreach ($ingredientes as &$ingrediente) 
    		{

    			// $coinciden = False;
    			

    			foreach ($lista_ingredientes as $ingrediente_base ) 
    			{
    			 	if($ingrediente_base->ingrediente_id == $ingrediente && $ingrediente_base->cantidad == $cantidad[$i])
    			 	{
    			 		$bandera ++;
    			 	} 
    			}

    			$i++;  
    			
    		}

			if ($bandera == $cantidad_ingredientes)
			{
				return $preparado_base;
			}	
    		
    	}

    	return null;
    }

    public function BuscarPreparados_x_CantdadIngredientes(int $cantidad)
    {
    	//buscamos los preparados con el numero de ingredientes que coincidan

    	return DB::table('contiene')->select('preparado_id', 'preparados.descripcion', DB::raw('count(ingredientes.id) as \'cantidad_ingredientes\'') )->join('preparados', 'preparados.id', '=', 'contiene.preparado_id')->join('ingredientes', 'ingredientes.id', '=', 'contiene.ingrediente_id')->groupBy('preparados.id')->having('cantidad_ingredientes', $cantidad)->get();
    }

    public function prueba()
    {
    	// $data = $this->BuscarPreparado();
    	dd($this->BuscarPreparado_x_Ingredientes([1, 2, 3], [800, 10, 20]));
    }




}
