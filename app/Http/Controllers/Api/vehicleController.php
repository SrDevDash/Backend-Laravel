<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\vehicle as ResourcesVehicle;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class vehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ResourcesVehicle::collection(Vehicle::lasest()->paginate());
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
            "year"=> 'required',
            "make" => 'required',
            "capacity" => 'required',
            "active" => 'required',
        ]);

        $vehicle = new Vehicle([
            "description" => $request->get('description'),
            "year"=> $request->get('year'),
            "make" => $request->get('make'),
            "capacity" => $request->get('capacity'),
            "active" => $request->get('active'),
        ]);

        $vehicle->save();

        return response()->json([
            'message' => 'Vehicle created',
            'data' => $vehicle,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        return new ResourcesVehicle($vehicle);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if(isset($vehicle)){

            $vehicle->description = $request->description;
            $vehicle->year = $request->year;
            $vehicle->make = $request->make;
            $vehicle->capacity = $request->capacity;
            $vehicle->active = $request->active;

            $vehicle->save();

            return response()->json([
                'message' =>'Vehicle updated',
                'data' => $vehicle
            ],200);
        }

        return response()->json([
            'message' => 'Vehicle not found'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);

        if(isset($vehicle)) {
            $vehicle->delete();
            return response()->json([
                'message' => 'Vehicle deleted'
            ],200);
        }

        return response()->json([
            'message' => 'Vehicle Not Found'
        ],404);
    }
}
