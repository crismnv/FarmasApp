<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de Usuarios</title>
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border: 3px solid #337ab7;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin-left: 280px;
    line-height: 1;

}

.box-title {
    
    vertical-align: middle;
    background-color: #337ab7;
    color:#fff;
    border-radius: 3px;
    padding: 5px;
  

  }

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 0px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}


</style>
    
</head>
<body>

<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Reporte de Usuarios</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>
              </div><!-- /.box -->
              <table class="table table-bordered">
                  <thead style="color:#337ab7;">
                     <tr>
                      <!-- <th class="codigo" style="text-align: center;">Código</th> -->
                      <th style="text-align: center;">Nombre</th>
                      <th style="text-align: center;">Correo</th>
                      <th style="text-align: center;">Reservas</th>
                      <th style="text-align: center;">Fecha De Registro</th>
                      <!-- <th style="width: 40px;text-align: center;">Estado</th>  -->
                      <!-- <th style="width: 40px;text-align: center;">Total</th>  -->
                      
                    </tr>
                  </thead>
                  
                  <tbody>
                  <?php foreach($usuarios as $usuario){ ?>
                 
                    <tr>
                      <!-- <td style="text-align: center; font-size: 13px; "><?= $usuario->id; ?></td> -->
                      <td style="text-align: center; font-size: 11px;"><?= $usuario->name;?></td>
                      <td style="text-align: center; font-size: 13px;"><?= $usuario->email; ?></td>
                      <td style="text-align: center; font-size: 13px;"><?= $usuario->cantidad; ?></td>
                      <td style="text-align: center; font-size: 13px;"><?= $usuario->fecha; ?></td>
                      
                    </tr>
                    
                    <?php  } ?>
                    
                  </tbody>

                  </table> 
              
            </div>


  
</body>
</html>
