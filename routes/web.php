<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    //    Route::get('/link1', function ()    {
//        // Uses Auth Middleware
//    });

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});

// Auth::routes();
// Route::get('registro', function () {
//     return view('registro::registro');
// });



// ---------------------------------------------------------------------------------------------------------------------------

// MODULO GRAFICAS
Route::get('graficas/ver',['as' =>'graficas/ver', 'middleware' => 'admin','uses' =>  'GraficaController@Ver']);


Route::get('graficas/reservas/{anio}/{mes}',['as' =>'graficas/reservas', 'middleware' => 'admin' ,'uses' => 'GraficaController@Reservas']);
Route::get('graficas/registros/{anio}/{mes}',['as' =>'graficas/registros', 'middleware' => 'admin' ,'uses' => 'GraficaController@Registros']);

// FIN MODULO GRAFICAS


// MODULO INGREDIENTES

Route::get('ingredientes/crud', ['as' => 'ingredientes/crud', 'middleware' => 'quimico', 'uses' => 'IngredienteController@MostrarCrud']);

Route::post('ingredientes/listar', ['as' => 'ingredientes/listar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ListarIngredientes']);

Route::get('ingredientes/añadir', ['as' => 'ingredientes/añadir', 'middleware' => 'admin', 'uses' => 'IngredienteController@AñadirIngrediente']);

Route::post('ingredientes/añadir', ['as' => 'ingredientes/añadir', 'middleware' => 'quimico', 'uses' => 'IngredienteController@GuardarIngrediente']);

