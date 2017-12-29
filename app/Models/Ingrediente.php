<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
class Ingrediente extends Model
{
    //
    protected $table = 'ingredientes';
    public $primarykey = 'id';

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
                          ingredientes.estado
                    FROM ingredientes ";

        if(!empty($_POST["searchPhrase"]))
        {
         $query .= ' WHERE (ingredientes.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR ingredientes.nombre LIKE "%'.$_POST["searchPhrase"].'%" ';
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
         $query .= ' ORDER BY ingredientes.id DESC ';
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
