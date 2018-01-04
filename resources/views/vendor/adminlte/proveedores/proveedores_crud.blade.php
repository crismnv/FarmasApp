@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Listado de Clientes 
@endsection

@section('contentheader_title')
	
@endsection

@section('css')
<link rel="stylesheet" href="/css/jquery.bootgrid.min.css" type="text/css"> 
	<style>
	.sidebar-cruds
	        {
	            color: #f39c12;
	        }
		.fa-list
		{
			color: #009688;
		}
		.fa-eye,.fa-pencil
		{
			color: #fff;
		}
		.active>span,.active>
		{
			color: #fff  !important;
			background-color: #009688  !important;
			border-color: #009688  !important;
		}
		.content-wrapper
		{
    		background-color: #ffffff;
		}
		.color-azul
		{
			color: #337ab7;
		}

		thead>tr
		{
			color: #337ab7;
		}

		thead>tr
		{
			background-color: #009688 !important;
    		color: #fff !important;	
		}

		tr:hover
		{
    		background-color: #009688 !important;
    		color: #fff !important;
		}
		
		.bootgrid-table th:hover {
    		 background: #009688; 
		}
		.color-white
		{
			color: #fff !important;
		}

	</style>
@endsection

@section('script-inicio')
<script>

</script>
@endsection

@section('main-content')

	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-list" aria-hidden="true"></i>&nbsp; PROVEEDORES&nbsp;<i class="fa fa-list" aria-hidden="true"></i></strong></h3>  

                    <div class="table-responsive" id="lista-personanatural">
                        <table class="table table-hover" id="tbl-ingredientes">
						  <thead>
						     <tr>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="id" data-type="numeric">ID</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="ruc">RUC</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="razon_social">Razon Social</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="telefono">Telefono</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="correo">Correo</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="estado">estado</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="commands" data-formatter="commands" data-sortable="false">Acciones</th>
						    </tr>
						  </thead>
						  </table>
                    </div> 
        	</div>
		</div>

	</div>
	<div id="miVentanaParaDesactivar" class="container-fluid" style= "position: fixed; width: 350px; height: 150px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

			{{-- <div class="row">
				<p>¿Estas seguro de que quieres desactivar el ingrediente?</p>
			</div> --}}
			<br>
			<div class="row color-azul">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="row">
						<div class="col-sm-12">
							<h4>¿Estas seguro de que quieres desactivar el ingrediente?</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4 col-sm-offset-2">
							<button type="button" class="btn btn-default" onclick="desactivarProveedor($ingrediente_id);">        SI      </button>
						</div>
						<div class="col-sm-4 ">
							<button type="button" class="btn btn-default" onclick="ocultarVentana(); ">        NO        </button>
						</div>
					</div>
				</div>
			</div>
		

		{{-- <button type="button" class="btn btn-default" onclick="ocultarVentana();">button</button> --}}
	</div>

	<div id="miVentanaParaActivar" class="container-fluid" style= "position: fixed; width: 350px; height: 150px; top: 0; left: 0; font-family:Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 3px solid; background-color: #FAFAFA; color: #000000; display:none;">

			{{-- <div class="row">
				<p>¿Estas seguro de que quieres desactivar el ingrediente?</p>
			</div> --}}
			<br>
			<div class="row color-azul">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="row">
						<div class="col-sm-12">
							<h4>¿Estas seguro de que quieres activar el ingrediente?</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4 col-sm-offset-2">
							<button type="button" class="btn btn-default" onclick="activarProveedor($ingrediente_id);">        SI      </button>
						</div>
						<div class="col-sm-4 ">
							<button type="button" class="btn btn-default" onclick=" ocultarVentana(); ">        NO        </button>
						</div>
					</div>
				</div>
			</div>
		

		{{-- <button type="button" class="btn btn-default" onclick="ocultarVentana();">button</button> --}}
	</div>
	
	@include('adminlte::ingredientes.ingrediente_eliminar')
@endsection

@section('script-fin')
<script src="/js/jquery.bootgrid.min.js"></script>
<script>

