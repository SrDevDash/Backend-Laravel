<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\DriverResource;
use App\Http\Resources\vehicle;
use App\Http\Resources\route as RouteResource;
use App\Http\Resources\ScheduleResorce;
use App\Models\Driver;
use App\Models\Route as ModelsRoute;
use App\Models\Schedules;
use App\Models\vehicle as ModelsVehicle;

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

Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);



// Driver //

Route::get('/driver/{id}', function ($id) {
    return new DriverResource(Driver::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/drivers', function () {
    return DriverResource::collection(Driver::all());
})->middleware('auth:sanctum');

Route::put('/driver/{id}', [App\Http\Controllers\Api\DriverController::class, 'update'])->middleware('auth:sanctum');

Route::post('/driver/create', [App\Http\Controllers\Api\DriverController::class, 'store'])->middleware('auth:sanctum');

Route::delete('/driver/{id}', [App\Http\Controllers\Api\DriverController::class, 'destroy'])->middleware('auth:sanctum');




// Vehicle //
Route::get('/vehicle/{id}', function ($id) {
    return new vehicle(ModelsVehicle::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/vehicles', function () {
    return vehicle::collection(ModelsVehicle::all());
})->middleware('auth:sanctum');

Route::put('/vehicle/{id}', [App\Http\Controllers\Api\vehicleController::class, 'update'])
    ->middleware('auth:sanctum');

Route::post('/vehicle/create', [App\Http\Controllers\Api\vehicleController::class, 'store'])
    ->middleware('auth:sanctum');

Route::delete('/vehicle/{id}', [App\Http\Controllers\Api\vehicleController::class, 'destroy'])
    ->middleware('auth:sanctum');


// Route //
Route::get('/route/{id}', function ($id) {
    return new RouteResource(ModelsRoute::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/routes', function () {
    return RouteResource::collection(ModelsRoute::all());
})->middleware('auth:sanctum');

Route::put('/route/{id}', [App\Http\Controllers\Api\routeController::class, 'update'])
    ->middleware('auth:sanctum');

Route::post('/route/create', [App\Http\Controllers\Api\routeController::class, 'store'])
    ->middleware('auth:sanctum');

Route::delete('/route/{id}', [App\Http\Controllers\Api\routeController::class, 'destroy'])
    ->middleware('auth:sanctum');

//schedule//

Route::get('/schedule/{id}', function ($id) {
    return new ScheduleResorce(Schedules::findOrFail($id));
})->middleware('auth:sanctum');

Route::get('/schedules', function () {
    return ScheduleResorce::collection(Schedules::all());
})->middleware('auth:sanctum');

Route::put('/schedule/{id}', [App\Http\Controllers\Api\ScheduleController::class, 'update'])
    ->middleware('apiAuth');

Route::post('/schedule/create', [App\Http\Controllers\Api\ScheduleController::class, 'store'])
    ->middleware('auth:api');

Route::delete('/schedule/{id}', [App\Http\Controllers\Api\ScheduleController::class, 'destroy'])
    ->middleware('auth:api');
