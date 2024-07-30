<?php
namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        return Schedule::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'day_of_week' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        $schedule = Schedule::create($validated);

        return response()->json($schedule, 201);
    }

    public function show(Schedule $schedule)
    {
        return $schedule;
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'subject' => 'sometimes|required|string|max:255',
            'day_of_week' => 'sometimes|required|string|max:255',
            'start_time' => 'sometimes|required|date_format:H:i',
            'end_time' => 'sometimes|required|date_format:H:i',
        ]);

        $schedule->update($validated);

        return response()->json($schedule);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json(null, 204);
    }
}

