@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Registro
@endsection

@section('content')
	<hr>
	<div class="row">
		<div class="col-xs-4 col-xs-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<h1 class="panel-tittle">Registro</h1>
				</div>
				<div class="panel-body">
	        	<form method="POST" action="{{url('registro/registro')}}" accept-charset="UTF-8" class="" id="Formulario">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
						<div class="form-group">
							<lbl for="email">DNI</lbl>
							<input class="form-control" 
							type="text" 
							name="dni"
							id="dni" 
							placeholder="Ingresa tu DNI"
							maxlength="8">
						</div>

						<div class="form-group" style="display: none;" id="form_nombres">
							<lbl for="email">Nombre</lbl>
							<input class="form-control" 
							type="text" 
							name="nombres"
							id="nombres" 
							placeholder="Ingresa tu(s) Nombre(s)"
							maxlength="100"
							readonly>
						</div>

						<div class="form-group" style="display: none;" id="form_apellido_paterno">
							<lbl for="email">Apellido Paterno</lbl>
							<input class="form-control" 
							type="text"
							name="apellido_paterno"
							id="apellido_paterno" 
							placeholder="Ingresa tu Apellido Paterno"
							maxlength="45"
							readonly>
						</div>

						<div class="form-group" style="display: none;" id="form_apellido_materno">
							<lbl for="email">Apellido Materno</lbl>
							<input class="form-control" 
							type="text" 
							name="apellido_materno"
							id="apellido_materno" 
							placeholder="Ingresa tu Apellido Materno"
							maxlength="45"
							readonly>
						</div>

						<div class="form-group">
							<lbl for="email">Telefono</lbl>
							<input class="form-control" 
							type="text" 
							name="telefono"
							id="telefono" 
							placeholder="Ingresa tu telefono">
						</div>

						<div class="form-group">
							<lbl for="email">Direccion</lbl>
							<input class="form-control" 
							type="text" 
							name="direccion"
							id="direccion" 
							placeholder="Ingresa tu Direccion">
						</div>

						<div class="form-group">
							<lbl for="email">Correo</lbl>
							<input class="form-control" 
							type="email" 
							name="email"
							id="email" 
							placeholder="Ingresa tu email">
						</div>
						<div class="form-group">
							<lbl for="password">Contraseña</lbl>
							<input class="form-control" 
							type="password" 
							name="password" 
							id="password" 
							placeholder="Ingresa tu contraseña">
						</div>
						<button type="submit" class="btn btn-primary btn-block" id="boton">Registrarse</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
	<script>
		$('#dni').change(function(event) {
			jQuery.ajax({
				  url: '/consulta_dni/' + $('#dni').val(),
				  type: 'POST',
				  data: {dni: $('#dni').val(),
						 "_token": "{{ csrf_token() }}",},
				  success: function(respuesta){

				  	$('#nombres').val(respuesta.nombres);
				  	$('#apellido_materno').val(respuesta.apellido_materno);
				  	$('#apellido_paterno').val(respuesta.apellido_paterno);
				  	$('#form_nombres').show();
				  	$('#form_apellido_materno').show();
				  	$('#form_apellido_paterno').show();
				  }
				})
				.fail(function() {
		          // console.log(error);
		    })

		      event.preventDefault();
		});

		$('#boton').click(function(event)
		{
			//comprobaciones

			$('#formulario').submit();			
		});
	</script>
@endsection