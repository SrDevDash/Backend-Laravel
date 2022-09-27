<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResorce;
use App\Models\Route;
use App\Models\Schedules;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScheduleResorce::collection(Schedules::lastest()->paginate());
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
            "route_id" => 'required',
            "week_num" => 'required',
            "from" => 'required',
            "to" => 'required',
            "active" => 'required',
        ]);

        if ($this->routeExist($request)) {

            $scheduleNew = new Schedules([
                'route_id' => $request->route_id,
                'week_num' => $request->week_num,
                'from' => $request->from,
                'to' => $request->to,
                'active' => $request->active,
            ]);

            $scheduleNew->save();

            return response()->json([
                'message' => 'Schedule created',
                'data' => $scheduleNew
            ], 201);
        }

        return response()->json([
            'message' => 'Route doesnt exist',
            'data' => null
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ScheduleResorce::collection(Schedules::lastest()->paginate());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedules::find($id);

        if(!isset($schedule)){
            return response()->json([
                'message' => 'Schedule not found',
            ], 404);
        }

        if ($this->routeExist($request->route_id)) {

            $schedule->route_id = $request->route_id;
            $schedule->week_num = $request->week_num;
            $schedule->from = $request->from;
            $schedule->to = $request->to;
            $schedule->active = $request->active;

            $schedule->save();

            return response()->json([
                'message' => 'Schedule updated',
                'data' => $schedule
            ], 200);
        }

            return response()->json([
                'message' => 'Route not found',
            ], 404);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Route::find($id);

        if (isset($schedule)) {
            $schedule->delete();
            return response()->json([
                'message' => 'Schedule deleted'
            ], 200);
        }

        return response()->json([
            'message' => 'Schedule Not Found'
        ], 404);
    }

    public function routeExist($id)
    {
        return null != Route::find($id);
    }
}
