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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Middlaware solo admin
Route::middleware(['auth', 'admin'])->group(function () {
    
    //RUTAS PARA PATIENT
    Route::delete('/patients/{id}', 'PatientsController@delete'); //Eliminar paciente

    //Rutas para tiendas
    Route::get('/stores', 'StoresController@index'); //Listado
    Route::get('/stores/create', 'StoresController@create'); //Crear
    Route::post('/stores', 'StoresController@store'); //Guardar 
    Route::get('/stores/{id}/edit', 'StoresController@edit'); //Editar
    Route::post('/stores/{id}/edit', 'StoresController@update'); //actualizar
    Route::delete('/stores/{id}', 'StoresController@delete'); //Eliminar

    //Rutas para tiendas
    Route::get('/concepts', 'ConceptsController@index'); //Listado
    Route::get('/concepts/create', 'ConceptsController@create'); //Crear
    Route::post('/concepts', 'ConceptsController@store'); //Guardar 
    Route::get('/concepts/{id}/edit', 'ConceptsController@edit'); //Editar
    Route::post('/concepts/{id}/edit', 'ConceptsController@update'); //actualizar
    Route::delete('/concepts/{id}', 'ConceptsController@delete'); //Eliminar

    //Rutas para cajeros
    Route::get('/users/{role}/index', 'UsersController@index'); //Listado
    Route::get('/users/{role}/create', 'UsersController@create'); //Crear
    Route::post('users/{role}/', 'UsersController@store'); //Guardar 
    Route::get('users/{role}/{id}/edit', 'UsersController@edit'); //Editar
    Route::post('users/{id}/edit', 'UsersController@update'); //actualizar
    Route::delete('users/{id}', 'UsersController@delete'); //Eliminar

    //Rutas para Consultas
    Route::get('consults/{id}/edit', 'ConsultsController@edit'); //Editar
    Route::post('/consults/{id}/edit', 'ConsultsController@update'); //actualizar paciente
    Route::delete('consults/{id}', 'ConsultsController@delete'); //Eliminar

    //RUTAS PARA CORTE DE CAJA
    Route::get('earning/', 'EarningController@index'); //Inicio
    Route::post('earning/calculate', 'EarningController@calculate'); //Inicio


});

//Middlaware para ADMIN y CAJERO
Route::middleware(['auth', 'cashier'])->group(function () {
    //RUTAS PARA PAIENTES
    Route::get('/patients/create', 'PatientsController@create'); //Crear
    Route::post('/patients', 'PatientsController@store'); //Guardar paciente
    Route::get('/patients/{id}/edit', 'PatientsController@edit'); //Editar
    Route::post('/patients/{id}/edit', 'PatientsController@update'); //actualizar paciente

    //RUTAS PARA CONSULTAS
    Route::get('/consults/create', 'ConsultsController@create');
    Route::post('/consults', 'ConsultsController@store');
});

//Middlaware para los tres perfiles
Route::middleware(['auth'])->group(function () {
    //RUTAS PARA PAIENTES
    Route::get('/patients', 'PatientsController@index')->name('patients'); //Listado

    //RUTAS PARA CONSULTAS
    Route::get('/consults', 'ConsultsController@index');

});
