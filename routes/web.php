<?php
use Illuminate\Http\Request;

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

Auth::routes(/*['register' => false]*/);

Route::get('/', function () {
    return view('capsula.inicio');
});
Route::get('/info', function () {
    return view('capsula.leermas');
});
// Route::put('/info', function () {
//     return view('capsula.leermas');
// });
Route::get('/enviado', function () {
    return view('capsula.enviado');
});
Route::get('/homes', 'HomeController@index')->name('home')->middleware('auth');
Route::resource('pods', 'CorreoController')->names([
    'index' => 'correos',
    'create' => 'correos.create',
    'edit' => 'correos.edit'
])->middleware('auth');

Route::get('login/local', 'Auth\LoginController@local')->name('login-local');
Route::get('auth', 'Auth\LoginController@redirectToProvider')->name('auth');
Route::get('auth/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['middleware' => 'auth'], function () {
  Route::post('/upload', function(Request $request)
  {
    dd($request->all());
  });
  Route::get('/capsula', function () {
      return view('capsula.capsula');
  });

});
