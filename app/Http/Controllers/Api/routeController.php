<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Http\Request;
use App\Http\Resources\route as ResourcesRoute;
use App\Http\Resources\vehicle;
use App\Models\Driver;
use App\Models\Vehicle as ModelsVehicle;

class routeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesRoute::collection(Route::lasest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "description" => 'required',
            "driver_id" => 'required',
            "vehicle_id" => 'required',
            "active" => 'required',
        ]);

        $resp = $this->checkForignKey($request);

        return response()->json([
            'message' => $resp['msg'],
            'data' => $resp['data']
        ], $resp['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(route $route)
    {
        return new ResourcesRoute($route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $route = Route::find($id);
        $resp = $this->checkForignKey($request, false);

        if (isset($route) && $resp['code'] == 201) {

            $route->description = $request->description;
            $route->vehicle_id = $request->vehicle_id;
            $route->driver_id = $request->driver_id;
            $route->active = $request->active;

            $route->save();

            return response()->json([
                'message' => 'Route updated',
                'data' => $route
            ], 200);
        }

        return response()->json([
            'message' => 'Route not found or Driver || Vehicle doesnt exist'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $route = Route::find($id);

        if (isset($route)) {
            $route->delete();
            return response()->json([
                'message' => 'Route deleted'
            ], 200);
        }

        return response()->json([
            'message' => 'Route Not Found'
        ], 404);
    }

    // Busca si existe un driver y un vehiculo con los id que recibe
    public function checkForignKey(Request $request, $create = true)
    {

        $data = null;
        $msg = '';
        $code = 404;

        if (Driver::find($request->driver_id)) {
            if (ModelsVehicle::find($request->vehicle_id)) {
                $route = new Route([
                    "description" => $request->description,
                    "driver_id" => $request->driver_id,
                    "vehicle_id" => $request->vehicle_id,
                    "active" => $request->active,
                ]);

                if ($create) {
                    $route->save();
                }


                $data = $route;
                $msg = 'Route created';
                $code = 201;
            } else {
                $msg = 'Vehicle not found';
                $code = 400;
            }
        } else {
            $msg = 'Driver not found';
            $code = 400;
        }

        return [
            'msg' => $msg,
            'data' => $data,
            'code' => $code
        ];
    }
}
