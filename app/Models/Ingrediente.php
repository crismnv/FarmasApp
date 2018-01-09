<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
class Ingrediente extends Model
{
    //
    protected $table = 'ingredientes';
    public $primarykey = 'id';


    public static function DesactivarIngrediente($id)
    {
    	 try {
            
            DB::beginTransaction();

            $ingrediente = array('estado' => 'INACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Ingrediente::where('id',$id)
                            ->update($ingrediente);

            DB::commit();

            $ingrediente = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ActivarIngrediente($id)
    {
    	 try {
            
            DB::beginTransaction();

            $ingrediente = array('estado' => 'ACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Ingrediente::where('id',$id)
                            ->update($ingrediente);

            DB::commit();

            $ingrediente = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function Listar_Ingrediente_Id($id)
    {
    	return Ingrediente::select('ingredientes.id','ingredientes.precio_base' , 'ingredientes.nombre', 'ingredientes.stock', 'ingredientes.unidad_de_medida', 'ingredientes.estado')
    	->where('ingredientes.id', $id)->get();
    }

    public static function EditarIngrediente($data)
    {
    	 try {
            
            DB::beginTransaction();

            $ingrediente = array('nombre' => $data['nombre'],
                                    'unidad_de_medida' => $data['unidad_de_medida'],
                                    'stock' => $data['stock'],
                                    'estado' => $data['estado'],
                                    'precio_base' => $data['precio_base']
                                    );


           // $productos = array('precio' => 9999999);
            Ingrediente::where('id', $data['id'])
                            ->update($ingrediente);

            DB::commit();

            $ingrediente = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
    public static function GuardarIngrediente($datos)
    {
    	try
         {
            DB::beginTransaction();
            $ingrediente = new Ingrediente();
            $ingrediente->nombre = $datos['nombre'];	
            $ingrediente->unidad_de_medida = $datos['unidad_de_medida'];	
            $ingrediente->stock = $datos['stock'];  
            $ingrediente->precio_base = $datos['precio_base'];	
            $ingrediente->created_at = date_create()->format('Y-m-d H:i:s');
			$ingrediente->updated_at = date_create()->format('Y-m-d H:i:s');	
			$ingrediente->save();

          	DB::commit();

          	return true;  

         } catch(Exception $e)
         {
            DB::rollback();

            return false; 

    	 }
    }
    public static function ListarIngredientes($datos)
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
        
        $query .= " SELECT ingredientes.id, ingredientes.nombre, 
                          ingredientes.unidad_de_medida,
                          ingredientes.precio_base,
                          ingredientes.estado,
                          ingredientes.stock
                    FROM ingredientes ";

        if(!empty($_POST["searchPhrase"]))
        {
         $query .= ' WHERE (ingredientes.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.nombre LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.stock LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.precio_base LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.unidad_de_medida LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.estado LIKE "%'.$_POST["searchPhrase"].'%" )';
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
         $query .= ' ORDER BY ingredientes.estado, ingredientes.id DESC ';
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


        $total_records = Ingrediente::count();


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
}