$(document).ready(function()
{
	// var row = [];
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	var gridtable= $('#tbl-ingredientes').bootgrid({
			
			ajax:true,
			labels: {
		        noResults: "No Existen Resultados",
		        loading: "Cargando . . . ",
		    	all: "Todos",
		    	refresh: "Cargar",
		    	search:"Buscar"
		    },
			rowSelected:true,
			post:function(){
				 return {
				            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
				        };
			},
			url:"../proveedores/listar",

			formatters: {

		        "commands": function(column, row)
		        {

		            // return  "<a  class=\"btn btn-default btn-info\" href=\"../PersonaJuridica/Ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../PersonaJuridica/Editar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../ingredientes/añadir" + "\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i>&nbsp;</a>";
		            // return  "<a  class=\"btn btn-default btn-info\" href=\"../ingredientes/ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../ingredientes/modificar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a> <button type=\"button\" id=\"boton-eliminar\" class=\"btn  btn-default\"><i class=\"fa fa-minus-square\" aria-hidden=\"true\"></i></button>";
		            @role('admin')
		            console.log(row.estado)
		            if(row.estado == 'INACTIVO')
		            {

		            	return  "<a  class=\"btn btn-default btn-info\" href=\"../proveedores/ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../proveedores/modificar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a> <button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" onclick=\"mostrarVentanaParaActivar(" + row.id +");\" data-target=\"#termsModal\"><i class=\"fa fa-plus-square\"  aria-hidden=\"true\"></i></button>";
		            }else{

		            	return  "<a  class=\"btn btn-default btn-info\" href=\"../proveedores/ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../proveedores/modificar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a> <button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" onclick=\"mostrarVentanaParaDesactivar(" + row.id +");\" data-target=\"#termsModal\"><i class=\"fa fa-minus-square\"  aria-hidden=\"true\"></i></button>";
		            }

		            @else


		            if(row.estado == 'INACTIVO')
		            {

		            	return  "<a  class=\"btn btn-default btn-info\" href=\"../proveedores/ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../proveedores/modificar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a>";
		            }else{

		            	return  "<a  class=\"btn btn-default btn-info\" href=\"../proveedores/ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../proveedores/modificar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a>";
		            }

		            @endrole

	           		
		        }
    		}
	});




});

    function mostrarVentanaParaDesactivar(row)
	{
		$ingrediente_id = row;
		var elemento = row;
	    var ventana = document.getElementById('miVentanaParaDesactivar');
	    ventana.style.marginTop = '150px';
	    ventana.style.left = ((document.body.clientWidth-300) / 2) +  'px';
	    ventana.style.display = 'block';

	    // console.log("mostrarVentana");
	    // console.log(row);
	    // desactivarProveedor(row)
	}

	function mostrarVentanaParaActivar(row)
	{
		$ingrediente_id = row;
		var elemento = row;
	    var ventana = document.getElementById('miVentanaParaActivar');
	    ventana.style.marginTop = '150px';
	    ventana.style.left = ((document.body.clientWidth-300) / 2) +  'px';
	    ventana.style.display = 'block';

	    // console.log("mostrarVentana");
	    // console.log(row);
	    // desactivarProveedor(row)
	}
	function ocultarVentana()
	{
	    var ventana = document.getElementById('miVentanaParaActivar');
	    ventana.style.display = 'none';
	    var ventana2 = document.getElementById('miVentanaParaDesactivar');
	    ventana2.style.display = 'none';
	}
	

	function desactivarProveedor(in_id)
	{
	 //    console.log("desactivarProveedor");
		// console.log(in_id)
		jQuery.ajax({
					url: '/proveedores/desactivar/' + in_id,
					type: 'POST',
					data: {id: in_id,
						 "_token": "{{ csrf_token() }}",},
					success: function(respuesta){

					// ocultarVentana();	
				  window.location.replace("./crud");
				  }
				})
				.fail(function() {
		          // console.log(error);
		    })

		      event.preventDefault();
	}

	function activarProveedor(in_id)
	{
	 //    console.log("desactivarProveedor");
		// console.log(in_id)
		jQuery.ajax({
					url: '/proveedores/activar/' + in_id,
					type: 'POST',
					data: {id: in_id,
						 "_token": "{{ csrf_token() }}",},
					success: function(respuesta){

					// ocultarVentana();	
				  window.location.replace("./crud");
				  }
				})
				.fail(function() {
		          // console.log(error);
		    })

		      event.preventDefault();
	}

	

// function prueba() 
// 	{
// 		alert();
// 	}

</script>



@endsection