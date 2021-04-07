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
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::post('/create_user','\App\Http\Controllers\Auth\RegisterController@register');
Route::get('/adminlogin', '\App\Http\Controllers\Auth\LoginController@secureLogin');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/students/dashboard', '\App\Http\Controllers\Students@dashboard');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'admin'], function()
{
    // only /admin/ routes in here that will be in a namespace folder of "backend" with admin middleware
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
