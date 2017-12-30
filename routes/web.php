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

// Modulo Ingredientes

Route::get('ingredientes/crud', ['as' => 'ingredientes/crud', 'middleware' => 'quimico', 'uses' => 'IngredienteController@MostrarCrud']);

Route::post('ingredientes/listar', ['as' => 'ingredientes/listar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ListarIngredientes']);

Route::get('ingredientes/añadir', ['as' => 'ingredientes/añadir', 'middleware' => 'quimico', 'uses' => 'IngredienteController@AñadirIngrediente']);

Route::post('ingredientes/añadir', ['as' => 'ingredientes/añadir', 'middleware' => 'quimico', 'uses' => 'IngredienteController@GuardarIngrediente']);

Route::get('ingredientes/modificar', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarIngrediente']);

Route::get('ingredientes/modificar/{id}', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarIngrediente']);

Route::post('ingredientes/modificar', ['as' => 'ingredientes/modificar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ModificarGuardarIngrediente']);

Route::get('ingredientes/ver/{id}', ['as' => 'ingredientes/ver', 'middleware' => 'quimico', 'uses' => 'IngredienteController@VerIngrediente']);

Route::post('ingredientes/desactivar/{id}', ['as' => 'ingredientes/desactivar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@DesactivarIngrediente']);

Route::post('ingredientes/activar/{id}', ['as' => 'ingredientes/activar', 'middleware' => 'quimico', 'uses' => 'IngredienteController@ActivarIngrediente']);

//fin modulo ingredientes


//api de reniecc
Route::post('consulta_dni/{dni}', ['as' => 'consulta_dni', 'uses' => 'DniController@getUsuario']);
//registro
Route::get('registro',['as' => 'registro', 'uses' => 'RegistroController@registro']);
// Route::post('registro', ['as' => 'registro', 'uses' => 'RegistroController@registrar']);
Route::post('registro/registro', ['as' =>'registro/registro', 'uses' => 'RegistroController@registrar']);

