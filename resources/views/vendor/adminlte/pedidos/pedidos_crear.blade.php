@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Nueva Boleta
@endsection

@section('contentheader_title')
	
@endsection

@section('css')
	<style>
		.sidebar-ventas
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
				<h3 class="text-center color-azul"><strong><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; REGISTRAR PEDIDO&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></strong></h3>  

				<form method="POST" action="{{url('pedidos/crear')}}" accept-charset="UTF-8" class="" id="RegistroFormFactura">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">

				<div class="row">
					<div class="col-md-8 col-md-offset-2 col-sm-12">
						<div class="form-group">
							<label class="color-azul">Cliente</label>
							<select name="proveedor_id"  id="proveedores_id" class="form-control selectpicker" data-live-search="true">
			            	 	@foreach($proveedores as $proveedor)
			            			<option value="{{$proveedor->id}}">{{$proveedor->razon_social}}</option>
			            		@endforeach
			            	</select>
						</div>
					</div>

					<div class="form-group row">
	                <div class="col-sm-4">
	                    <label class="color-azul">Año:</label>
	                    <select class="form-control text-center" name="anio" id="anio_id">
				            <option selected value="2017" >2017</option>
				            <option value="2018" >2018</option>
				            <option value="2019" >2019</option>
	                    </select>
	                </div>
	                <div class="col-sm-4">
	                    <label class="color-azul">Mes:</label>
	                    <select class="form-control text-center" name="mes" id="mes_id">
				            <option selected value="1">Enero</option>
				            <option value="2">Febrero</option>
				            <option value="3">Marzo</option>
				            <option value="4">Abril</option>
				            <option value="5">Mayo</option>
				            <option value="6">Junio</option>
				            <option value="7">Julio</option>
				            <option value="8">Agosto</option>
				            <option value="9">Setiembre</option>
				            <option value="10">Octube</option>
				            <option value="11">Noviembre</option>
				            <option value="12">Diciembre</option>
	                    </select>
	                </div>
	                <div class="col-sm-4">
	                    <label class="color-azul">Dia</label>
	                    <input type="number" name="dia" id="dia" value="" min="1" max="31" class="form-control text-center" />
	                    <span  id ="ErrorMensaje-dia" class="help-block" ></span>

	                </div>                          
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
						            	<input type="text"  readonly name="punidad_de_medida" id="punidad_de_medida" class="form-control text-center" placeholder="Cantidad"  value="{{$ingredientes[0]->unidad_de_medida}}">
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

// var numero_mes = 1;
	$('#dia').on("keypress", function(){
		$("#ErrorMensaje-dia").hide();

	})

	$('#guardar').on("click", function(evt)
	{
		var dia = $('#dia').val().trim();
		var max;

		if( dia == null || dia.length == 0)
		{
			dia = null;
			$("#ErrorMensaje-dia").text("Este campo no puede  estar vacio");
			$("#ErrorMensaje-dia").show();
			$("#dia").focus();	
			// alert();
			return false;
		}
		numero_mes = $('#mes_id').val();

		switch(numero_mes)
			{
				case '2':
					max=29;
					break;
				case '1':
				case '3':
				case '5':
				case '7':
				case '8':
				case '10':
				case '12':
					max=31;
					break;
				default:
					max=30;
			}
			if( dia > max)
			{
				$("#ErrorMensaje-dia").text("Este campo debe estar entre 1 y ".concat(max));
				$("#ErrorMensaje-dia").show();
				$("#dia").focus();	
				dia = null;
				// alert();
				return false;
			}


			max = null;
	});
	var ingredientes = 0;
	var cont = 0;
	
	$('#mes_id').change( function()
		{
			numero_mes = $('#mes_id').val();
			$('#pago_dia').val('1');
			switch(numero_mes)
			{
				case '2':
					$('#pago_dia').attr("max", 29);
					break;
				case '1':
				case '3':
				case '5':
				case '7':
				case '8':
				case '10':
				case '12':
					$('#pago_dia').attr("max", 31);
					break;
				default:
					$('#pago_dia').attr("max", 30);
				
			}
			numero_mes = null;
		});
		$('#pago_dia').change( function()
		{
			var dia = $('#pago_dia').val();
			var max = $('#pago_dia').attr("max");
			var min = $('#pago_dia').attr("min");
			if( parseInt(dia) > parseInt(max) )
			{
				$('#pago_dia').val(max);
			}else if( parseInt(dia) < parseInt(min)){
				$('#pago_dia').val(min);
			}
			dia = null;
			max = null;
			min = null;
		});

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


				