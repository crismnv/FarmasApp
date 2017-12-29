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
@endsection

@section('main-content')

	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-list" aria-hidden="true"></i>&nbsp; INGREDIENTES&nbsp;<i class="fa fa-list" aria-hidden="true"></i></strong></h3>  

                    <div class="table-responsive" id="lista-personanatural">
                        <table class="table table-hover" id="tbl-ingredientes">
						  <thead>
						     <tr>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="id" data-type="numeric">ID</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="nombre">Nombre</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="stock">Stock</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="unidad_de_medida">U. de Medida</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="estado">estado</th>
						      <th class="text-center" style="vertical-align:middle;" data-column-id="commands" data-formatter="commands" data-sortable="false">Acciones</th>
						    </tr>
						  </thead>
						  </table>
                    </div> 
        	</div>
		</div>
	</div>
	
	
</div>
@endsection

@section('script-fin')
<script src="/js/jquery.bootgrid.min.js"></script>
<script>

$(document).ready(function()
{
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
			url:"../ingredientes/listar",

			formatters: {

		        "commands": function(column, row)
		        {

		            // return  "<a  class=\"btn btn-default btn-info\" href=\"../PersonaJuridica/Ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../PersonaJuridica/Editar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../ingredientes/añadir" + "\"><i class=\"fa fa-plus\" aria-hidden=\"true\"></i>&nbsp;</a>";
		            return  "<a  class=\"btn btn-default btn-info\" href=\"../PersonaJuridica/Ver/" +   row.id + "\"><i class=\"fa fa-eye\" aria-hidden=\"true\"></i>&nbsp;</a><a  class=\"btn btn-default btn-danger\" href=\"../PersonaJuridica/Editar/" +   row.id + "\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>&nbsp;</a>";

	           		
		        }
    		}
	});

});

</script>

@endsection