<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Contiene;
use Illuminate\Support\Facades\DB as DB;

class Preparado extends Model
{
    //
    protected $table = 'preparados';
    public $primarykey = 'id';



    // public static function Listar 

    
    public static function ModificarPreparado($datos)
    {
        
        try {
            
             DB::beginTransaction();

            
                
             $codigo_preparado_generado = DB::table('Preparados')->insertGetId(
                        [
                            'descripcion' => $datos['descripcion'],
                            'precio'  =>  $datos['precio']
                        ]
                    );

                // Insertando Preparado.

                for ($i=0; $i < count($datos['idingrediente']); $i++) 
                { 

                    $cantidad = $datos['cantidad'][$i];                   
                    $ingrediente = $datos['idingrediente'][$i];

                    // $subtotal = floatval($datos['precio_venta'][$i])*intval($datos['cantidad'][$i]);

                        $contiene = new Contiene();

                        $contiene->preparado_id = $codigo_preparado_generado;
                        $contiene->ingrediente_id = $ingrediente;
                        $contiene->cantidad = $cantidad;


                        $contiene->save();

                        // Producto::ActualizarStockProducto($datos['idingrediente'][$i],$cantidad);

                        // $total = $total + $subtotal;


                }


            DB::commit();

            return true;  
        } catch (Exception $e) {
            DB::rollback();

            return false; 
        }
    }
    public static function Listar_Preparado_x_Id($id)
    {
        return Preparado::select('*')->where('id', $id)->get();
    }
    public static function DesactivarPreparado($id)
    {
         try {
            
            DB::beginTransaction();

            $Preparado = array('estado' => 'INACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Preparado::where('id',$id)
                            ->update($Preparado);

            DB::commit();

            $Preparado = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ActivarPreparado($id)
    {
         try {
            
            DB::beginTransaction();

            $Preparado = array('estado' => 'ACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Preparado::where('id',$id)
                            ->update($Preparado);

            DB::commit();

            $Preparado = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ListarPreparados($datos)
    {

        $query = '';
        
        $records_per_page = 10;
        
        $start_from = 0;
        
        $current_page_number = 0;

        if(isset($_POST["rowCount"]))
        {
         $records_per_page = $datos["rowCount"];
        }
        else
        {
         $records_per_page = 10;
        }

        if(isset($_POST["current"]))
        {
         $current_page_number = $datos["current"];
        }
        else
        {
         $current_page_number = 1;
        }

        $start_from = ($current_page_number - 1) * $records_per_page;
        
        $query .= " SELECT preparados.id, preparados.descripcion, 
                          preparados.precio,
                          preparados.estado
                    FROM preparados ";

        if(!empty($_POST["searchPhrase"]))
        {
         $query .= ' WHERE (preparados.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR preparados.descripcion LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR preparados.precio LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR preparados.estado LIKE "%'.$_POST["searchPhrase"].'%" )';
        }

        $order_by = '';

        if(isset($_POST["sort"]) && is_array($_POST["sort"]))
        {
         foreach($_POST["sort"] as $key => $value)
         {
          $order_by .= " $key $value, ";
         }
        }
        else
        {
         $query .= ' ORDER BY preparados.estado, preparados.id DESC ';
        }

        if($order_by != '')
        {
         $query .= ' ORDER BY ' . substr($order_by, 0, -2);
        }

        if($records_per_page != -1)
        {
         $query .= " LIMIT " . $start_from . ", " . $records_per_page .";";
        }


        $results = DB::select($query);


        $total_records = Preparado::count();


        $output = array(
         'current'  => intval($datos["current"]),
         'rowCount'  => $records_per_page,
         'total'   => intval($total_records),
         'rows'   => $results
        );

        $total_records = null;
        $query = null;
        $records_per_page = null;
        $order_by = null;
        $start_from = null;

        return json_encode($output);


    }
    public static function AñadirPreparado($datos)
    {
		try {
    		
             DB::beginTransaction();
    			
             $codigo_preparado_generado = DB::table('Preparados')->insertGetId(
		     			[
		     				'descripcion' => $datos['descripcion'],
		     				'precio'  =>  $datos['precio']
		     			]
				 	);

            	// Insertando Preparado.

				for ($i=0; $i < count($datos['idingrediente']); $i++) 
				{ 

					$cantidad = $datos['cantidad'][$i];                   
					$ingrediente = $datos['idingrediente'][$i];

					// $subtotal = floatval($datos['precio_venta'][$i])*intval($datos['cantidad'][$i]);

						$contiene = new Contiene();

						$contiene->preparado_id = $codigo_preparado_generado;
						$contiene->ingrediente_id = $ingrediente;
						$contiene->cantidad = $cantidad;


						$contiene->save();

						// Producto::ActualizarStockProducto($datos['idingrediente'][$i],$cantidad);

						// $total = $total + $subtotal;


				}


            DB::commit();

          	return true;  
    	} catch (Exception $e) {
    		DB::rollback();

            return false; 
    	}
    }
}
