<?php

use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', 'API\SessionController@register');
Route::post('/login', 'API\SessionController@login');

// Route::get('/logout', 'API\SessionController@logout')->middleware('auth:api');
// Route::get('/test', function ($id) {
//     return Response()->json(['Hello' => 'works!']);
// })->middleware('auth::api');

Route::middleware('auth:api')->group(function() {
    Route::get('/logout', 'API\SessionController@logout');
    Route::get('/test', function () {
        echo 'You now have access to this module!';
    });
});