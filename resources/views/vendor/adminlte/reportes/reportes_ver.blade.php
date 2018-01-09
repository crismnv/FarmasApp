@extends('adminlte::layouts.app')

@section('htmlheader_title')
@endsection

@section('css')
<style>
	.sidebar-reportes
        {
            color: #f39c12;
        }
	.color-azul {
	    color: #009688;
	}
	.content-wrapper
		{
    		background-color: #ffffff;
		}
	.fa-bar-chart
		{
			color: #00a65a;
		}
	.form-control
		{
			border-radius:4px;
		}
	.panel-primary 
		{
    		border-color: #00a65a;
		}
	.btn-primary 
		{
    		background-color: #00a65a;
    		border-color: #00a65a;
		}

</style>
@endsection

@section('script-inicio')
@endsection

@section('main-content')
<?php  $mes = 0; $año = 0; ?>

	<div class="container-fluid spark-screen">
		


		<div class="row">
			<div class="col-md-10 col-md-offset-1" >
				<h3 class="text-center color-azul"><strong><i class="fa fa-bar-chart" style="color: #009688;" aria-hidden="true"></i>&nbsp; Reportes del Sistema&nbsp;<i class="fa fa-bar-chart" style="color: #009688;" aria-hidden="true"></i></strong></h3>  



				<div class="row">
					<div class="col-md-8 col-md-offset-2">
                    <label class="color-azul">Tipo</label>
                    <select class="form-control" id="tipo_sel">

                        {{-- @foreach($anios as $anio) --}}
                        <option selected value="Historico">Historico</option>
                        <option value="mes">Mensual</option>
                        {{-- @endforeach --}}
                    </select>

                </div>
				</div>
				<br>


				 <div class="row">
               

                <div class="col-md-6" id="años" style="display: none;">
                    <label class="color-azul">Año</label>
                    <select class="form-control" id="anio_sel" >

                        {{-- @foreach($anios as $anio) --}}
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        {{-- @endforeach --}}
                    </select>

                </div>


                <div class="col-md-6" id="meses" style="display: none;">
                    <label class="color-azul">Mes</label>
                    <select class="form-control" id="mes_sel">
                        {{-- @foreach($meses as $mes) --}}
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                        {{-- @endforeach --}}
                    </select>

                </div>
            </div>
				{{-- @if(count($reportes)>0) --}}
				<div class="table-responsive">
                  <table class="table table-hover">

                   
                    <thead><tr>
                      <th class="text-center" style="vertical-align:middle;">Reporte</th>
                      <th class="text-center" style="vertical-align:middle;" colspan="2">Acciones</th>
                    </tr></thead>
                    <tbody>
                    
                    
	                    {{-- @foreach($reportes as $reporte_usuario) --}}
	                    <tr>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;">Reservaciones</td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a id="reservas-ver" href="{{url('reportes/reservas/ver/comments') . '/' . $año . '/pars/'. $mes}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a id="reservas-descargar" href="{{url('reportes/reservas/descargar/comments') . '/' . $año . '/pars/'. $mes}}" target="_blank" ><button class="btn btn-block btn-danger btn-xs">Descargar</button></a></td>
	                    
	                    </tr>
						{{-- @endforeach --}}
		{{-- @foreach($reportes as $reporte_venta) --}}
                      <tr>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;">Registro de Usuarios</td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a id="usuarios-ver" href="{{url('reportes/usuarios/ver/comments') . '/' . $año . '/pars/'. $mes}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a id="usuarios-descargar" href="{{url('reportes/usuarios/descargar/comments') . '/' .$año . '/pars/'. $mes}}" target="_blank" ><button class="btn btn-block btn-danger btn-xs">Descargar</button></a></td>
	                    
	                    </tr>
                   
                    {{-- @endforeach --}}


                  </tbody></table>
                </div>


				{{-- @else
						<center>
                                <img src="/img/cero.png" title="0 reportes" style="width:150px;height:150px;"/>
                                <p class="color-azul">No se encontraron Opciones de Reportes</p>
                                <p class="color-azul">Cuando se le asignen los reportes estos apareceran aqui</p>
                            </center>
				@endif --}}
			</div>
		</div>
	</div>		
@endsection

@section('script-fin')
<script>

	var f = new Date();
    var año = f.getFullYear();

    var mes = f.getMonth() + 1;

	$(document).ready(function(){
		
    
	    $("#anio_sel").val(año);
	    $("#mes_sel").val(mes);
	    f = null;
	});



$("#anio_sel").change(function()
{
	año = $('#anio_sel').val();
	// alert(año);
	// reportes/usuarios/ver/comments') . '/' . $año . '/pars/'. $mes'
	$("#reservas-descargar").attr("href", "./reservas/descargar/comments/".concat( año,"/pars/", mes));
	$("#reservas-ver").attr("href", "./reservas/ver/comments/".concat(año,"/pars/", mes));
	$("#usuarios-descargar").attr("href", "./usuarios/descargar/comments/".concat( año,"/pars/", mes));
	$("#usuarios-ver").attr("href", "./usuarios/ver/comments/".concat(año,"/pars/", mes));
});
$("#mes_sel").change(function()
{

	mes = $('#mes_sel').val();
	$("#reservas-descargar").attr("href", "./reservas/descargar/comments/".concat( año,"/pars/", mes));
	$("#reservas-ver").attr("href", "./reservas/ver/comments/".concat(año,"/pars/", mes));
	$("#usuarios-descargar").attr("href", "./usuarios/descargar/comments/".concat( año,"/pars/", mes));
	$("#usuarios-ver").attr("href", "./usuarios/ver/comments/".concat(año,"/pars/", mes));
	
});
$('#tipo_sel').change(function() {
	/* Act on the event */
	tipo = $('#tipo_sel').val();
	// alert(tipo);
	if(tipo == 'mes')
	{
		$('#meses').show();
		$('#años').show();
		$("#reservas-descargar").attr("href", "./reservas/descargar/comments/".concat( año,"/pars/", mes));
		$("#reservas-ver").attr("href", "./reservas/ver/comments/".concat(año,"/pars/", mes));
		$("#usuarios-descargar").attr("href", "./usuarios/descargar/comments/".concat( año,"/pars/", mes));
		$("#usuarios-ver").attr("href", "./usuarios/ver/comments/".concat(año,"/pars/", mes));
	}else{
		$('#meses').hide();
		$('#años').hide();
		$("#reservas-descargar").attr("href", "./reservas/descargar/comments/0/pars/0");
		$("#reservas-ver").attr("href", "./reservas/ver/comments/0/pars/0");
		$("#usuarios-descargar").attr("href", "./usuarios/descargar/comments/0/pars/0");
		$("#usuarios-ver").attr("href", "./usuarios/ver/comments/0/pars/0");
		
	}

});

</script>
@endsection