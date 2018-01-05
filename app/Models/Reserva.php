<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;

class Reserva extends Model
{
    //
    protected $table = 'reservas';
    public $primarykey = 'id';

    public static function DesactivarReserva($id)
    {
    	 try {
            
            DB::beginTransaction();

            $reserva = array('estado' => 'INACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Reserva::where('id',$id)
                            ->update($reserva);

            DB::commit();

            $reserva = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ActivarReserva($id)
    {
    	 try {
            
            DB::beginTransaction();

            $reserva = array('estado' => 'ACTIVO'
                                    );


           // $productos = array('precio' => 9999999);
            Reserva::where('id',$id)
                            ->update($reserva);

            DB::commit();

            $reserva = null;
            // $categorias = null;
                        
            return true;

        } catch (Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }

    public static function ListarReservas($datos)
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
        
        $query .= " SELECT reservas.id, clientes.nombres, CONCAT(clientes.apellido1, ' ', clientes.apellido2) as 'apellidos',preparados.descripcion, reservas.estado_reserva, reservas.fecha, reservas.estado
                    FROM reservas
                    	inner join clientes on clientes.id = reservas.cliente_id 
                        inner join preparados on preparados.id = reservas.preparado_id";

        if(!empty($_POST["searchPhrase"]))
        {
         $query .= ' WHERE (reservas.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR clientes.nombres LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR apellidos LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR preparados.descripcion LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.estado_reserva LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.fecha LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.estado LIKE "%'.$_POST["searchPhrase"].'%" )';
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
         $query .= ' ORDER BY reservas.id DESC ';
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


        $total_records = Reserva::count();


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
