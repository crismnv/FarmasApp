@extends('adminlte::layouts.app') @section('htmlheader_title') Reportes Graficos @endsection @section('css')
<style>
    .color-azul {
        color: #009688;
    }
    .sidebar-reportes
        {
            /*color: #f39c12;*/
        }
    .content-wrapper {
        background-color: #ffffff;
    }

    .fa-bar-chart {
        color: #009688;
    }

    .form-control {
        border-radius: 4px;
    }

    .panel-primary {
        border-color: #00a65a;
    }
</style>
@endsection @section('script-inicio') @endsection @section('main-content')
<div class="container-fluid spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3 class="text-center color-azul">
                <strong>
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>&nbsp;Graficos del Sistema&nbsp;
                    <i class="fa fa-bar-chart" aria-hidden="true"></i>
                </strong>
            </h3>

            <div class="row">
                 <div class="col-md-4">
                    <label class="color-azul">Grafica</label>
                    <select class="form-control" id="grafica_sel" onchange="cambiar_fecha_grafica();">

                        <option value="reservas">Reservas</option>
                        <option value="registros">Registros</option>
                    </select>

                </div>



                <div class="col-md-4">
                    <label class="color-azul">Año</label>
                    <select class="form-control" id="anio_sel" onchange="cambiar_fecha_grafica();">

                        {{-- @foreach($anios as $anio) --}}
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        {{-- @endforeach --}}
                    </select>

                </div>


                <div class="col-md-4">
                    <label class="color-azul">Mes</label>
                    <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();">
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

            <div class="row">
                <br/>
                <div class="box box-primary">
                    <div class="box-header">
                    </div>

                    <div class="box-body" id="div_grafica_barras">
                    </div>

                    <div class="box-footer">
                    </div>
                </div>



                <br/>
                <div class="box box-primary">
                    <div class="box-header">
                    </div>

                    <div class="box-body" id="div_grafica_lineas">
                    </div>

                    <div class="box-footer">
                    </div>
                </div>

            </div>





        </div>
    </div>
</div>
@endsection @section('script-fin')
<script type="text/javascript" src="/js/highcharts.js"></script>
<script type="text/javascript" src="/js/graficas.js"></script>

@endsection