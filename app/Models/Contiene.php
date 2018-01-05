<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contiene extends Model
{
    //
    protected $table = 'contiene';
    public $primarykey = 'id';


    public static function Listar_Ingredientes_x_IdPreparado($id)
    {
    	return Contiene::select('*')->join('ingredientes', 'ingredientes.id', '=', 'contiene.ingrediente_id')->where('preparado_id', $id)->get();
    }

}
