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
    Route::resource('privilege', 'User\PrivilegeController');
    # Role
    Route::resource('role', 'User\RoleController');
    # User
    Route::resource('user', 'User\UserController');
	# Fleet
    Route::resource('fleet', 'FleetController');
       
   Route::resource('role', 'RoleController');
   
   Route::resource('fleettype', 'fleettypeController');
   Route::resource('fuelstation', 'FuelstationController');
   
  Route::resource('group', 'GroupController');
  
  Route::resource('option', 'OptionController'); 
  //Route::resource('demo', 'DemoController'); 
 
    
});
Route::get('admin',array('as'=>'demo','uses'=>'DemoController@index'));
Route::get('admin/ajax/{id}',array('as'=>'demo.ajax','uses'=>'DemoController@myformAjax'));

Route::get('admin/list',array('as'=>'tab','uses'=>'TabController@list'));
Route::get('admin/json',array('as'=>'tab','uses'=>'TabController@form'));

Route::get('autocomplete', 'AjaxAutocompleteController@index');
Route::get('searchajax', ['as'=>'searchajax','uses'=>'AjaxAutocompleteController@searchResponse']);


//Route::get('search/autocomplete', 'DemoController@autocomplete');
//Route::get('admin',array('as'=>'demo','uses'=>'DemoController@searchResponse'));
//Route::get('searchajax', ['as'=>'demo.searchajax','uses'=>'DemoController@searchResponse']);

//Route::get('/admin/fleettype', 'fleettypeController@create')->name('fleettype.create');
//Route::get('/admin/list', 'fleettypeController@index')->name('fleettype.index');
//Route::post('/admin/fleettype', 'fleettypeController@store')->name('fleettype.store');
//Route::get('/admin/fleettype/edit/{id}', 'fleettypeController@edit')->name('fleettype.edit');
//Route::put('/admin/fleettype/edit/{id}', 'fleettypeController@update')->name('fleettype.update');





/*Route::get('/form',function(){
   return view('form');
});*/
