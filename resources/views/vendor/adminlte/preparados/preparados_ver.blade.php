@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{-- Añadir Ingrediente --}}
@endsection
@section('contentheader_title')
	{{-- Nueva Ingrediente --}}
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
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC-ueG56d4pm8xrNLlPssupxlCCuwWIOo&libraries=adsense&language=es"></script>
@endsection


@section('main-content')

<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-bars" aria-hdiden="true"></i>&nbsp;PREPARADO&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('preparados/añadir')}}" accept-charset="UTF-8" class="" id="FormPreparado">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-sm-5 ">
                          <label class="color-azul ">Descripcion</label>

                          <input readonly type="text" class="form-control text-left"  id="descripcion" name="descripcion"  required placeholder="Descripcion" maxlength="250" value="{{$preparado[0]->descripcion}}">
                          <span  id ="ErrorMensaje-descripcion" class="help-block" ></span>
                        </div>


                        <div class="col-sm-5 col-sm-offset-1">
                          <label class="color-azul ">Precio</label>

                          <input readonly type="text" class="form-control text-left"  id="precio" name="precio"  required placeholder="Precio" maxlength="250" value="{{$preparado[0]->precio}}" >
                          <span  id ="ErrorMensaje-precio" class="help-block" ></span>
                        </div>
                    </div>

                    <div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                    		

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
											@foreach($ingredientes as $ingrediente)
											<tr class="selected text-center" id="filacont"><td><a href="{{url("ingredientes/ver/" . $ingrediente->id)}}" target="_blank" class="btn btn-warning btn-info"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;</a></td><td><input type="hidden" id="idingrediente[]" name="idingrediente[]" value="ingrediente_id" class="filaagregada">{{$ingrediente->nombre}}</td><td><input type="number" id="cantidad[]" name="cantidad[]" value="{{$ingrediente->cantidad}}" class="text-center" readonly></td><td><input type="text" name="unidad_de_medida[]" value="{{$ingrediente->unidad_de_medida}}" class="text-center" readonly></td></tr>
							            	@endforeach
											
										</tbody>
									</table>
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
		}else{
			alert('Ingrese una cantidad valida');

		}


		// alert(ingrediente_id);



	}
</script>
@endsection

