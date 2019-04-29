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

Route::get('/',function(){
	return view('login');
});
Route::post('/loginApi','AuthController@loginApi')->name('loginApi');
 
Route::get('/dashboard','DashboardController@showDashboard')->name('showDashboard');
Route::get('/logout','AuthController@showLogout')->name('showLogout');
Route::get('/user/add','AuthController@showadduser')->name('showadduser');
Route::get('/user/event/add','AuthController@showaddevent')->name('showaddevent');
Route::post('/useradd','UserController@addUserApi')->name('addUserApi');
Route::get('/user/list','AuthController@listuser')->name('listuser');
Route::post('/eventadd','EventController@addEventApi')->name('addEventApi');
Route::get('/event/list','AuthController@listevent')->name('listevent');