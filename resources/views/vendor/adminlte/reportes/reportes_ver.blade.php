@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Reportes por PDF
@endsection

@section('css')
<style>
	.sidebar-reportes
        {
            color: #f39c12;
        }
	.color-azul {
	    color: #337ab7;
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
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<h3 class="text-center color-azul"><strong><i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp; Reportes del Sistema&nbsp;<i class="fa fa-bar-chart" aria-hidden="true"></i></strong></h3>  

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
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a href="{{url('reportes/reservas'). '/ver'}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a href="{{url('reportes/reservas'). '/descargar'}}" target="_blank" ><button class="btn btn-block btn-danger btn-xs">Descargar</button></a></td>
	                    
	                    </tr>
						{{-- @endforeach --}}
		{{-- @foreach($reportes as $reporte_venta) --}}
                      <tr>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;">Registro de Usuarios</td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a href="{{url('reportes/usuarios'). '/ver'}}" target="_blank" ><button class="btn btn-block btn-primary btn-xs">Ver</button></a></td>
	                      <td  class="color-negro text-center" style="font-weight:300; vertical-align:middle;"><a href="{{url('reportes/usuarios'). '/descargar'}}" target="_blank" ><button class="btn btn-block btn-danger btn-xs">Descargar</button></a></td>
	                    
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
</script>
@endsection