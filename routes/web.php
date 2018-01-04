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
Route::get('preparados/crud', ['as' => 'preparados/crud', 'middleware' => 'admin', 'uses' => 'PreparadoController@MostrarCrud']);
Route::post('preparados/listar', ['as' => 'preparados/listar', 'middleware' => 'admin', 'uses' => 'PreparadoController@ListarPreparados']);

Route::post('preparados/desactivar/{id}', ['as' => 'preparados/desactivar', 'middleware' => 'admin', 'uses' => 'PreparadoController@DesactivarPreparado']);

Route::post('preparados/activar/{id}', ['as' => 'preparados/activar', 'middleware' => 'admin', 'uses' => 'PreparadoController@ActivarPreparado']);


// FIN MODULO PREPARADS

// MODULO PROVEEDORES

Route::get('proveedores/añadir', ['as' => 'proveedores/añadir', 'middleware' => 'admin', 'uses' => 'ProveedorController@AñadirProveedor']);
Route::post('proveedores/añadir', ['as' => 'proveedores/añadir', 'middleware' => 'admin', 'uses' => 'ProveedorController@AñadirGuardarProveedor']);



Route::get('proveedores/crud', ['as' => 'proveedores/crud', 'middleware' => 'quimico', 'uses' => 'ProveedorController@MostrarCrud']);

Route::post('proveedores/listar', ['as' => 'proveedores/listar', 'middleware' => 'quimico', 'uses' => 'ProveedorController@ListarProveedores']);




Route::get('proveedores/modificar/{id}', ['as' => 'proveedores/modificar', 'middleware' => 'quimico', 'uses' => 'ProveedorController@ModificarProveedor']);

Route::post('proveedores/modificar', ['as' => 'proveedores/modificar', 'middleware' => 'quimico', 'uses' => 'ProveedorController@ModificarGuardarProveedor']);

Route::get('proveedores/ver/{id}', ['as' => 'proveedores/ver', 'middleware' => 'quimico', 'uses' => 'ProveedorController@VerProveedor']);

Route::post('proveedores/desactivar/{id}', ['as' => 'proveedores/desactivar', 'middleware' => 'admin', 'uses' => 'ProveedorController@DesactivarProveedor']);

Route::post('proveedores/activar/{id}', ['as' => 'proveedores/activar', 'middleware' => 'admin', 'uses' => 'ProveedorController@ActivarProveedor']);
// FIN MODULO PROVEEDORES

// PRUEBA DE ARRAY SQL

Route::get('prueba', ['as' => 'prueba', 'uses' => 'ContieneController@prueba']);
// FIN ARRAY
//api de reniecc
Route::post('consulta_dni/{dni}', ['as' => 'consulta_dni', 'uses' => 'DniController@getUsuario']);
//registro
Route::get('registro',['as' => 'registro', 'uses' => 'RegistroController@registro']);
// Route::post('registro', ['as' => 'registro', 'uses' => 'RegistroController@registrar']);
Route::post('registro/registro', ['as' =>'registro/registro', 'uses' => 'RegistroController@registrar']);

