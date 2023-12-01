<?php

use Illuminate\Support\Facades\Route;

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
    if (session()->exists('userLogin') && session('rol')=='Invitado') {
        return redirect('invitado');
    }else if (session()->exists('userLogin')) {
        return redirect('home');
    }else{
        return view('auth.login');	
    }
});

Route::get('/login/nuevoToken', function () {
    return response()->json(['token' => csrf_token()]);
});


Route::get('/home', 'HomeController@index')->middleware('checkUserRole');;
Route::get('/invitado', 'InvitadoController@index');
Route::get('/login', 'Auth\LoginController@show')->name('login');
Route::get('/register', 'Auth\RegisterController@show');
Route::post('/login/logout', 'Auth\LoginController@logout');

Route::post('/login/loguearse', 'Auth\LoginController@loguearse');
// Route::resource('/login', 'Auth\LoginController');