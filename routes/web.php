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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function(){

    return view('auth/login');

});

Route::get('/prueba', function(){ 
    return 'Hola soy Oscar, mundo laravel';
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//RUTAS PARA PAIENTES
Route::get('/patients', 'PatientsController@index')->name('patients'); //Listado
Route::get('/patients/create', 'PatientsController@create'); //Crear
Route::post('/patients', 'PatientsController@store'); //Guardar paciente
Route::get('/patients/{id}/edit', 'PatientsController@edit'); //Editar
Route::post('/patients/{id}/edit', 'PatientsController@update'); //actualizar paciente
Route::delete('/patients/{id}', 'PatientsController@delete'); //actualizar paciente

//Rutas para tiendas
Route::get('/stores', 'StoresController@index'); //Listado
Route::get('/stores/create', 'StoresController@create'); //Crear
Route::post('/stores', 'StoresController@store'); //Guardar 
Route::get('/stores/{id}/edit', 'StoresController@edit'); //Editar
Route::post('/stores/{id}/edit', 'StoresController@update'); //actualizar
Route::delete('/stores/{id}', 'StoresController@delete'); //Eliminar

//Rutas para concepto
//Rutas para tiendas
Route::get('/concepts', 'ConceptsController@index'); //Listado
Route::get('/concepts/create', 'ConceptsController@create'); //Crear
Route::post('/concepts', 'ConceptsController@store'); //Guardar 
Route::get('/concepts/{id}/edit', 'ConceptsController@edit'); //Editar
Route::post('/concepts/{id}/edit', 'ConceptsController@update'); //actualizar
Route::delete('/concepts/{id}', 'ConceptsController@delete'); //actualizar

