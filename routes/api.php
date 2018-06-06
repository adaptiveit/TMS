<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test','TabController@getActivity');
//Route::get('/test','TabController@call_rest_webservice');


Route::get('test','TabController@form');

/*
 * Webservice Datatable
 */
Route::get ( '/webservice',  'WebserviceController@index');


Route::get('test','TabController@form');


