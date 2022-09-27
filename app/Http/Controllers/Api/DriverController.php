<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use App\Http\Resources\DriverResource;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DriverResource::collection(Driver::lasest()->paginate());
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
            "last_name" => 'required',
            "first_name"=> 'required',
            "active" => 'required',
            "ssd" => 'required',
            "dob" => 'required',
        ]);

        $driver = new Driver([
            "last_name" => $request->get('last_name'),
            "first_name"=> $request->get('first_name'),
            "active" => $request->get('active'),
            "address" => $request->get('address'),
            "city" => $request->get('city'),
            "zip" => $request->get('zip'),
            "phone" => $request->get('phone'),
            "dob" => $request->dob,
            "ssd" => $request->ssd
        ]);

        $driver->save();

        return response()->json([
            'message' => 'Driver created',
            'data' => $driver,
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return new DriverResource($driver);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);

        if(isset($driver)){
            $driver->last_name = $request->last_name;
            $driver->first_name = $request->first_name;
            $driver->active = $request->active;
            $driver->address = $request->address;
            $driver->city = $request->city;
            $driver->zip = $request->zip;
            $driver->phone = $request->phone;

            $driver->save();

            return response()->json([
                'message' =>'Driver updated',
                'data' => $driver
            ],200);
        }

        return response()->json([
            'message' => 'Driver not found'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver = Driver::find($id);

        if(isset($driver)) {
            $driver->delete();
            return response()->json([
                'message' => 'Driver deleted'
            ],200);
        }

        return response()->json([
            'message' => 'Driver Not Found'
        ],404);
    }
}
