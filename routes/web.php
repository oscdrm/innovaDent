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

Route::get('/', 'testController@probando');

Route::get('/prueba', function(){ 
    return 'Hola soy Oscar, mundo laravel';
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
