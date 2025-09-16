<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Trainee;
use App\Models\Exercise;
use App\Services\PdfService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with('trainee')->get();
        return view('coach.programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $trainees = Trainee::all();
        return view('coach.programs.create', compact('trainees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'trainee_id' => 'required|exists:trainees,id',
                // 'start_date' => 'required|date',
                // 'end_date' => 'required|date|after_or_equal:start_date',
                'days' => 'nullable|array',
                'days.*.day_number' => 'required|integer',
                'days.*.description' => 'nullable|string',
                'days.*.exercises' => 'nullable|array',
                'days.*.exercises.*.exercise_id' => 'required|exists:exercises,id',
                'days.*.exercises.*.sets' => 'required|integer|min:1',
                'days.*.exercises.*.reps' => 'required|string',
                'days.*.exercises.*.rpe' => 'nullable|integer|min:1|max:10',
                'days.*.exercises.*.rest' => 'nullable|integer|min:0',
                'days.*.exercises.*.notes' => 'nullable|string',
            ]);

            $program = Program::create([
                'title' => $validated['title'],
                'trainee_id' => $validated['trainee_id'],
            ]);

            // Process days and exercises
            if (isset($validated['days'])) {
                foreach ($validated['days'] as $dayData) {
                    $day = $program->days()->create([
                        'day_number' => $dayData['day_number'],
                        'description' => $dayData['description'] ?? null,
                    ]);

                    // Process exercises for this day
                    if (isset($dayData['exercises'])) {
                        foreach ($dayData['exercises'] as $exerciseData) {
                            if (!empty($exerciseData['exercise_id'])) {
                                $day->exercises()->attach($exerciseData['exercise_id'], [
                                    'sets' => $exerciseData['sets'],
                                    'reps' => $exerciseData['reps'],
                                    'rpe' => $exerciseData['rpe'] ?? null,
                                    'rest' => $exerciseData['rest'] ?? null,
                                    'notes' => $exerciseData['notes'] ?? null,
                                ]);
                            }
                        }
                    }
                }
            }

            return redirect()->route('programs.show', $program)
                ->with('success', 'Program created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating program: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create program. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Program $program)
    {
        $program->load(['days.exercises', 'trainee']);
        return view('coach.programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Program $program)
    {
        $trainees = Trainee::all();
        $program->load('days', 'days.exercises');
        
        return view('coach.programs.edit', compact('program', 'trainees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Program $program)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'trainee_id' => 'required|exists:trainees,id',
                // 'start_date' => 'required|date',
                // 'end_date' => 'required|date|after_or_equal:start_date',
                'days' => 'nullable|array',
                'days.*.id' => 'nullable|exists:days,id',
                'days.*.day_number' => 'required|integer',
                'days.*.description' => 'nullable|string',
                'days.*.exercises' => 'nullable|array',
                'days.*.exercises.*.id' => 'nullable|exists:day_exercise,id',
                'days.*.exercises.*.exercise_id' => 'required|exists:exercises,id',
                'days.*.exercises.*.sets' => 'required|integer|min:1',
                'days.*.exercises.*.reps' => 'required|string',
                'days.*.exercises.*.rpe' => 'nullable|integer|min:1|max:10',
                'days.*.exercises.*.rest' => 'nullable|integer|min:0',
                'days.*.exercises.*.notes' => 'nullable|string',
            ]);

            // Handle deleted items separately to avoid validation errors when they're not present
            $deletedDays = $request->input('deleted_days', []);
            $deletedExercises = $request->input('deleted_exercises', []);

            $program->update([
                'title' => $validated['title'],
                'trainee_id' => $validated['trainee_id'],
            ]);

            // Handle deleted days
            if (!empty($deletedDays)) {
                $program->days()->whereIn('id', $deletedDays)->delete();
            }

            // Handle deleted exercises
            if (!empty($deletedExercises)) {
                \DB::table('day_exercise')->whereIn('id', $deletedExercises)->delete();
            }

            // Process days and exercises
            if (isset($validated['days'])) {
                foreach ($validated['days'] as $dayData) {
                    // Update or create day
                    if (!empty($dayData['id'])) {
                        // Update existing day
                        $day = $program->days()->find($dayData['id']);
                        if ($day) {
                            $day->update([
                                'day_number' => $dayData['day_number'],
                                'description' => $dayData['description'] ?? null,
                            ]);
                        }
                    } else {
                        // Create new day
                        $day = $program->days()->create([
                            'day_number' => $dayData['day_number'],
                            'description' => $dayData['description'] ?? null,
                        ]);
                    }

                    // Process exercises for this day
                    if (isset($dayData['exercises']) && $day) {
                        foreach ($dayData['exercises'] as $exerciseData) {
                            if (!empty($exerciseData['exercise_id'])) {
                                if (!empty($exerciseData['id'])) {
                                    // Update existing pivot
                                    \DB::table('day_exercise')
                                        ->where('id', $exerciseData['id'])
                                        ->update([
                                            'sets' => $exerciseData['sets'],
                                            'reps' => $exerciseData['reps'],
                                            'rpe' => $exerciseData['rpe'] ?? null,
                                            'rest' => $exerciseData['rest'] ?? null,
                                            'notes' => $exerciseData['notes'] ?? null,
                                        ]);
                                } else {
                                    // Check if this exercise already exists for this day to prevent duplication
                                    $existingExercise = $day->exercises()
                                        ->where('exercise_id', $exerciseData['exercise_id'])
                                        ->wherePivot('day_id', $day->id)
                                        ->first();

                                    if (!$existingExercise) {
                                        // Create new pivot only if it doesn't exist
                                        $day->exercises()->attach($exerciseData['exercise_id'], [
                                            'sets' => $exerciseData['sets'],
                                            'reps' => $exerciseData['reps'],
                                            'rpe' => $exerciseData['rpe'] ?? null,
                                            'rest' => $exerciseData['rest'] ?? null,
                                            'notes' => $exerciseData['notes'] ?? null,
                                        ]);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            return redirect()->route('programs.show', $program)
                ->with('success', 'Program updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating program: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create program. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        // Delete associated days or handle as needed
        $program->delete();

        return redirect()->route('programs.index')
            ->with('success', 'Program deleted successfully.');
    }

    /**
     * Generate PDF for the program.
     */
    public function generatePdf(Request $request, Program $program, PdfService $pdfService)
    {
        $lang = $request->query('lang', 'en');
        return $pdfService->generateProgramPdf($program, $lang);
    }

    /**
     * Stream PDF for the program.
     */
    public function streamPdf(Request $request, Program $program, PdfService $pdfService)
    {
        $lang = $request->query('lang', 'en');
        return $pdfService->streamProgramPdf($program, $lang);
    }
}
