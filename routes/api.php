<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\DriverResource;
use App\Models\Driver;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Driver
Route::get('/driver/{id}', function ($id) {
    return new DriverResource(Driver::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/drivers', function () {
    return DriverResource::collection(Driver::all());
});


Route::put('/driver/{id}', function ($id) {
    return new DriverResource(Driver::findOrFail($id));
})->middleware('auth:sanctum');


Route::post('/driver/create',function(Request $request)
{
    Console::info(['first' => $request]);
});

Route::delete('/driver/{id}', function ($id) {
    return new DriverResource(Driver::findOrFail($id)->delete());
});

Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);
