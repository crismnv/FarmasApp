<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Support\Facades\Auth as Auth;
use App\Http\Controllers\ImageController;
use App\Mail\ClienteMail;
use App\Models\Ingrediente;
use App\Models\Preparado;
use Mail;

class Reserva extends Model
{
    //
    protected $table = 'reservas';
    public $primarykey = 'id';


    public static function GuardarReservaDetallado($datos)
    {
        try {
            
             DB::beginTransaction();

            
                
             $codigo_preparado_generado = DB::table('preparados')->insertGetId(
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


                
                $ruta_imagen = ImageController::GuardarImagen($datos['imagen'], "P=" . $codigo_preparado_generado . ";C=" . $datos['cliente_id']);
                $reserva = new Reserva();
                $reserva->cliente_id = $datos['cliente_id'];
                $reserva->preparado_id = $codigo_preparado_generado;
                $reserva->fecha= date_create()->format('Y-m-d');
                $reserva->imagen= $ruta_imagen;
                $reserva->created_at = date_create()->format('Y-m-d H:i:s');
                $reserva->updated_at = date_create()->format('Y-m-d H:i:s');
                $reserva->save();


            DB::commit();

            return true;  
        } catch (Exception $e) {
            DB::rollback();

            return false; 
        }
    }
    public static function Modificar($datos)
    {
      try {
            
            DB::beginTransaction();

            $reserva = array('estado_reserva' => $datos['estado_reserva']
                                    );


           // $productos = array('precio' => 9999999);
            Reserva::where('id',$datos['id'])
                            ->update($reserva);


//pendiente y aprobado
            if($datos['estado_reserva'] !=  'PENDIENTE' && $datos['estado_reserva'] != 'ENTREGADO')
            {
                $ReservaParaMail = Reserva::select('*')->where('id', $datos['id'])->get();
                
                // Mail::to($datos['email'])->send(new ClienteMail($ReservaParaMail[0]));
                
            }

            if($datos['estado_reserva'] == 'LISTO')
            {

                $reserva = Reserva::ListarReserva_x_Id($datos['id']);
                if(!Preparado::DescontarIngredientes_x_IdPreparado($reserva[0]->preparado_id))
                {
                    return false;       
                }
            }

            DB::commit();

            $reserva = null;
            // $categorias = null;
                        
            return true;

        } catch (\Exception $e) {
            // echo "<script>alert('2');<\script>";

            DB::rollback();
            return false;

        }
    }
    public static function Reporte($año, $mes)
    {
        if ($año == 0 || $mes == 0) 
        {
            return DB::select('call sp_reporte_reservas');
        }else{

           // return Reserva::join('clientes', 'clientes.id', 'reservas.cliente_id')
           //  ->join('preparados', 'preparados.id', 'reservas.preparado_id')
           //  ->select('reservas.id', 'clientes.apellido1', 'clientes.apellido2', 'preparados.descripcion', 'reservas.estado_reserva', 'reservas.fecha')
           //  ->where(DB::raw('year(reservas.fecha)'), $año)->get();
            return DB::select('call sp_reporte_reservas_mes(' . $año . ', ' . $mes .')');
        }
    }

    public static function GuardarReserva($datos)
    {
        try {

            // $usuario_id = Auth::user()->id;
            // $cliente = DB::table('clientes')->select('*')->where('user_id', $usuario_id)->get()->toArray();
            DB::beginTransaction();
            $ruta_imagen = ImageController::GuardarImagen($datos['imagen'], "P=" . $datos['preparados'] . ";C=" . $datos['cliente_id']);
            $reserva = new Reserva();
            $reserva->cliente_id = $datos['cliente_id'];
            $reserva->preparado_id = $datos['preparados'];
            $reserva->fecha= date_create()->format('Y-m-d');
            $reserva->imagen= $ruta_imagen;
            $reserva->created_at = date_create()->format('Y-m-d H:i:s');
            $reserva->updated_at = date_create()->format('Y-m-d H:i:s');
            $reserva->save();
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
    
    public static function ListarReserva_x_Id($id)
    {
        return Reserva::join('preparados', 'preparados.id', '=','reservas.preparado_id')
        ->join('clientes', 'clientes.id', '=', 'reservas.cliente_id')
        ->join('users', 'users.id', '=', 'clientes.user_id')
        ->select('users.email', 'reservas.imagen', 'preparados.descripcion','reservas.id' ,'clientes.nombres', 'clientes.apellido1', 'clientes.apellido2', 'preparados.precio', 'reservas.cliente_id', 'reservas.preparado_id', 'reservas.estado_reserva', 'reservas.fecha', 'reservas.fecha')->where('reservas.id', $id)->get();
    }
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
         $query .= 'OR clientes.apellido1 LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR clientes.apellido2 LIKE "%'.$_POST["searchPhrase"].'%" ';
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
         $query .= ' ORDER BY reservas.estado, reservas.id DESC ';
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


     public static function ListarHistorial($datos)
    {
        $usuario_id = Auth::user()->id;
        $usuario = DB::table('clientes')->select('*')->where('user_id', $usuario_id)->get()->toArray();

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
                        inner join preparados on preparados.id = reservas.preparado_id ";

        $query .= ' WHERE (clientes.id = ' . $usuario[0]->id . ' AND reservas.estado = \'ACTIVO\'' ;
        if(!empty($_POST["searchPhrase"]))
        {

         $query .= ' AND (reservas.id LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR clientes.nombres LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR apellidos LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR preparados.descripcion LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.estado_reserva LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.fecha LIKE "%'.$_POST["searchPhrase"].'%" ';
         $query .= 'OR reservas.estado LIKE "%'.$_POST["searchPhrase"].'%" )';
        }
        $query .= ')';

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
         $query .= ' ORDER BY reservas.estado, reservas.id DESC ';
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

        $tr = DB::table('reservas')
                     ->select(DB::raw('count(*) as conteo'))
                     ->where([['cliente_id', '=',  intval($usuario[0]->id)], ['estado', '=', 'ACTIVO']])
                     ->get();
        // $total_records = count($total_records);
        // $total_records = DB::table('reservas')->select(DB::raw('count(*)')->where('cliente_id', $usuario[0]->id)->get();
        // $total_records = 1;
        $total_records = $tr[0]->conteo;




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


    public static function RePedir($reserva_id)
    {

        $reserva = Reserva::select('cliente_id', 'preparado_id', 'imagen')->where('id', $reserva_id)->get();
        

        try {
            DB::beginTransaction();
            $nueva_reserva = new Reserva();
            $nueva_reserva->cliente_id = $reserva[0]->cliente_id;
            $nueva_reserva->preparado_id = $reserva[0]->preparado_id;
            $nueva_reserva->imagen = $reserva[0]->imagen;
            $nueva_reserva->fecha = date_create()->format('Y-m-d');
            $nueva_reserva->created_at = date_create()->format('Y-m-d H:i:s');
            $nueva_reserva->updated_at = date_create()->format('Y-m-d H:i:s');    
            $nueva_reserva->save();
            DB::commit();
            $reserva = null;
            $nueva_reserva = null;
            // $categorias = null;
                        
            return true;
            
        } catch (Exception $e) {
            DB::rollback();
            return false;
        }
    }

}
