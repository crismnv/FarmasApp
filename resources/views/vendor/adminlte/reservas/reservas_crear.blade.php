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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-bars" aria-hidden="true"></i>&nbsp; RESERVAR&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('reservas/crear')}}" accept-charset="UTF-8" class="" enctype="multipart/form-data" id="FormPreparado">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
                   
                    <div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                			@role('cliente')
                    			<div class="row">
                    				<input type="number" name="cliente_id" id="" class="form-control" value="{{$cliente[0]->id}}" required="required" pattern="" title="" style="display: none;">
                    				<div class="form-group col-xs-12 col-md-6 col-md-offset-3">
						            	<label class="color-azul">Selecciona el preparado</label>
                    					<select name="preparados" id="preparados" class="form-control" required="required">
	                    					@foreach($preparados as $preparado)
								            	 <option value="{{$preparado->id}}">{{$preparado->descripcion}}</option>
							            	@endforeach
                    					</select>
                    				</div>
                    			</div>
                    			
                			@else
								<div class="row">
	                    				<div class="form-group col-xs-12 col-md-4 ">
							            	<label class="color-azul">Selecciona el preparado</label>
	                    					<select name="cliente_id" id="clientes" class="form-control" required="required">
		                    					@foreach($clientes as $cliente)
									            	 <option value="{{$cliente->id}}">{{$cliente->nombres . " " .$cliente->apellido1}}</option>
								            	@endforeach
	                    					</select>
	                    				</div>

	                    				<div class="form-group col-xs-12 col-md-4 ">
							            	<label class="color-azul">Selecciona el preparado</label>
	                    					<select name="preparados" id="preparados" class="form-control" required="required">
		                    					@foreach($preparados as $preparado)
									            	 <option value="{{$preparado->id}}">{{$preparado->descripcion}}</option>
								            	@endforeach
	                    					</select>
	                    				</div>

	                    				<div class="form-group col-xs-12 col-md-4 "></label>
							            	<label class="color-azul">Precio del preparado</label>
	                    					<input type="number" name="precio" id="precio" class="form-control" readonly value="{{$preparados[0]->precio}}"  readonly>
	                    				</div>
	                    			</div>

                			@endrole

                			<div class="row">
									<div class=" col-xs-8 col-xs-offset-2" id="guardar" name="guardar">
										<div class="form-group">
								            	<a href="{{url('reservas/crear/detallado')}}" class="btn btn-warning btn-block" id="boton-detallado" type="submit">No encuentro mi preparado</a>
								        </div>
									</div>
								</div>
                    			<br>



								<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 table-responsive">
									<table id="lista_ingredientes" class="table table-striped table-bordered table-condensed">
										<thead  style="background-color:#00a65a; color:#fff;">

											{{-- <th style="vertical-align:middle;text-align:center;">Accion</th> --}}
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

										<tbody id="body">

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
						    			<input type="file" name="imagen" id="imagen" accept="image/*">
										<span  id ="ErrorMensaje-imagen" class="help-block"></span>
						    		</div>
						    	</div>
                    		</div>
                    		<div class="panel-footer">
                    			<div class="row">
									<div class=" col-xs-8 col-xs-offset-2" id="guardar" name="guardar">

										<div class="form-group">
								            	{{-- <button class="btn btn-success btn-block" id="boton" type="submit"></button> --}}
												<button  class="btn btn-success btn-block" id="pelotas" type="submit" >Hacer Reserva</button>
								        </div>
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

	$('#imagen').on("change", function(){
		$("#ErrorMensaje-imagen").hide();

	});


$('#pelotas').click(function(event) {
	var imagen = $('#imagen').val().trim();
	// alert(imagen);
	if( imagen == null || imagen.length == 0)
	{
		imagen = null;
		$("#ErrorMensaje-imagen").text("Usted debe subir la foto de su receta");
		$("#ErrorMensaje-imagen").show();
		$("#imagen").focus();	
		// alert();
		return false;
	}
});

// $('#pelotas').on("click", function(evt)
// {
// 	// alert();
	

// });




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

$("#imagen").change(function(){
	$('#imagen-vista').show();
 	mostrarImagen(this);
});



	$(document).ready(function(){
		jQuery.ajax({
				  url: '../preparados/listaringredientes/' + $('select[name=preparados]').val(),
				  type: 'POST',
				  data: {id: $('select[name=preparados]').val(),
						 "_token": "{{ csrf_token() }}",},
				  success: function(respuesta){
				  		
				  		
				  		// console.log(">>>AÑADIENDO A LA TABLA")
				  		$.each(respuesta, function(index, val) {

		                            // $('#distrito_id').append($('<option>', { 
		                            //     value:respuesta[index].id,
		                            //     text : respuesta[index].cNomZona
		                            // }));
		                           	var fila = '<tr id="fila'+contador+'" class="selected text-center"><td><input class="selected text-center" readonly value= "'+ respuesta[index].nombre +'" type="text"></td><td><input class="selected text-center" readonly value= "'+ respuesta[index].cantidad +'" type="number"></td><td><input class="selected text-center" readonly value= "'+ respuesta[index].unidad_de_medida +'" type="text"></td></tr>';
		                           	$('#lista_ingredientes').append(fila);
                    				// contador++;
		                            // console.log(contador);

		                        });
				  		respuesta = null;
				  		// contador = 0;
				  		// $('#distrito_id').show();
				  		//$('#preparados').show();
				  }
				})
				.fail(function() {
		          //console.log("error");
		    })

		      // event.preventDefault();

		});
	

var contador = 0;
	$('#preparados').change(function()
		{
  		console.log(">>>quitando A LA TABLA")

			// alert(contador);
			// for (var i = 0; i < contador; i++)
  	// 		{
  	// 			console.log("#fila" +i);
			// 	 $("#fila" + i).remove();

  	// 		}
  	// 		contador = 0;
	$("#body").empty();

			jQuery.ajax({
				  url: '../preparados/listaringredientes/' + $('select[name=preparados]').val(),
				  type: 'POST',
				  data: {id: $('select[name=preparados]').val(),
						 "_token": "{{ csrf_token() }}",},
				  success: function(respuesta){
				  		
				  		
				  		// console.log(">>>AÑADIENDO A LA TABLA")
				  		$.each(respuesta, function(index, val) {

		                            // $('#distrito_id').append($('<option>', { 
		                            //     value:respuesta[index].id,
		                            //     text : respuesta[index].cNomZona
		                            // }));
		                           	var fila = '<tr id="fila'+contador+'" class="selected text-center"><td><input readonly value= "'+ respuesta[index].nombre +'" type="text"></td><td><input readonly value= "'+ respuesta[index].cantidad +'" type="number"></td><td><input readonly value= "'+ respuesta[index].unidad_de_medida +'" type="text"></td></tr>';
		                           	$('#lista_ingredientes').append(fila);
                    				// contador++;
		                            // console.log(contador);

		                        });
				  		respuesta = null;
				  		// contador = 0;
				  		// $('#distrito_id').show();
				  		//$('#preparados').show();
				  }
				})
				.fail(function() {
		          //console.log("error");
		    })

		      event.preventDefault();

		});

	$('#pidingrediente').change(function() {
		datos = document.getElementById('pidingrediente').value.split('_');
		unidad_de_medida = datos[1];
		$('#punidad_de_medida').val(unidad_de_medida);		
	});


</script>
@endsection

