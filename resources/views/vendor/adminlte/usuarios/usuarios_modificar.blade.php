@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('contentheader_title')
@endsection

@section('css')
	<style>
	.sidebar-cruds
	        {
	            color: #f39c12;
	        }
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
        		<h3 class="text-center color-azul"><strong><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar Persona Natural&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('users/modificarpersonales')}}" accept-charset="UTF-8" class="" id="EditarFormPersonaNatural" enctype="multipart/form-data">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">

									
	                                    <div class="form-group row">



	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Nombres:</label>
	                                          <input type="text" readonly class="form-control text-center"  id="nombres" name="nombres"  required placeholder="Nombres" maxlength="20" value="{{ $usuario[0]->nombres}}">
	                                          <span  id ="ErrorMensaje-Nombres" class="help-block"></span>
	                                        </div>
	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Apellido Paterno:</label>
	                                          <input type="text"  readonly class="form-control text-center"  id="apellido_paterno" name="apellido_paterno"  required placeholder="Apellido Paterno" maxlength="40" value="{{ $usuario[0]->apellido1}}">
	                                          <span  id ="ErrorMensaje-apellido_paterno" class="help-block"></span>
	                                        </div>

	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Apellido Materno:</label>
	                                          <input type="text" readonly  class="form-control text-center"  id="apellido_materno" name="apellido_materno"  required placeholder="Apellido Materno" maxlength="40" value="{{ $usuario[0]->apellido2}}">
	                                          <span  id ="ErrorMensaje-apellido_materno" class="help-block"></span>

	                                        </div><div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">DNI:</label>
	                                          <input type="text" readonly  class="form-control text-center"  id="dni" name="dni" readonly="" required placeholder="DNI" maxlength="8" value="{{ $usuario[0]->dni}}">
	                                          <span  id ="ErrorMensaje-dni" class="help-block"></span>
	                                        </div>
	                                        
	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Telefono:</label>
	                                          <input type="text" class="form-control text-center"  id="telefono" name="telefono"  required placeholder="Apellido Materno" maxlength="40" value="{{ $usuario[0]->telefono}}">
	                                          <span  id ="ErrorMensaje-telefono" class="help-block"></span>
	                                        </div>
	                                        
	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Direccion:</label>
	                                          <input type="text" class="form-control text-center"  id="direccion" name="direccion"  required placeholder="Apellido Materno" maxlength="40" value="{{ $usuario[0]->direccion}}">
	                                          <span  id ="ErrorMensaje-direccion" class="help-block"></span>
	                                        </div>
	                                        
	                                       

	                                    </div>
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-md-offset-3">
	                                          <label class="color-azul">Estado:</label>
	                                          <select class="form-control text-center" name="estado" id="estado">
	                                           
	                                              @if($usuario[0]->estado == 'ACTIVO')
	                                                <option selected value="ACTIVO" >ACTIVO</option>
	                                                <option  value="INACTIVO" >INACTIVO</option>
	                                              @else
	                                                <option  value="ACTIVO" >ACTIVO</option>
	                                                <option  selected value="INACTIVO" >INACTIVO</option>
	                                              @endif
	                                            
	                                    		</select>      
											<br>
										</div>
										<input type="text" name="id" id="id" class="form-control text-center" value="{{ $usuario[0]->id}}" style="display:none;">
										<input type="text" name="user_id" id="user_id" class="form-control text-center" value="{{ $usuario[0]->user_id}}" style="display:none;">

	                                    
	                                   
	                                    <div class="row"> 
	                                      <div class="col-xs-12">
	                                       {{-- <a href ="" id="btnContinuarPasoUno" class="btn btn-block pull-left btn-principal btn-continuar"><i class="fa fa-play-circle-o fa-3x" aria-hidden="true"></i><span style="font-size:40px;"> Continuar</span></a> --}}
	                                       <button type="submit" id="btnEditarPersonaNatural" class="btn btn-block pull-left btn-success"><i class="fa fa-play-circle-o fa-3x" aria-hidden="true"></i><span style="font-size:20px;">&nbsp; Editar usuario</span></button>
	                                       <input type="text" name="" id ="" style="display:none;">
	                                       <br>
	                                       <br>
	                                       <br>
	                                       <br>
	                                       <br>
	                                      </div>
	                                      
	                                    </div>

		<input type="text" name="id" id="id" class="form-control text-center" value="{{ $usuario[0]->id}}" style="display:none;">
	          </form>
        	</div>
		</div>
	</div>
@endsection

@section('script-fin')
<script>

</script>
@endsection