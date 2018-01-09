@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('css')
	<style>
	.sidebar-cruds
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
			color: #009688;
		}
		.form-control
		{
			border-radius:4px;
		}
		.form-control[readonly]
		{
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
	 	
	 	.boton-azul
		{
			background-color: #009688;
			color: #ffffff;
		}
	</style>
@endsection

@section('script-inicio')
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; MODIFICAR PROVEEDOR&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('proveedores/modificar')}}" accept-charset="UTF-8" class="" id="EditarFormCategorias">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
					<div class="form-group row">
                                        <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">RUC:</label>

	                                          <input type="text" class="form-control text-left"  id="ruc" name="ruc"  required placeholder="12345678910" maxlength="250" value="{{$proveedor[0]->ruc}}">
	                                          <span  id ="ErrorMensaje-ruc" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Razon Social:</label>

	                                          <input type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Cantidad" value="{{$proveedor[0]->razon_social}}" required="required" title="">

	                                          <span  id ="ErrorMensaje-razon_social" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>
	                                    
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Telefono:</label>

	                                          <input type="text" class="form-control text-left"  id="telefono" name="telefono"  required placeholder="Unidad de Medida" value="{{$proveedor[0]->telefono}}" maxlength="20" >
	                                          <span  id ="ErrorMensaje-telefono" class="help-block" ></span>
	                                        </div>
	                                    </div>
	                                    

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Correo:</label>

	                                    		<input type="email" name="correo" id="correo" class="form-control text-left" value="{{$proveedor[0]->correo}}" placeholder="proveedor@provee.com" required="required" title="">
	                                          
	                                          <span  id ="ErrorMensaje-telefono" class="help-block" ></span>
	                                        </div>
	                                    </div>
	                                   
	                                    
	                                   	<div class="form-group row">
	                                        <div class="col-xs-8 col-xs-offset-1 col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul">Estado:</label>
	                                          <select class="form-control text-center" name="estado" id="estado">
	                                           
	                                              @if($proveedor[0]->estado == 'ACTIVO')
	                                                <option selected value="ACTIVO" >ACTIVO</option>
	                                                <option  value="INACTIVO" >INACTIVO</option>
	                                              @else
	                                                <option  value="ACTIVO" >ACTIVO</option>
	                                                <option  selected="" value="INACTIVO" >INACTIVO</option>
	                                              @endif
	                                            
	                                    		</select>      
											<br>


	                                   
		                                    <div class="form-group row"> 
		                                      <div class="col-xs-8 col-xs-offset-2">
		                                       <button type="submit" id="btnAñadirCategoria" class="btn btn-block pull-left boton-azul"><i class="fa fa-plus fa-2x" aria-hidden="true"></i><span style="font-size:20px;">&nbsp; Modificar Proveedor</span></button>
		                                      
		                                      </div>
		                                      
		                                    </div>             




										<input type="text" name="id" id="id" class="form-control text-center" value="{{ $proveedor[0]->id}}" style="display:none;">
									          </form>
								        	</div>
										</div>
	</div>
@endsection

@section('script-fin')
<script>



	$('#ruc').on("keypress", function(){
		$("#ErrorMensaje-ruc").hide();

	}) 

	$('#razon_social').on("keypress", function(){
		$("#ErrorMensaje-razon_social").hide();

	}) 

	
	$('#telefono').on("keypress", function(){
		$("#ErrorMensaje-telefono").hide();

	}) 

	$('#correo').on("keypress",function (){
		$("#ErrorMensaje-correo").hide();
	})

	

	$('#boton').on("click", function(evt)
	{
		var ruc = $('#ruc').val().trim();

		if( ruc == null || ruc.length == 0)
		{
			ruc = null;
			$("#ErrorMensaje-ruc").text("Este campo no  puede estar vacio");
			$("#ErrorMensaje-ruc").show();
			$("#ruc").focus();	
			// alert();
			return false;
		}
		if(ruc.length != 11 )
		{
			$("#ErrorMensaje-ruc").text("Este campo debe tener 11 numeros");
			$("#ErrorMensaje-ruc").show();
			$("#ruc").focus();
			return false;
		}
	

		var razon_social = $('#razon_social').val().trim();
		if(razon_social == null || razon_social.length == 0 )
		{
			$("#ErrorMensaje-razon_social").text("Este campo no  puede estar vacio");
			$("#ErrorMensaje-razon_social").show();
			$("#razon_social").focus();
			return false;
		}
		
		
		
		var telefono = $('#telefono').val().trim();
		if(telefono == null || telefono.length == 0 )
		{
			$("#ErrorMensaje-telefono").text("Este campo no  puede estar vacio");
			$("#ErrorMensaje-telefono").show();
			$("#telefono").focus();
			return false;
		}

		var correo = $('#correo').val().trim();

	    if( correo == null || correo.length == 0  ) {
	       correo = null;
	       $("#ErrorMensaje-correo").text('El Correo Electrónico no puede ser vacío.');
	         $("#ErrorMensaje-correo").show();
	         $("#correo").focus();
	         return false;
	       }

	     if (!ValidarEmail(correo)) {
		    	correo=null;
		       $("#ErrorMensaje-correo").text('Debe Ingresar un Email valido.');
  				$("#ErrorMensaje-correo").show();
  				$("#correo").focus();
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


</script>
@endsection