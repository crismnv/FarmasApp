$(document).ready(function(){
    cargar_grafica_barras_reservas(18, 1);
    cargar_grafica_lineas_reservas(18, 1);
});
function cambiar_fecha_grafica(){

    var grafica_sel = $('#grafica_sel').val();
    var anio_sel=$("#anio_sel option:selected").text();
    var mes_sel=$("#mes_sel").val();
        // alert();

    if(grafica_sel == 'reservas')
    {
        // alert();
        cargar_grafica_barras_reservas(anio_sel,mes_sel);
        cargar_grafica_lineas_reservas(anio_sel,mes_sel);
    }else if(grafica_sel == 'registros'){
        // alert();
        cargar_grafica_barras_registros(anio_sel,mes_sel);
        cargar_grafica_lineas_registros(anio_sel,mes_sel);
    }
}

function cargar_grafica_barras_reservas(anio,mes){
var options={
     chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Numero de Reservas Hechas en el Mes'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
             title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'RESERVAS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'reservas',
            data: []

        }]
}

$("#div_grafica_barras").html( $("#cargador_empresa").html() );

var url = "reservas/"+anio+"/"+mes+"";


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }


 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})

}



function cargar_grafica_lineas_reservas(anio,mes){

var options={
     chart: {
            renderTo: 'div_grafica_lineas',
           
        },
          title: {
            text: 'Numero de Reservas Hechas en el Mes',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'RESERVAS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' reservas'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'reservas',
            data: []
        }]
}

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
var url = "reservas/"+anio+"/"+mes+"";
$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})



}


function cargar_grafica_barras_registros(anio,mes){

var options={
     chart: {
            renderTo: 'div_grafica_barras',
            type: 'column'
        },
        title: {
            text: 'Numero de Registros en el Mes'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [],
             title: {
                text: 'dias del mes'
            },
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'REGISTROS AL DIA'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} </b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'reservas',
            data: []

        }]
}

$("#div_grafica_barras").html( $("#cargador_empresa").html() );

var url = "registros/"+anio+"/"+mes+"";


$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }


 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}



function cargar_grafica_lineas_registros(anio,mes){

var options={
     chart: {
            renderTo: 'div_grafica_lineas',
           
        },
          title: {
            text: 'Numero de Registros en el Mes',
            x: -20 //center
        },
        subtitle: {
            text: '',
            x: -20
        },
        xAxis: {
            categories: []
        },
        yAxis: {
            title: {
                text: 'REGISTROS POR DIA'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: ' registros'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'registros',
            data: []
        }]
}

$("#div_grafica_lineas").html( $("#cargador_empresa").html() );
var url = "registros/"+anio+"/"+mes+"";
$.get(url,function(resul){
var datos= jQuery.parseJSON(resul);
var totaldias=datos.totaldias;
var registrosdia=datos.registrosdia;
var i=0;
    for(i=1;i<=totaldias;i++){
    
    options.series[0].data.push( registrosdia[i] );
    options.xAxis.categories.push(i);


    }
 //options.title.text="aqui e podria cambiar el titulo dinamicamente";
 chart = new Highcharts.Chart(options);

})


}
