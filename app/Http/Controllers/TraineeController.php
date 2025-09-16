<?php

namespace App\Http\Controllers;

use App\Models\Trainee;
use Illuminate\Http\Request;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainees = Trainee::all();
        return view('coach.trainees.index', compact('trainees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coach.trainees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'gender' => 'nullable|string|in:male,female,other',
            'notes' => 'nullable|string',
        ]);

        Trainee::create($validated);

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Trainee $trainee)
    {
        $programs = $trainee->programs;
        return view('coach.trainees.show', compact('trainee', 'programs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trainee $trainee)
    {
        return view('coach.trainees.edit', compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trainee $trainee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'gender' => 'nullable|string|in:male,female,other',
            'notes' => 'nullable|string',
        ]);

        $trainee->update($validated);

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trainee $trainee)
    {
        // Delete associated programs or handle as needed
        $trainee->delete();

        return redirect()->route('trainees.index')
            ->with('success', 'Trainee deleted successfully.');
    }
}
