@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection
@section('contentheader_title')
@endsection

@section('css')
	<style>
	
		.sidebar-añadir
			{
				color: #f39c12;
			}
		.content-wrapper
			{
    			background-color: #ffffff;
			}
		.color-azul
			{
				color: #009688;
			}
		.fa-pencil-square
			{
				color: #00a65a;
			}
		.form-control
			{
				border-radius:4px;
			}
		.fa-bars
	    {
			color: #009688;
	    }
	    .boton-azul
		{
			background-color: #E64A19;
			color: #ffffff;
		}
		.form-control[readonly]{
		    background-color: #ff9800;
		    opacity: 1;
		    }
		#map_canvas
	  	{
	    	width:600px; 
	    	height:400px;
	    	border: 1px solid #337ab7 !important;
	  	}
		.help-block
		{
	  	    color: red;
		}
	 @media(max-width: 768px) 
	 	{
			#map_canvas
		  	{
		    	width:320px;
		  	}

		}
	</style>
@endsection

@section('script-inicio')
@endsection


@section('main-content')

<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Añadir Ingrediente&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('ingredientes/añadir')}}" accept-charset="UTF-8" class="" id="RegistroFormCategoria">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Nombre del Ingrediente:</label>

	                                          <input type="text" class="form-control text-left"  id="nombre" name="nombre"  required placeholder="Nombre de la Ingrediente" maxlength="250" >
	                                          <span  id ="ErrorMensaje-nombre" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Stock:</label>

	                                          <input type="number" name="stock" id="stock" class="form-control" placeholder="Cantidad" value="" min="0" max="999999" required="required" title="">

	                                          <span  id ="ErrorMensaje-stock" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>
	                                    
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Unidad de Medida:</label>

	                                          <input type="text" class="form-control text-left"  id="unidad_de_medida" name="unidad_de_medida"  required placeholder="Unidad de Medida" maxlength="20" >
	                                          <span  id ="ErrorMensaje-unidad_de_medida" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div> 
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Precio Base:</label>

	                                          <input type="number" class="form-control text-left"  id="precio_base" name="precio_base"  required placeholder="Precio Base" >
	                                          <span  id ="ErrorMensaje-precio_base" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>
	                                    
	                                   
                                   
	                                    <div class="row"> 
	                                      <div class="col-xs-6 col-xs-push-3">
	                                       <button type="submit" id="btnAñadirCategoria" class="btn btn-block pull-left boton-azul"><i class="fa fa-plus fa-2x" aria-hidden="true"></i><span style="font-size:20px;">&nbsp; Añadir Ingrediente</span></button>
	                                      
	                                      </div>
	                                      
	                                    </div>
	          </form>
        	</div>
		</div>
	</div>

@endsection

@section('script-fin')
<script>
	$('#nombre').on("keypress", function(){
		$("#ErrorMensaje-nombre").hide();

	}) 

	$('#stock').on("keypress", function(){
		$("#ErrorMensaje-stock").hide();

	}) 

	$('#unidad_de_medida').on("keypress", function(){
		$("#ErrorMensaje-unidad_de_medida").hide();

	}) 

	

	$('#btnAñadirCategoria').on("click", function(evt)
	{
		var nombre = $('#nombre').val().trim();

		if( nombre == null || nombre.length == 0)
		{
			nombre = null;
			$("#ErrorMensaje-nombre").text("El Nombre no puede ser vacio");
			$("#ErrorMensaje-nombre").show();
			$("#nombre").focus();	
			// alert();
			return false;
		}

		var stock = $('#stock').val().trim();
		if(stock == null || stock.length == 0 )
		{
			$("#ErrorMensaje-stock").text("La stock no puede ser vacia");
			$("#ErrorMensaje-stock").show();
			$("#stock").focus();
			return false;
		}
		
		if(stock <= 0 || stock >=999999.99)
		{
			$("#ErrorMensaje-stock").text("Ingrese un numero valido");
			$("#ErrorMensaje-stock").show();
			$("#stock").focus();
			return false;
		}

		var unidad_de_medida = $('#unidad_de_medida').val().trim();
		if(unidad_de_medida == null || unidad_de_medida.length == 0)
		{
			
			$("#ErrorMensaje-unidad_de_medida").text("La Unidad de Medida no puede ser vacia");
			$("#ErrorMensaje-unidad_de_medida").show();
			$("#unidad_de_medida").focus();
			return false;
		}
		
	});	

</script>
@endsection

