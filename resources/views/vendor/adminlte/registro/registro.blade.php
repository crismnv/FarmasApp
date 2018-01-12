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
	        				<span  id ="ErrorMensaje-dni" class="help-block" style="color: red;"></span>

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
	        				<span  id ="ErrorMensaje-nombres" class="help-block" style="color: red;"></span>

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
	        				<span  id ="ErrorMensaje-apellido_paterno" class="help-block" style="color: red;"></span>

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
	        				<span  id ="ErrorMensaje-apellido_materno" class="help-block" style="color: red;"></span>

						</div>

						<div class="form-group">
							<lbl for="email">Telefono</lbl>
							<input class="form-control" 
							type="text" 
							name="telefono"
							id="telefono" 
							placeholder="Ingresa tu telefono">
	        				<span  id ="ErrorMensaje-telefono" class="help-block" style="color: red;"></span>

						</div>

						<div class="form-group">
							<lbl for="email">Direccion</lbl>
							<input class="form-control" 
							type="text" 
							name="direccion"
							id="direccion" 
							placeholder="Ingresa tu Direccion">
	        				<span  id ="ErrorMensaje-direccion" class="help-block" style="color: red;"></span>

						</div>

						<div class="form-group">
							<lbl for="email">Correo</lbl>
							<input class="form-control" 
							type="email" 
							name="email"
							id="email" 
							placeholder="Ingresa tu email">
	        				<span  id ="ErrorMensaje-email" class="help-block" style="color: red;"></span>

						</div>
						<div class="form-group">
							<lbl for="password">Contraseña</lbl>
							<input class="form-control" 
							type= "password" 
							name= "password" 
							id= "password" 
							placeholder="Ingresa tu contraseña">
	        				<span  id ="ErrorMensaje-password" class="help-block" style="color: red;"></span>

						</div>
						<button type="submit" class="btn btn-primary btn-block" id="boton">Registrarse</button>
					</form>
				</div>
			</div>
		</div>
	</div>

<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
	<script>

	$('#dni').on("keypress", function(){
	$("#ErrorMensaje-dni").hide();
	$('#boton').show();
	}); 

	$('#nombres').on("keypress", function(){
	$("#ErrorMensaje-nombres").hide();

	}); 
	$('#apellido_materno').on("keypress", function(){
	$("#ErrorMensaje-apellido_materno").hide();

	}); 
	$('#apellido_paterno').on("keypress", function(){
	$("#ErrorMensaje-apellido_paterno").hide();

	}); 

	$('#telefono').on("keypress", function(){
	$("#ErrorMensaje-telefono").hide();

	}); 

	$('#direccion').on("keypress", function(){
	$("#ErrorMensaje-direccion").hide();

	}); 


	$('#email').on("keypress", function(){
	$("#ErrorMensaje-email").hide();

	}); 


	$('#password').on("keypress", function(){
	$("#ErrorMensaje-password").hide();

	}); 

	// $('#stock').on("keypress", function(){
	// 	$("#ErrorMensaje-stock").hide();

	// }) 

	// $('#unidad_de_medida').on("keypress", function(){
	// 	$("#ErrorMensaje-unidad_de_medida").hide();

	// }) 
	// $('#precio_base').on("keypress", function(){
	// 	$("#ErrorMensaje-precio_base").hide();

	// }) 

	// $('#password').click(function(event) {
	// 	alert($('#password').val());

	// });

	$('#boton').on("click", function(evt)
	{

		var dni = $('#dni').val().trim();

		if( dni == null || dni.length == 0)
		{
			dni = null;
			$("#ErrorMensaje-dni").text("El dni no puede estar vacio");
			$("#ErrorMensaje-dni").show();
			// $('#boton').show();
			$("#dni").focus();	
			// alert();
			return false;
		}

		var nombres = $('#nombres').val().trim();

		if( nombres == null || nombres.length == 0)
		{
			nombres = null;
			$("#ErrorMensaje-nombres").text("El nombres no puede estar vacio");
			$("#ErrorMensaje-nombres").show();
			$("#nombres").focus();	
			// alert();
			return false;
		}

		var dni = $('#apellido_paterno').val().trim();

		if( apellido_paterno == null || apellido_paterno.length == 0)
		{
			apellido_paterno = null;
			$("#ErrorMensaje-apellido_paterno").text("El apellido_paterno no puede estar vacio");
			$("#ErrorMensaje-apellido_paterno").show();
			$("#apellido_paterno").focus();	
			// alert();
			return false;
		}

		var apellido_materno = $('#apellido_materno').val().trim();

		if( apellido_materno == null || apellido_materno.length == 0)
		{
			apellido_materno = null;
			$("#ErrorMensaje-apellido_materno").text("El apellido_materno no puede estar vacio");
			$("#ErrorMensaje-apellido_materno").show();
			$("#apellido_materno").focus();	
			// alert();
			return false;
		}

		var telefono = $('#telefono').val().trim();

		if( telefono == null || telefono.length == 0)
		{
			telefono = null;
			$("#ErrorMensaje-telefono").text("El telefono no puede estar vacio");
			$("#ErrorMensaje-telefono").show();
			$("#telefono").focus();	
			// alert();
			return false;
		}

		var direccion = $('#direccion').val().trim();

		if( direccion == null || direccion.length == 0)
		{
			direccion = null;
			$("#ErrorMensaje-direccion").text("El direccion no puede estar vacio");
			$("#ErrorMensaje-direccion").show();
			$("#direccion").focus();	
			// alert();
			return false;
		}

		var email = $('#email').val().trim();

	    if( email == null || email.length == 0  ) {
	       email = null;
	       $("#ErrorMensaje-email").text('El correo Electrónico no puede ser vacío.');
	         $("#ErrorMensaje-email").show();
	         $("#email").focus();
	         return false;
	       }

	     if (!ValidarEmail(email)) {
		    	email=null;
		       $("#ErrorMensaje-email").text('Debe Ingresar un correo valido.');
  				$("#ErrorMensaje-email").show();
  				$("#email").focus();
  				// alert();
  				return false;
		    }

		var password = $('#password').val().trim();
		// alert(password);
		// return false;

		if( password == null || password.length == 0)
		{
			password = null;
			$("#ErrorMensaje-password").text("Este campo no puede estar vacio.");
			$("#ErrorMensaje-password").show();
			$("#password").focus();	
			// alert();
			return false;
		}
	

		
	});	

	function ValidarEmail(email){
		var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		 if (!regex.test(email)) {
		 	return false; //email incorrecto
		 }
		 else
		 {
		 	return true; // email correcto
		 }
		}

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
					$('#boton').show();

				  }
				})
				.fail(function() {
					$('#boton').hide();
					$("#ErrorMensaje-dni").text("La información brindada es invalida");
					$("#ErrorMensaje-dni").show();

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