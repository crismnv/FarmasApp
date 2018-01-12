@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection
@section('contentheader_title')
@endsection

@section('css')
	<style>.sidebar-ventas
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
		.fa-pencil-square
	    {
			color: #009688;
	    }
	    .boton-azul
		{
			background-color: #E64A19;
			color: #ffffff;
		}
		.form-control[readonly]{
		    background-color: #ffffff;
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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; Añadir Preparado&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('preparados/añadir')}}" accept-charset="UTF-8" class="" id="FormPreparado">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-sm-5 ">
                          <label class="color-azul ">Nombre</label>

                          <input type="text" class="form-control text-left"  id="descripcion" name="descripcion"  required placeholder="Descripcion" maxlength="250" >
                          <span  id ="ErrorMensaje-descripcion" class="help-block" ></span>
                        </div>


                        <div class="col-sm-5 col-sm-offset-1">
                          <label class="color-azul ">Precio</label>

                          <input type="number" read class="form-control text-left"  id="precio" name="precio"  required placeholder="Precio" maxlength="250" >
                          <span  id ="ErrorMensaje-precio" class="help-block" ></span>
                        </div>
                    </div>

                    <div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                    			<div class="col-lg-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="color-azul">Ingredientes</label>
										<select name="pidingrediente"  id="pidingrediente" class="form-control selectpicker" data-live-search="true">
											@foreach($ingredientes as $ingrediente)
							            	 <option value="{{$ingrediente->id}}_{{$ingrediente->unidad_de_medida}}">{{$ingrediente->nombre}}</option>
							            	@endforeach
						            	</select>				
									</div>
								</div>

			                    <div class="col-lg-2 col-sm-2 col-xs-12">
									<div class="form-group">
						            	<label class="color-azul">Cantidad</label>
						            	<input type="number" name="pcantidad" id="pcantidad" class="form-control text-center" placeholder="Cantidad">
						            </div>
								</div>

			                    <div class="col-lg-2 col-sm-2 col-xs-12">
									<div class="form-group">
						            	<label class="color-azul">Unidad de Medida</label>
						            	<input type="text" name="punidad_de_medida" id="punidad_de_medida" class="form-control text-center" placeholder="Cantidad" readonly  value="{{$ingredientes[0]->unidad_de_medida}}">
						            </div>
								</div>

								<div class="col-lg-2 col-sm-2 col-xs-12">
									<div class="form-group">
										{{-- <br>
										<br> --}}
										<label style="color: #FFF;">.</label>
										<br>
						            	<button class="btn btn-primary" type="button" id="boton_agregar">Agregar</button>
						            	<span class="help-block" id="mensaje-validacion"></span>
							            	
						          	</div>
								</div>



								<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 table-responsive">
									<table id="lista_ingredientes" class="table table-striped table-bordered table-condensed">
										<thead  style="background-color:#00a65a; color:#fff;">

											<th style="vertical-align:middle;text-align:center;">Accion</th>
											<th style="vertical-align:middle;text-align:center;">Ingrediente</th>
											<th style="vertical-align:middle;text-align:center;">Cantidad</th>
											<th style="vertical-align:middle;text-align:center;">Unidad De Medida</th>
										{{-- 	<th style="vertical-align:middle;text-align:center;">Descuento</th>
											<th style="vertical-align:middle;text-align:center;">Subtotal</th> --}}

										</thead>
										{{-- <tfoot class="">
											<th class="color-azul">TOTAL</th>
											<th><h4 class="color-azul" id="total">0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th>
											<th><h4>Nuevos Soles</h4></th>
										</tfoot> --}}

										<tbody>

										</tbody>
									</table>
								</div>

                    		</div>

                    		<div class="panel-footer">
                    			<div class="row">
									<div class=" col-xs-8 col-xs-offset-2" id="guardar" name="guardar">
										<div class="form-group">
								            	<button class="btn btn-primary btn-block" id="boton" style="display: none;" type="submit">Guardar</button>
								        </div>
									</div>
								</div>
                    		</div>
                    	</div>
                    </div>




					{{-- <tr class="selected text-center" id =></tr> --}}


	          </form>
        	</div>
		</div>
	</div>

@endsection

