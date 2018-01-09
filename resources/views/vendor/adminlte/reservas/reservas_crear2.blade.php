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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; RESERVA&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('reservas/crear/detallado')}}" accept-charset="UTF-8" class="" id="FormPreparado" enctype="multipart/form-data">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-sm-5 ">
                          <label class="color-azul ">Nombre del Preparado</label>

                          <input type="text" class="form-control text-left"  id="descripcion" name="descripcion"  required placeholder="Descripcion" maxlength="250" >
                          <span  id ="ErrorMensaje-descripcion" class="help-block" ></span>
                        </div>


                        <div class="col-sm-5 col-sm-offset-1">
                          <label class="color-azul ">Precio</label>

                          <input type="number" readonly="" class="form-control text-left"  id="precio" name="precio"  required placeholder="Calculado segun los ingredientes" value="0" maxlength="250" >
                          <span  id ="ErrorMensaje-precio" class="help-block" ></span>
                        </div>
                    </div>

                    <div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                    			@role('cliente')
                    			<div class="row" style="display: none;">
                    				<input type="number" name="cliente_id" id="" class="form-control" value="{{$cliente[0]->id}}" required="required" pattern="" title="" >
                    				
                    			</div>
                			@else
								<div class="row">
	                    				<div class="form-group col-xs-12 col-md-6 col-md-offset-3">
							            	<label class="color-azul">Cliente</label>
	                    					<select name="cliente_id" id="clientes" class="form-control" required="required">
		                    					@foreach($clientes as $cliente)
									            	 <option value="{{$cliente->id}}">{{$cliente->nombres . " " .$cliente->apellido1}}</option>
								            	@endforeach
	                    					</select>
	                    				</div>
	                    			</div>

	                    				

                			@endrole
                    			<br>
                    			<div class="col-lg-4 col-sm-4 col-xs-12">
									<div class="form-group">
										<label class="color-azul">Ingredientes</label>
										<select name="pidingrediente"  id="pidingrediente" class="form-control selectpicker" data-live-search="true">
											@foreach($ingredientes as $ingrediente)
							            	 <option value="{{$ingrediente->id}}_{{$ingrediente->unidad_de_medida}}_{{$ingrediente->precio_base}}">{{$ingrediente->nombre}}</option>
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
						            	<input type="text" name="punidad_de_medida" id="punidad_de_medida" class="form-control text-center" placeholder="Cantidad"  value="{{$ingredientes[0]->unidad_de_medida}}">
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

                    		
                    	</div>

                    </div>
                    <div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                    			<div class="panel-heading text-center">
									<h2 style="font-weight: bold;" class="color-azul">RECETA:</h2><br>
                    			</div>
								<div class="col-md-8 col-md-offset-2">
									
									<img style="display: none;" src="" class="img-fluid img-rounded rounded mx-auto d-block" alt="Sample photo" name="imagen-vista" id="imagen-vista" width="500" height="500"><br>

								</div>
								<br>
						    	<div class="row">
						    		<div class="col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4">
						    			<br>
						    			<input type="file" name="imagen" id="foto" accept="image/*">
										<span  id ="ErrorMensaje-imagen" class="help-block"></span>
						    		</div>
						    	</div>
                    		</div>
                    		<div class="panel-footer">
                    			<div class="row">
									<div class=" col-xs-8 col-xs-offset-2" id="guardar" name="guardar">
										<div class="form-group">
								            	<button class="btn btn-success btn-block" id="boton" type="submit">Hacer Reserva</button>
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

	//actualizar imagen
  function mostrarImagen(input) {
	 if (input.files && input.files[0]) {
	  var reader = new FileReader();
	  reader.onload = function (e) {
	   $('#imagen-vista').attr('src', e.target.result);
	  }
	  reader.readAsDataURL(input.files[0]);
	 }
	}

$("#foto").change(function(){
	$('#imagen-vista').show();
 mostrarImagen(this);
});

	var ingredientes = 0;
	var cont = 0;
	// var precio = 0;
	sub_total = [];

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
		precio_base = datos[2];
		cantidad = $('#pcantidad').val();
		unidad_de_medida = $('#punidad_de_medida').val();
		ingrediente =$("#pidingrediente option:selected").text();

		if (cantidad >= 200)
		{
			sub_total[cont] =  precio_base * 1.4;
		}else{
			sub_total[cont] =  precio_base * 1.25;
		}

		// alert(sub_total[cont]);


		console.log(cantidad);

		if(cantidad != "" && cantidad >= 1)
		{
			var fila = '<tr class="selected text-center" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" id="idingrediente[]" name="idingrediente[]" value="'+ingrediente_id+'" class="filaagregada">'+ingrediente+'</td><td><input type="number" id="sub_total[]" name="sub_total[]" style="display: none;" value="'+sub_total+'" class="text-center" readonly> <input type="number" id="cantidad[]" name="cantidad[]" value="'+cantidad+'" class="text-center" readonly></td><td><input type="text" name="unidad_de_medida[]" value="'+unidad_de_medida+'" class="text-center" readonly></td></tr>';
			AñadirPrecio(cont);
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
	QuitarPrecio(index);   
	evaluar();
	}

	function AñadirPrecio(index)
	{
		// alert(sub_total[index]);
		precio = parseFloat($('#precio').val());
		precio += parseFloat(sub_total[index]);
		$('#precio').val(precio);
		
	}

	function QuitarPrecio(index)
	{
		precio = parseFloat($('#precio').val());
		console.log();
		precio -= parseFloat(sub_total[index]);
		$('#precio').val(precio);
		 
	}
	
</script>
@endsection

