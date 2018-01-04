<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Proveedor extends Model
{
    //
    protected $table = 'proveedores';
    public $primarykey = 'id';

    public static function DesactivarProveedor($id)
    {
    	 try {
            
            DB::beginTransaction();

            $Proveedor = array('estado' => 'INACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Proveedor::where('id',$id)
                            ->update($Proveedor);

            DB::commit();

            $Proveedor = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ActivarProveedor($id)
    {
    	 try {
            
            DB::beginTransaction();

            $Proveedor = array('estado' => 'ACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Proveedor::where('id',$id)
                            ->update($Proveedor);

            DB::commit();

            $Proveedor = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function GuardarProveedor($data)
    {
    	

		try
	         {
	            DB::beginTransaction();

	            $proveedor = new Proveedor();

		    	$proveedor->ruc = $data['ruc'];
		    	$proveedor->razon_social = $data['razon_social'];
		    	$proveedor->telefono = $data['telefono'];
		    	$proveedor->correo = $data['correo'];
		    	$proveedor->save();

	          	DB::commit();

	          	return true;  

	         } catch(Exception $e)
	         {
	            DB::rollback();

	            return false; 

	    	}

    }


    public static function EditarProveedor($data)
    {
    	try {
            
            DB::beginTransaction();

            $proveedor = array(
            	'ruc' => $data['ruc'],
            	'razon_social' => $data['razon_social'],
            	'razon_social' => $data['razon_social'],
            	'telefono' => $data['telefono'],
            	'telefono' => $data['telefono'],
            	'correo' => $data['correo'],
                'estado' => $data['estado']
                                    );


           // $productos = array('precio' => 9999999);
            Proveedor::where('id', $data['id'])
                            ->update($proveedor);

            DB::commit();

            $proveedor = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
    public static function ListarProveedor_x_Id($id)
    {
    	return Proveedor::select('*')->where('id',$id)->get();
    }
    public static function ListarProveedores($datos)
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
        
        $query .= " SELECT Proveedores.id, Proveedores.ruc, 
                          Proveedores.razon_social,
                          Proveedores.telefono,
                          CONCAT(SUBSTR(proveedores.correo ,1 ,25), '...') as 'correo',
                          Proveedores.estado
                    FROM Proveedores ";

        if(!empty($_POST["searchPhrase"]))
        {
         $query .= ' WHERE (Proveedores.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR Proveedores.ruc LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR Proveedores.razon_social LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR Proveedores.telefono LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR Proveedores.correo LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR Proveedores.estado LIKE "%'.$_POST["searchPhrase"].'%" )';
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
         $query .= ' ORDER BY Proveedores.id DESC ';
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


        $total_records = Proveedor::count();


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
