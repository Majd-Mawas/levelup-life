<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exercises = Exercise::all();
        return view('coach.exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coach.exercises.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $exercise = Exercise::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            $exercise->addMediaFromRequest('image')
                ->toMediaCollection('exercise_image');
        }

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise)
    {
        return view('coach.exercises.show', compact('exercise'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return view('coach.exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exercise $exercise)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $exercise->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
        ]);

        if ($request->hasFile('image')) {
            // Clear existing media first
            $exercise->clearMediaCollection('exercise_image');
            // Add new media
            $exercise->addMediaFromRequest('image')
                ->toMediaCollection('exercise_image');
        }

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        // Clear media before deleting
        $exercise->clearMediaCollection('exercise_image');
        $exercise->delete();

        return redirect()->route('exercises.index')
            ->with('success', 'Exercise deleted successfully.');
    }
}
