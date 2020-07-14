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
    return view('capsula.inicio');
});
Route::get('/capsula', function () {
    return view('capsula.capsula');
});
Route::get('/info', function () {
    return view('capsula.leermas');
});
Route::get('/enviado', function () {
    return view('capsula.enviado');
});
Route::get('/homes', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('insert', 'CorreoController')->names([
    'index' => 'correos',
    'create' => 'correos.create',
    'edit' => 'correos.edit'
]);

Route::get('login/local', 'Auth\LoginController@local')->name('login-local');
Route::get('auth', 'Auth\LoginController@redirectToProvider');
Route::get('auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('register', function () { return redirect('home'); });
Route::post('register', function () { return redirect('home'); });
