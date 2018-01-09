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
			color: #337ab7;
		}
		.fa-pencil-square
		{
			color: #00a65a;
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
			background-color: #E64A19;
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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar Persona Natural&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('proveedores/modificar')}}" accept-charset="UTF-8" class="" id="EditarFormCategorias">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
					<div class="form-group row">
                                        <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">RUC:</label>

	                                          <input readonly type="text" class="form-control text-left"  id="ruc" name="ruc"  required placeholder="12345678910" maxlength="250" value="{{$proveedor[0]->ruc}}">
	                                          <span  id ="ErrorMensaje-ruc" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Razon Social:</label>

	                                          <input readonly type="text" name="razon_social" id="razon_social" class="form-control" placeholder="Cantidad" value="{{$proveedor[0]->razon_social}}" required="required" title="">

	                                          <span  id ="ErrorMensaje-razon_social" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>
	                                    
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Telefono:</label>

	                                          <input readonly type="text" class="form-control text-left"  id="telefono" name="telefono"  required placeholder="Unidad de Medida" value="{{$proveedor[0]->telefono}}" maxlength="20" >
	                                          <span  id ="ErrorMensaje-telefono" class="help-block" ></span>
	                                        </div>
	                                    </div>
	                                    

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Correo:</label>

	                                    		<input readonly type="email" name="correo" id="correo" class="form-control text-left" value="{{$proveedor[0]->correo}}" placeholder="proveedor@provee.com" required="required" title="">
	                                          
	                                          <span  id ="ErrorMensaje-telefono" class="help-block" ></span>
	                                        </div>
	                                    </div>
	                                   
	                                    
	                                   	<div class="form-group row">
	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Estado:</label>
	                                          <select class="form-control text-center" name="estado" id="estado">
	                                           
	                                              @if($proveedor[0]->estado == 'ACTIVO')
	                                                <option selected value="ACTIVO" >ACTIVO</option>
	                                              @else
	                                                <option  selected="" value="INACTIVO" >INACTIVO</option>
	                                              @endif
	                                            
	                                    		</select>      
											<br>

	</div>
@endsection

@section('script-fin')
<script>



</script>
@endsection