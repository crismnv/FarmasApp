@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Categorías
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
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC-ueG56d4pm8xrNLlPssupxlCCuwWIOo&libraries=adsense&language=es"></script>
@endsection

@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
        		<h3 class="text-center color-azul"><strong><i class="fa fa-pencil-square" aria-hidden="true"></i>&nbsp; Editar Persona Natural&nbsp;<i class="fa fa-pencil-square" aria-hidden="true"></i></strong></h3>  
	        	<form method="POST" action="{{url('ingredientes/modificar')}}" accept-charset="UTF-8" class="" id="EditarFormCategorias">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">
					<div class="form-group row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                          <label class="color-azul ">Nombre del Ingrediente:</label>

                                          <input type="text" class="form-control text-left"  id="nombre" name="nombre"  required placeholder="Nombre de la Ingrediente" maxlength="250" value="{{$ingrediente[0]->nombre}}">
                                          <span  id ="ErrorMensaje-nombre" class="help-block" ></span>
                                        </div>
	                                        
	                                    </div>

	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Stock:</label>

	                                          <input type="number" name="stock" id="stock" class="form-control" placeholder="Cantidad" value="{{$ingrediente[0]->stock}}" min="0" max="999999" required="required" title="">

	                                          <span  id ="ErrorMensaje-stock" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>
	                                    
	                                    <div class="form-group row">
	                                        <div class="col-sm-6 col-sm-offset-3">
	                                          <label class="color-azul ">Unidad de Medida:</label>

	                                          <input type="text" class="form-control text-left"  id="unidad_de_medida" name="unidad_de_medida"  required placeholder="Unidad de Medida" maxlength="20" value="{{$ingrediente[0]->unidad_de_medida}}" >
	                                          <span  id ="ErrorMensaje-unidad_de_medida" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div> 

	                                   
	                                    
	                                   	<div class="form-group row">
                                        <div class="col-sm-6 col-md-offset-3">
                                          <label class="color-azul">Estado:</label>
                                          <select class="form-control text-center" name="estado" id="estado">
                                           
                                              @if($ingrediente[0]->estado == 'ACTIVO')
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
	                                       <button type="submit" id="btnAñadirCategoria" class="btn btn-block pull-left boton-azul"><i class="fa fa-plus fa-2x" aria-hidden="true"></i><span style="font-size:20px;">&nbsp; Modificar Ingrediente</span></button>
	                                      
	                                      </div>
	                                      
	                                    </div>             




		<input type="text" name="id" id="id" class="form-control text-center" value="{{ $ingrediente[0]->id}}" style="display:none;">
	          </form>
        	</div>
		</div>
	</div>
@endsection

@section('script-fin')
<script>



</script>
@endsection