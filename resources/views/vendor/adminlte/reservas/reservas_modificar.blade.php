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
	<br>
	<br>
	<br>
	<br>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
	        	<form method="POST" action="{{url('reservas/modificar')}}" accept-charset="UTF-8" class="" id="FormPreparado">
	        		<input name="_token" type="hidden" value="{{ csrf_token() }}">

                    <div class="row">
                    	<div class="panel panel-primary">
        					<h3 class="text-center text-uppercase color-azul"><strong><i class="fa fa-bars" aria-hidden="true"></i>&nbsp;{{$reserva[0]->descripcion}}&nbsp;<i class="fa fa-bars" aria-hidden="true"></i></strong></h3>  
                    		{{-- <div class="panel-heading">
                    			
			                    <div class="form-group row">
			                        <div class="col-sm-5 ">
			                          <label class="color-azul ">Descripcion</label>

			                          <input readonly type="text" class="form-control text-left"  id="descripcion" name="descripcion"  required placeholder="Descripcion" maxlength="250" value="">
			                          <span  id ="ErrorMensaje-descripcion" class="help-block" ></span>
			                        </div>


			                        <div class="col-sm-5 col-sm-offset-1">
			                          <label class="color-azul ">Precio</label>

			                          <input readonly type="text" class="form-control text-left"  id="precio" name="precio"  required placeholder="Precio" maxlength="250" value="{{$reserva[0]->precio}}" >
			                          <span  id ="ErrorMensaje-precio" class="help-block" ></span>
			                        </div>
			                    </div>
                    		</div> --}}
                    		<div class="panel-body">

	                                        <div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 table-responsive">
                    							<div class="form-group">
	                                          <label class="color-azul ">Cliente:</label>

	                                          <input readonly type="text" name="nombres" id="nombres" class="form-control" placeholder="Cantidad" value="{{$reserva[0]->nombres . ' ' . $reserva[0]->apellido1 . ' ' . $reserva[0]->apellido2}}" min="0" max="999999" required="required" title="">
	                                          <input style="display: none;" type="text" name="email" value="{{$reserva[0]->email}}">

	                                          <span  id ="ErrorMensaje-stock" class="help-block" ></span>
	                                        </div>
	                                        
	                                    </div>

								<div class="col-lg-12 col-sm-12  col-md-12 col-xs-12 table-responsive">
									<div class="form-group">
                    				<label class="color-azul ">Estado de la Reserva:</label>
                    				
                    				<select name="estado_reserva" id="estado_reserva" class="form-control" required="required">
                    					@if($reserva[0]->estado_reserva === 'PENDIENTE')
                    					<option  value="APROBADO">APROBADO</option>
                    					<option  selected value="PENDIENTE">PENDIENTE</option>
                    					<option value="CANCELADO">CANCELADO</option>
                    					@elseif($reserva[0]->estado_reserva === 'CANCELADO')
                    					<option  value="APROBADO">APROBADO</option>
                    					<option selected value="CANCELADO">CANCELADO</option>
                    					@elseif($reserva[0]->estado_reserva === 'APROBADO')
                    					<option selected value="APROBADO">APROBADO</option>
                    					<option value="LISTO">LISTO</option>
                    					@elseif($reserva[0]->estado_reserva === 'LISTO')
                    					<option  selected value="LISTO">LISTO</option>
                    					<option value="ENTREGADO">ENTREGADO</option>
                    					@endif


                    				</select>
                    			</div>

									<table id="lista_ingredientes" class="table table-striped table-bordered table-condensed">
										<thead  style="background-color:#00a65a; color:#fff;">
											@role('admin')
											<th style="vertical-align:middle;text-align:center;">Accion</th>
											@endrole
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
											@role('admin')
											<tr class="selected text-center" id="filacont"><td><a href="{{url("ingredientes/ver/" . $ingrediente->id)}}" target="_blank" class="btn btn-warning btn-info"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;</a></td><td><input type="hidden" id="idingrediente[]" name="idingrediente[]" value="ingrediente_id" class="filaagregada">{{$ingrediente->nombre}}</td><td><input type="number" id="cantidad[]" name="cantidad[]" value="{{$ingrediente->cantidad}}" class="text-center" readonly></td><td><input type="text" name="unidad_de_medida[]" value="{{$ingrediente->unidad_de_medida}}" class="text-center" readonly></td></tr>
											@else
											<tr class="selected text-center" id="filacont"><td><input type="hidden" id="idingrediente[]" name="idingrediente[]" value="ingrediente_id" class="filaagregada">{{$ingrediente->nombre}}</td><td><input type="number" id="cantidad[]" name="cantidad[]" value="{{$ingrediente->cantidad}}" class="text-center" readonly></td><td><input type="text" name="unidad_de_medida[]" value="{{$ingrediente->unidad_de_medida}}" class="text-center" readonly></td></tr>
											@endrole
							            	@endforeach
										</tbody>
										<tfoot>
											@role('admin')
											<th style=""></th>
											@endrole
									    	 <th class="color-azul text-center text-center">PRECIO</th>
									        <th><h4 class="color-azul text-right" id="total">{{$reserva[0]->precio}}</h4><input type="hidden" name="total_venta" id="total_venta"></th>
									        <th><h4 class="color-azul text-center" id="total">Nuevos Soles</h4><input type="hidden" name="total_venta" id="total_venta"></th>
									    </tfoot>
										
									</table>
								</div>

                    		</div>

                    		 <div class="form-group row"> 
	                              <div class="col-xs-8 col-xs-offset-2">
	                               	<button type="submit" id="btnAñadirCategoria" class="btn btn-block pull-left btn-success"><span style="font-size:20px;">&nbsp; Modificar Reserva</span></button>
	                              
	                              </div>
	                              
	                            </div>             




							<input type="text" name="id" id="id" class="form-control text-center" value="{{ $reserva[0]->id}}" style="display:none;">
						          </form>
					        	</div>
							</div>
							<div class="row">
                    	<div class="panel panel-primary">
                    		<div class="panel-body">
                    			<div class="panel-heading text-center">
									<h2 style="font-weight: bold;" class="color-azul">RECETA:</h2><br>
                    			</div>
								<div class="col-md-8 col-md-offset-2">
									
									<img src="{{ asset('/reservas/' . $reserva[0]->imagen) }}" class="img-fluid img-rounded rounded mx-auto d-block" alt="Sample photo" name="imagen-vista" id="imagen-vista" width="500" height="500"><br>

								</div>
								<br>
						    	
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
	
</script>
@endsection