Route::get('ingredientes/modificar', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarIngrediente']);

Route::get('ingredientes/modificar/{id}', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarIngrediente']);

Route::post('ingredientes/modificar', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarGuardarIngrediente']);

Route::get('ingredientes/ver/{id}', ['as' => 'ingredientes/ver', 'middleware' => 'quimico', 'uses' => 'IngredienteController@VerIngrediente']);

Route::post('ingredientes/desactivar/{id}', ['as' => 'ingredientes/desactivar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@DesactivarIngrediente']);

Route::post('ingredientes/activar/{id}', ['as' => 'ingredientes/activar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ActivarIngrediente']);

//FIN MODULO INGREDIENTES
// ---------------------------------------------------------------------------------------------------------------------------
// MODULO USUARIOS

Route::get('users/modificarpersonales/{id}', ['as' => 'users/modificarpersonales', 'middleware' => 'admin', 'uses' => 'UsuarioController@MostrarModificarUsuario']);


Route::post('users/modificarpersonales', ['as' => 'users/modificarpersonales', 'middleware' => 'admin', 'uses' => 'UsuarioController@GuardarModificarUsuario']);
	

// FIN MODULO USUARIOS

// ---------------------------------------------------------------------------------------------------------------------------

// Modulo Preparados


Route::get('preparados/añadir', ['as' => 'preparados/añadir', 'middleware' => 'admin', 'uses' => 'PreparadoController@AñadirPreparado']);
Route::post('preparados/añadir', ['as' => 'preparados/añadir', 'middleware' => 'admin', 'uses' => 'PreparadoController@AñadirGuardarPreparado']);
Route::get('preparados/crud', ['as' => 'preparados/crud', 'middleware' => 'quimico', 'uses' => 'PreparadoController@MostrarCrud']);
Route::post('preparados/listar', ['as' => 'preparados/listar', 'middleware' => 'quimico', 'uses' => 'PreparadoController@ListarPreparados']);

Route::post('preparados/desactivar/{id}', ['as' => 'preparados/desactivar', 'middleware' => 'admin', 'uses' => 'PreparadoController@DesactivarPreparado']);

Route::post('preparados/activar/{id}', ['as' => 'preparados/activar', 'middleware' => 'admin', 'uses' => 'PreparadoController@ActivarPreparado']);

Route::get('preparados/ver/{id}', ['as' => 'preparados/ver', 'middleware' => 'quimico', 'uses' => 'PreparadoController@VerPreparado']);

Route::get('preparados/modificar/{id}', ['as' => 'preparados/modificar', 'middleware' => 'quimico', 'uses' => 'PreparadoController@ModificarPreparado']);
Route::post('preparados/modificar/', ['as' => 'preparados/modificar', 'middleware' => 'quimico', 'uses' => 'PreparadoController@ModificarGuardarPreparado']);

// FIN MODULO PREPARADOS



// MODULO RESERVAS


Route::get('reservas/crear/detallado', ['as' => 'reservas/crear/detallado', 'middleware' => 'todos', 'uses' => 'ReservaController@CrearDetallado']);
Route::post('reservas/crear/detallado', ['as' => 'reservas/crear/detallado', 'middleware' => 'todos', 'uses' => 'ReservaController@GuardarReservaDetallado']);
Route::get('reservas/crear', ['as' => 'reservas/crear', 'middleware' => 'todos', 'uses' => 'ReservaController@Crear']);
Route::post('reservas/crear', ['as' => 'reservas/crear', 'middleware' => 'todos', 'uses' => 'ReservaController@GuardarReserva']);


Route::get('reservas/crud', ['as' => 'reservas/crud', 'middleware' => 'admin', 'uses' => 'ReservaController@MostrarCrud']);
Route::post('reservas/listar', ['as' => 'reservas/listar', 'middleware' => 'admin', 'uses' => 'ReservaController@ListarReservas']);

Route::get('reservas/prueba/{id}', ['as' => 'reservas/prueba', 'middleware' => 'cliente', 'uses' => 'ReservaController@Prueba']);

Route::get('reservas/historial', ['as' => 'reservas/historial', 'middleware' => 'cliente', 'uses' => 'ReservaController@VerHistorial']);

Route::post('reservas/listar/historial', ['as' => 'reservas/listarhistorial', 'uses' => 'ReservaController@ListarHistorial']);

Route::post('reservas/desactivar/{id}', ['as' => 'reservas/desactivar', 'middleware' => 'admin', 'uses' => 'ReservaController@DesactivarReserva']);

Route::post('reservas/activar/{id}', ['as' => 'reservas/activar', 'middleware' => 'admin', 'uses' => 'ReservaController@ActivarReserva']);

Route::post('reservas/RePedir/{id}', ['as' => 'reservas/RePedir', 'middleware' => 'cliente', 'uses' => 'ReservaController@RePedir']);

Route::get('reservas/ver/{id}', ['as' => 'reservas/ver', 'middleware' => 'todos','uses' => 'ReservaController@Ver']);

Route::get('reservas/modificar/{id}', ['as' => 'reservas/modificar', 'middleware' => 'trabajador', 'uses' => 'ReservaController@Modificar']);
Route::post('reservas/modificar', ['as' => 'reservas/modificar', 'middleware' => 'trabajador', 'uses' => 'ReservaController@ModificarGuardar']);

Route::post('preparados/listaringredientes/{id}', ['as' => 'preparados/listaringredientes', 'middleware' => 'cliente', 'uses' => 'ContieneController@Listar_Ingredientes_x_IdPreparado']);


// FIN MODULO PEDIDOS
Route::get('pedidos/crear', ['as' => 'pedidos/crear', 'middleware' => 'admin', 'uses' => 'PedidoController@Crear']);
Route::post('pedidos/crear', ['as' => 'pedidos/crear', 'middleware' => 'admin', 'uses' => 'PedidoController@CrearGuardar']);

Route::get('predidos/crud', ['as' => 'predidos/crud', 'middleware' => 'admin', 'uses' => 'PedidoController@MostrarCrud']);

Route::post('predidos/listar', ['as' => 'predidos/listar', 'middleware' => 'admin', 'uses' => 'PedidoController@ListarReservas']);



// MODULO PEDIDOS




// FIN MODULO PEDIDOS





// MODULO PROVEEDORES

Route::get('proveedores/añadir', ['as' => 'proveedores/añadir', 'middleware' => 'admin', 'uses' => 'ProveedorController@AñadirProveedor']);
Route::post('proveedores/añadir', ['as' => 'proveedores/añadir', 'middleware' => 'admin', 'uses' => 'ProveedorController@AñadirGuardarProveedor']);



Route::get('proveedores/crud', ['as' => 'proveedores/crud', 'middleware' => 'admin', 'uses' => 'ProveedorController@MostrarCrud']);

Route::post('proveedores/listar', ['as' => 'proveedores/listar', 'middleware' => 'admin', 'uses' => 'ProveedorController@ListarProveedores']);




Route::get('proveedores/modificar/{id}', ['as' => 'proveedores/modificar', 'middleware' => 'admin', 'uses' => 'ProveedorController@ModificarProveedor']);

Route::post('proveedores/modificar', ['as' => 'proveedores/modificar', 'middleware' => 'admin', 'uses' => 'ProveedorController@ModificarGuardarProveedor']);

Route::get('proveedores/ver/{id}', ['as' => 'proveedores/ver', 'middleware' => 'admin', 'uses' => 'ProveedorController@VerProveedor']);

Route::post('proveedores/desactivar/{id}', ['as' => 'proveedores/desactivar', 'middleware' => 'admin', 'uses' => 'ProveedorController@DesactivarProveedor']);

Route::post('proveedores/activar/{id}', ['as' => 'proveedores/activar', 'middleware' => 'admin', 'uses' => 'ProveedorController@ActivarProveedor']);
// FIN MODULO PROVEEDORES


// MODULO REPORTES
Route::get('reportes/ver',['as' =>'reportes/ver', 'middleware' => 'admin','uses' =>  'ReporteController@Ver']);

Route::get('reportes/usuarios/{tipo}', 'ReporteController@CrearReporteUsuarios');
Route::get('reportes/reservas/{tipo}', 'ReporteController@CrearReporteReservas');

// FIN MODULO REPORTES

// PRUEBA DE ARRAY SQL

Route::get('prueba', ['as' => 'prueba', 'uses' => 'ContieneController@prueba']);
// FIN ARRAY

//api de reniecc
Route::post('consulta_dni/{dni}', ['as' => 'consulta_dni', 'uses' => 'DniController@getUsuario']);
//registro
Route::get('registro',['as' => 'registro', 'uses' => 'RegistroController@registro']);
// Route::post('registro', ['as' => 'registro', 'uses' => 'RegistroController@registrar']);
Route::post('registro/registro', ['as' =>'registro/registro', 'uses' => 'RegistroController@registrar']);




Route::get('mail', ['as' =>'mail', 'uses' => 'RegistroController@mail'] );
// Route::get('mail', function()
// {
// 	// Mail::to('crisycochea@gmail.com')->send(new ClienteMail());

// 	// $data = array(
// 	// 	'name'=>"CrismnV",);

// 	// Mail::send('adminlte::mail.mail', $data, function($message)
// 	// {
// 	// 	$message->from('cecomp.laravel@gmail.com', 'Listo');
// 	// 	$message->to('crisycochea@gmail.com')->subject('test');
// 	// });
// 	// return "Correcto";
// });
