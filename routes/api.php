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
<<<<<<< HEAD
Route::get('test','TabController@getActivity');
//Route::get('/test','TabController@call_rest_webservice');


=======
Route::get('test','TabController@form');
>>>>>>> d3b2f00d03d0a405a7499a69b64cbecac0ac10ff
