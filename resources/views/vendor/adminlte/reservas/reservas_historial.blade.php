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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-list" aria-hidden="true"></i>&nbsp;HISTORIAL DE  RESERVAS&nbsp;<i class="fa fa-list" aria-hidden="true"></i></strong></h3>  

                    <div class="table-responsive" id="lista-personanatural">
                        <table class="table table-hover" id="tbl-ingredientes">
						  <thead>
						     <tr>
						      {{-- <th class="text-center" style="vertical-align:middle;" data-column-id="id" data-type="numeric">ID</th> --}}
						      {{-- <th class="text-center" style="vertical-align:middle;" data-column-id="nombres">Nombres</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="apellidos">Apellidos</th> --}}
						      <th class="text-center" style="vertical-align:middle;" data-column-id="descripcion">Descripcion del Preparado</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="fecha">Fecha</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="estado_reserva">Estado de la Reserva</th>
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
				<p>¿Estas seguro de que quieres desactivar la reserva?</p>
			</div> --}}
			<br>
			<div class="row color-azul">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="row">
						<div class="col-sm-12">
							<h4>¿Estas seguro de que quieres volver a pedir?</h4>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4 col-sm-offset-2">
							<button type="button" class="btn btn-default" onclick="volverAPedir($reserva_id);">        SI      </button>
						</div>
						<div class="col-sm-4 ">
							<button type="button" class="btn btn-default" onclick="ocultarVentana(); ">        NO        </button>
						</div>
					</div>
				</div>
			</div>
		

		{{-- <button type="button" class="btn btn-default" onclick="ocultarVentana();">button</button> --}}
	</div>

	

		{{-- <button type="button" class="btn btn-default" onclick="ocultarVentana();">button</button> --}}
	</div>
	
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
			url:"../reservas/listar/historial",

			formatters: {

		        "commands": function(column, row)
		        {

		           
		            // console.log(row.estado)
		            

		            	return  "<button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" onclick=\"mostrarVentanaParaPedir(" + row.id +");\" data-target=\"#termsModal\"><i class=\"fa fa-copy\"  aria-hidden=\"true\"></i> Volver a Pedir</button>";
		            

		          
	           		
		        }
    		}
	});




});

    function mostrarVentanaParaPedir(row)
	{
		$reserva_id = row;
		var elemento = row;
	    var ventana = document.getElementById('miVentanaParaDesactivar');
	    ventana.style.marginTop = '150px';
	    ventana.style.left = ((document.body.clientWidth-300) / 2) +  'px';
	    ventana.style.display = 'block';

	    // console.log("mostrarVentana");
	    // console.log(row);
	    // volverAPedir(row)
	}

	function mostrarVentanaParaActivar(row)
	{
		$reserva_id = row;
		var elemento = row;
	    var ventana = document.getElementById('miVentanaParaActivar');
	    ventana.style.marginTop = '150px';
	    ventana.style.left = ((document.body.clientWidth-300) / 2) +  'px';
	    ventana.style.display = 'block';

	    // console.log("mostrarVentana");
	    // console.log(row);
	    // volverAPedir(row)
	}
	function ocultarVentana()
	{
	    // var ventana = document.getElementById('miVentanaParaActivar');
	    // ventana.style.display = 'none';
	    var ventana2 = document.getElementById('miVentanaParaDesactivar');
	    ventana2.style.display = 'none';
	}
	

	function volverAPedir(in_id)
	{
	 //    console.log("volverAPedir");
		// console.log(in_id)
		jQuery.ajax({
					url: '/reservas/RePedir/' + in_id,
					type: 'POST',
					data: {id: in_id,
						 "_token": "{{ csrf_token() }}",},
					success: function(respuesta){

					// ocultarVentana();	
				  window.location.replace("./historial");
				  }
				})
				.fail(function() {
		          // console.log(error);
		    })

		      event.preventDefault();
	}

	function activarIngrediente(in_id)
	{
	 //    console.log("volverAPedir");
		// console.log(in_id)
		jQuery.ajax({
					url: '/reservas/activar/' + in_id,
					type: 'POST',
					data: {id: in_id,
						 "_token": "{{ csrf_token() }}",},
					success: function(respuesta){

					// ocultarVentana();	
				  window.location.replace("./historial");
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