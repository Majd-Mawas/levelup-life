<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Program;
use App\Models\Exercise;
use Illuminate\Http\Request;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Days are typically accessed through programs
        return redirect()->route('programs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $program_id = request('program_id');
        $program = Program::findOrFail($program_id);
        $exercises = Exercise::all();
        
        return view('coach.days.create', compact('program', 'exercises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'day_number' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'exercise_ids' => 'required|array',
            'exercise_ids.*' => 'exists:exercises,id',
            'sets' => 'required|array',
            'sets.*' => 'integer|min:1',
            'reps' => 'required|array',
            'reps.*' => 'string|max:255',
            'rest' => 'required|array',
            'rest.*' => 'string|max:255',
        ]);

        $day = Day::create([
            'program_id' => $validated['program_id'],
            'day_number' => $validated['day_number'],
            'name' => $validated['name'],
            'notes' => $validated['notes'],
        ]);

        // Attach exercises with pivot data
        foreach ($validated['exercise_ids'] as $index => $exerciseId) {
            $day->exercises()->attach($exerciseId, [
                'sets' => $validated['sets'][$index],
                'reps' => $validated['reps'][$index],
                'rest' => $validated['rest'][$index],
            ]);
        }

        return redirect()->route('programs.show', $validated['program_id'])
            ->with('success', 'Day created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        $day->load(['exercises', 'program']);
        return view('coach.days.show', compact('day'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Day $day)
    {
        $exercises = Exercise::all();
        $day->load('exercises');
        return view('coach.days.edit', compact('day', 'exercises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Day $day)
    {
        $validated = $request->validate([
            'day_number' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'exercise_ids' => 'required|array',
            'exercise_ids.*' => 'exists:exercises,id',
            'sets' => 'required|array',
            'sets.*' => 'integer|min:1',
            'reps' => 'required|array',
            'reps.*' => 'string|max:255',
            'rest' => 'required|array',
            'rest.*' => 'string|max:255',
        ]);

        $day->update([
            'day_number' => $validated['day_number'],
            'name' => $validated['name'],
            'notes' => $validated['notes'],
        ]);

        // Sync exercises with pivot data
        $day->exercises()->detach();
        foreach ($validated['exercise_ids'] as $index => $exerciseId) {
            $day->exercises()->attach($exerciseId, [
                'sets' => $validated['sets'][$index],
                'reps' => $validated['reps'][$index],
                'rest' => $validated['rest'][$index],
            ]);
        }

        return redirect()->route('programs.show', $day->program_id)
            ->with('success', 'Day updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $programId = $day->program_id;
        $day->exercises()->detach();
        $day->delete();

        return redirect()->route('programs.show', $programId)
            ->with('success', 'Day deleted successfully.');
    }
}