@section('script-fin')
<script>
	// $(document).ready(function(){
	// 	evaluar();
	// }

	$('#descripcion').on("keypress", function(){
		$("#ErrorMensaje-descripcion").hide();

	}) 

	$('#precio').on("keypress", function(){
		$("#ErrorMensaje-precio").hide();

	}) 




	$('#boton').click( function()
	{
		var descripcion = $('#descripcion').val().trim();

		if( descripcion == null || descripcion.length == 0)
		{
			descripcion = null;
			$("#ErrorMensaje-descripcion").text("Este campo no puede estar vacio");
			$("#ErrorMensaje-descripcion").show();
			$("#descripcion").focus();	
			// alert();
			return false;
		}

		var precio = $('#precio').val().trim();
		if(precio == null || precio.length == 0 )
		{
			$("#ErrorMensaje-precio").text("El precio no puede estar vacia");
			$("#ErrorMensaje-precio").show();
			$("#precio").focus();
			return false;
		}
		
		if(precio <= 0 || precio >=999999.99)
		{
			$("#ErrorMensaje-precio").text("Ingrese un numero valido");
			$("#ErrorMensaje-precio").show();
			$("#precio").focus();
			return false;
		}
	});


	function validar()
	{


		
	}




	var ingredientes = 0;
	var cont = 0;

	$('#FormPreparado').submit(function()
	{


		// jQuery.ajax({
		//   url: '/BuscarPreparado',
		//   type: 'POST',
		//   data: {ingredientes: 'asdasd'},
		//   success: function(data, textStatus, xhr) {
		//     //called when successful
		//   },
		//   error: function(xhr, textStatus, errorThrown) {
		//     //called when there is an error
		//   }
		// });
		// $('#lista_ingredientes tr').each(function() {
		//     console.log($(this).value()); 
		// });
		
		// console.log($('#idingrediente').value());

		// return false;
		if(ingredientes <= 0)
		{
			alert('Necesita haber ingresado por lo menos 1 ingrediente');
			return false;
		}
	});


	$('#boton_agregar').click(function()
		{
			data=document.getElementById('pidingrediente').value.split('_');
	    	
	    	var repetidos = document.querySelectorAll(".filaagregada");
                repetidos = [].slice.call(repetidos);

			repetido = false;     
		      $.each(repetidos, function( index, value ) {

		                    if (parseInt(repetidos[index].value) == data[0]) {
		                        repetidos = null;                       
		                        repetido = true;
		                    };

		                });
			if(repetido)
			{
				alert('No puede agregar ingredientes que ya estan en la lista');
			}else{
				agregar();
				
			}


		});

	$('#pidingrediente').change(function() {
		datos = document.getElementById('pidingrediente').value.split('_');
		unidad_de_medida = datos[1];
		$('#punidad_de_medida').val(unidad_de_medida);		
	});


	function limpiar()
	{
		$('#pcantidad').val('');
	}

	function evaluarRepetido()
	{
		data=document.getElementById('pidingrediente').value.split('_');
	    	
	    	var repetidos = document.querySelectorAll(".filaagregada");
                repetidos = [].slice.call(repetidos);

			repetido = false;     
		      $.each(repetidos, function( index, value ) {

		                    if (parseInt(repetidos[index].value) == data[0]) {
		                        repetidos = null;                       
		                        repetido = true;
		                    };

		                });
		return repetido;


	}
	function agregar()
	{
		datos = document.getElementById('pidingrediente').value.split('_');
		ingrediente_id = datos[0];
		cantidad = $('#pcantidad').val();
		unidad_de_medida = $('#punidad_de_medida').val();
		ingrediente =$("#pidingrediente option:selected").text();
		// alert(cantidad);
		console.log(cantidad);

		if(cantidad != "" && cantidad >= 1)
		{
			var fila = '<tr class="selected text-center" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" id="idingrediente[]" name="idingrediente[]" value="'+ingrediente_id+'" class="filaagregada">'+ingrediente+'</td><td><input type="number" id="cantidad[]" name="cantidad[]" value="'+cantidad+'" class="text-center" readonly></td><td><input type="text" name="unidad_de_medida[]" value="'+unidad_de_medida+'" class="text-center" readonly></td></tr>';
			cont++;
			ingredientes++;
    		limpiar();	
    		$('#lista_ingredientes').append(fila);
			$("#boton").show();
    		
		}else{
			alert('Ingrese una cantidad valida');

		}


		// alert(ingrediente_id);
	}
	function evaluar()
	{
		if (ingredientes>0)
		{
			$("#boton").show();
		}
		else
		{
		  $("#boton").hide(); 
		}

	}

	function eliminar(index){
	// total=total-subtotal[index]; 
	// $("#total").html("S/. " + total); 
	// $("#total_venta").val(total);
	$("#fila" + index).remove();
	ingredientes--;   
	evaluar();
	}
	
</script>
@endsection

