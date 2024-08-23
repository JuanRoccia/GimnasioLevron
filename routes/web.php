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




Route::get("/logout", function () {
    Auth::logout();
    return redirect()->route("home");
})->name("logout");

Auth::routes();
Route::middleware("auth")
    ->group(function () {
  Route::get('/', 'SocioController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('socios', 'SocioController');
Route::resource('cuotas', 'CuotaController');
Route::resource("usuarios", "UserController")->parameters(["usuarios" => "user"]);
Route::get('enviaremail', 'CuotaController@enviaremail');
});
