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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'web', 'prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@index');
    Route::get('login', 'AdminController@getLogin');
    Route::post('login', 'AdminController@login');
    Route::get('logout', 'AdminController@logout');
    Route::get('forbidden', function(){
        $title = "Forbidden";
        return view('forbidden', compact('title'));
    });
});

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin'], function() {
    # Admin Dashboard
    Route::get('dashboard', 'DashboardController@index');

    # Privilege
    Route::resource('privilege', 'PrivilegeController');
    # Role
    Route::resource('role', 'RoleController');
    # User
    Route::resource('user', 'User\UserController');
	# Fleet
    Route::resource('fleet', 'FleetController');
    
 
    
});

Route::get('/admin/fleettype', 'fleettypeController@create')->name('fleettype.create');
Route::post('/admin/fleettype', 'fleettypeController@store')->name('fleettype.store');



Route::get('/form',function(){
   return view('form');
});
