@extends('layouts.vertical', ['title' => 'Edit Training Program', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Training Program</h1>
            <a href="{{ route('programs.show', $program) }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Back to Details
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('programs.update', $program) }}" method="POST">
                @csrf
                @method('PUT')
                <div id="deleted-items" style="display: none;"></div>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Program
                        title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $program->title) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Program
                        Description</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="trainee_id"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Trainee</label>
                    <select name="trainee_id" id="trainee_id"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                        <option value="">Select Trainee</option>
                        @foreach ($trainees as $trainee)
                            <option value="{{ $trainee->id }}"
                                {{ old('trainee_id', $program->trainee_id) == $trainee->id ? 'selected' : '' }}>
                                {{ $trainee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('trainee_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                {{--
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $program->start_date) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $program->end_date) }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div> --}}

                <!-- Training Days Section -->
                <div class="mb-6 border-t pt-4 mt-4">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Training Days</h2>

                    <div id="days-container">
                        @forelse($program->days as $dayIndex => $day)
                            <div class="day-section mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-md">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="font-medium text-gray-700 dark:text-gray-300">Day {{ $day->day_number }}
                                    </h3>
                                    <button type="button" class="text-red-500 hover:text-red-700 remove-day-btn"
                                        onclick="removeDay(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                                <input type="hidden" name="days[{{ $dayIndex }}][id]" value="{{ $day->id }}">
                                <input type="hidden" name="days[{{ $dayIndex }}][day_number]"
                                    value="{{ $day->day_number }}">

                                <div class="mb-3">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                    <textarea name="days[{{ $dayIndex }}][description]" rows="2"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ $day->description }}</textarea>
                                </div>

                                <!-- Exercises for this day -->
                                <div class="exercises-container">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Exercises</h4>

                                    @forelse($day->exercises as $exerciseIndex => $exercise)
                                    {{-- @dd($exercise->pivot->id ) --}}
                                        <div class="exercise-item mb-3 p-3 rounded-md">
                                            <input type="hidden"
                                                name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][id]"
                                                value="{{ $exercise->pivot->id }}">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exercise</label>
                                                    <select
                                                        name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][exercise_id]"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                        <option value="">Select Exercise</option>
                                                        @foreach (\App\Models\Exercise::all() as $ex)
                                                            <option value="{{ $ex->id }}"
                                                                {{ $exercise->id == $ex->id ? 'selected' : '' }}>
                                                                {{ $ex->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                                        <input type="number"
                                                            name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][sets]"
                                                            min="1" value="{{ $exercise->pivot->sets }}"
                                                            class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                                        <input type="text"
                                                            name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][reps]"
                                                            value="{{ $exercise->pivot->reps }}"
                                                            class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">RPE</label>
                                                    <input type="number"
                                                        name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][rpe]"
                                                        min="1" value="{{ $exercise->pivot->rpe }}"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Rest
                                                        (seconds)
                                                    </label>
                                                    <input type="number"
                                                        name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][rest]"
                                                        min="0" step="5" value="{{ $exercise->pivot->rest }}"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Notes</label>
                                                    <input type="text"
                                                        name="days[{{ $dayIndex }}][exercises][{{ $exerciseIndex }}][notes]"
                                                        value="{{ $exercise->pivot->notes }}"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="button" class="text-red-500 hover:text-red-700 text-xs"
                                                    onclick="removeExercise(this)">
                                                    Remove Exercise
                                                </button>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="exercise-item mb-3 p-3  rounded-md">
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exercise</label>
                                                    <select name="days[{{ $dayIndex }}][exercises][0][exercise_id]"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                        <option value="">Select Exercise</option>
                                                        @foreach (\App\Models\Exercise::all() as $exercise)
                                                            <option value="{{ $exercise->id }}">{{ $exercise->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="grid grid-cols-2 gap-2">
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                                        <input type="number"
                                                            name="days[{{ $dayIndex }}][exercises][0][sets]"
                                                            min="1" value="3"
                                                            class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    </div>
                                                    <div>
                                                        <label
                                                            class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                                        <input type="text"
                                                            name="days[{{ $dayIndex }}][exercises][0][reps]"
                                                            value="10"
                                                            class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">RPE</label>
                                                    <input type="number"
                                                        name="days[{{ $dayIndex }}][exercises][0][rpe]"
                                                        min="1" value="7"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Rest
                                                        (seconds)</label>
                                                    <input type="number"
                                                        name="days[{{ $dayIndex }}][exercises][0][rest]"
                                                        min="0" step="5" value="60"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Notes</label>
                                                    <input type="text"
                                                        name="days[{{ $dayIndex }}][exercises][0][notes]"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="button" class="text-red-500 hover:text-red-700 text-xs"
                                                    onclick="removeExercise(this)">
                                                    Remove Exercise
                                                </button>
                                            </div>
                                        </div>
                                    @endforelse

                                    <button type="button"
                                        class="add-exercise-btn text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                                        onclick="addExercise(this, {{ $dayIndex }})">
                                        + Add Exercise
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="day-section mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-md">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="font-medium text-gray-700 dark:text-gray-300">Day 1</h3>
                                    <button type="button" class="text-red-500 hover:text-red-700 remove-day-btn"
                                        onclick="removeDay(this)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                                <input type="hidden" name="days[0][day_number]" value="1">

                                <div class="mb-3">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                                    <textarea name="days[0][description]" rows="2"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                                </div>

                                <!-- Exercises for this day -->
                                <div class="exercises-container">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Exercises</h4>

                                    <div class="exercise-item mb-3 p-3 rounded-md">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exercise</label>
                                                <select name="days[0][exercises][0][exercise_id]"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                    <option value="">Select Exercise</option>
                                                    @foreach (\App\Models\Exercise::all() as $exercise)
                                                        <option value="{{ $exercise->id }}">{{ $exercise->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="grid grid-cols-2 gap-2">
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                                    <input type="number" name="days[0][exercises][0][sets]"
                                                        min="1" value="3"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                                    <input type="text" name="days[0][exercises][0][reps]"
                                                        value="10"
                                                        class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">RPE</label>
                                                <input type="number" name="days[0][exercises][0][rpe]" min="1"
                                                    value="7"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Rest
                                                    (seconds)</label>
                                                <input type="number" name="days[0][exercises][0][rest]" min="0"
                                                    step="5" value="60"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Notes</label>
                                                <input type="text" name="days[0][exercises][0][notes]"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            </div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button" class="text-red-500 hover:text-red-700 text-xs"
                                                onclick="removeExercise(this)">
                                                Remove Exercise
                                            </button>
                                        </div>
                                    </div>

                                    <button type="button"
                                        class="add-exercise-btn text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                                        onclick="addExercise(this, 0)">
                                        + Add Exercise
                                    </button>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <button type="button" id="add-day-btn"
                        class="mt-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-2 rounded-md hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                        + Add Training Day
                    </button>
                </div>

                <!-- Hidden inputs for deleted items -->
                <div id="deleted-items">
                    <!-- Hidden inputs will be dynamically added here for deleted days and exercises -->
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Track deleted items
        let deletedDays = [];
        let deletedExercises = [];

        // Initial day count based on existing days or default to 1
        let dayCount = {{ $program->days->count() > 0 ? $program->days->max('day_number') : 1 }};

        document.getElementById('add-day-btn').addEventListener('click', function() {
            dayCount++;
            const dayIndex = document.querySelectorAll('.day-section').length;

            const dayTemplate = `
                <div class="day-section mb-4 p-4 border border-gray-200 dark:border-gray-700 rounded-md">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-medium text-gray-700 dark:text-gray-300">Day ${dayCount}</h3>
                        <button type="button" class="text-red-500 hover:text-red-700 remove-day-btn" onclick="removeDay(this)">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>

                    <input type="hidden" name="days[${dayIndex}][day_number]" value="${dayCount}">

                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                        <textarea name="days[${dayIndex}][description]" rows="2" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                    </div>

                    <div class="exercises-container">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Exercises</h4>

                        <div class="exercise-item mb-3 p-3  rounded-md">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exercise</label>
                                    <select name="days[${dayIndex}][exercises][0][exercise_id]" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="">Select Exercise</option>
                                        @foreach (\App\Models\Exercise::all() as $exercise)
                                            <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                        <input type="number" name="days[${dayIndex}][exercises][0][sets]" min="1" value="3" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                        <input type="text" name="days[${dayIndex}][exercises][0][reps]" value="10" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">RPE</label>
                                    <input type="number" name="days[${dayIndex}][exercises][0][rpe]" min="1" value="7" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Rest (seconds)</label>
                                    <input type="number" name="days[${dayIndex}][exercises][0][rest]" min="0" step="5" value="60" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Notes</label>
                                    <input type="text" name="days[${dayIndex}][exercises][0][notes]" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" class="text-red-500 hover:text-red-700 text-xs" onclick="removeExercise(this)">
                                    Remove Exercise
                                </button>
                            </div>
                        </div>

                        <button type="button" class="add-exercise-btn text-sm bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-3 py-1 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors" onclick="addExercise(this, ${dayIndex})">
                            + Add Exercise
                        </button>
                    </div>
                </div>
            `;

            document.getElementById('days-container').insertAdjacentHTML('beforeend', dayTemplate);
        });

        function removeDay(button) {
            const daySection = button.closest('.day-section');
            const dayIdInput = daySection.querySelector('input[name*="[id]"]');

            // If this is an existing day (has an ID), add it to deleted days
            if (dayIdInput && dayIdInput.value) {
                deletedDays.push(dayIdInput.value);
                document.getElementById('deleted-days').value = JSON.stringify(deletedDays);

                // Add each deleted day ID as a separate input for proper array handling
                const deletedDaysContainer = document.getElementById('deleted-items');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleted_days[]';
                input.value = dayIdInput.value;
                deletedDaysContainer.appendChild(input);
            }

            daySection.remove();

            // Renumber the remaining days
            updateFieldNames();
        }

        function addExercise(button, dayIndex) {
            const exercisesContainer = button.closest('.exercises-container');
            const exerciseItems = exercisesContainer.querySelectorAll('.exercise-item');
            const exerciseIndex = exerciseItems.length;

            const exerciseTemplate = `
                <div class="exercise-item mb-3 p-3  rounded-md">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Exercise</label>
                            <select name="days[${dayIndex}][exercises][${exerciseIndex}][exercise_id]" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                <option value="">Select Exercise</option>
                                @foreach (\App\Models\Exercise::all() as $exercise)
                                    <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                <input type="number" name="days[${dayIndex}][exercises][${exerciseIndex}][sets]" min="1" value="3" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                <input type="text" name="days[${dayIndex}][exercises][${exerciseIndex}][reps]" value="10" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-2">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">RPE</label>
                            <input type="number" name="days[${dayIndex}][exercises][${exerciseIndex}][rpe]" min="1" value="7" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Rest (seconds)</label>
                            <input type="number" name="days[${dayIndex}][exercises][${exerciseIndex}][rest]" min="0" step="5" value="60" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Notes</label>
                            <input type="text" name="days[${dayIndex}][exercises][${exerciseIndex}][notes]" class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="text-red-500 hover:text-red-700 text-xs" onclick="removeExercise(this)">
                            Remove Exercise
                        </button>
                    </div>
                </div>
            `;

            exercisesContainer.insertBefore(
                new DOMParser().parseFromString(exerciseTemplate, 'text/html').body.firstChild,
                button
            );
        }

        function removeExercise(button) {
            console.log('removeExercise called', button);
            if (!button) {
                console.error('Button is null');
                return;
            }

            const exerciseItem = button.closest('.exercise-item');
            console.log('exerciseItem found:', exerciseItem);
            if (!exerciseItem) {
                console.error('Exercise item not found');
                return;
            }

            const exerciseIdInput = exerciseItem.querySelector('input[name*="[id]"]');
            console.log('exerciseIdInput:', exerciseIdInput);

            // Handle both new and existing exercises
            const deletedItemsContainer = document.getElementById('deleted-items');
            console.log('deletedItemsContainer:', deletedItemsContainer);

            // If this is an existing exercise (has an ID with value), add it to deleted exercises
            if (exerciseIdInput && exerciseIdInput.value) {
                const exerciseId = exerciseIdInput.value;
                console.log('Adding exercise ID to deletedExercises:', exerciseId);
                deletedExercises.push(exerciseId);
                console.log('deletedExercises array:', deletedExercises);

                // Add a new hidden input for the deleted exercise
                if (deletedItemsContainer) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'deleted_exercises[]';
                    input.value = exerciseId;
                    deletedItemsContainer.appendChild(input);
                    console.log('Added hidden input for deleted exercise:', input);
                } else {
                    console.error('deletedItemsContainer not found, creating it');
                    // Create the container if it doesn't exist
                    const form = document.querySelector('form');
                    if (form) {
                        const newContainer = document.createElement('div');
                        newContainer.id = 'deleted-items';
                        newContainer.style.display = 'none';
                        form.appendChild(newContainer);

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'deleted_exercises[]';
                        input.value = exerciseId;
                        newContainer.appendChild(input);
                        console.log('Created container and added hidden input:', input);
                    } else {
                        console.error('Form not found');
                    }
                }
            } else {
                console.log('Exercise is new (no ID), just removing from DOM');
            }

            exerciseItem.remove();
            console.log('Exercise item removed from DOM');

            // Update exercise indices within this day
            try {
                const daySection = button.closest('.day-section');
                console.log('daySection:', daySection);
                if (!daySection) {
                    console.error('Day section not found');
                    return;
                }

                const exerciseItems = daySection.querySelectorAll('.exercise-item');
                console.log('Number of remaining exercises:', exerciseItems ? exerciseItems.length : 0);

                // If there are no exercise items left, no need to update indices
                if (!exerciseItems || exerciseItems.length === 0) {
                    console.log('No exercise items to update');
                    return;
                }

                const dayNumberInput = daySection.querySelector('input[name*="[day_number]"]');
                console.log('dayNumberInput:', dayNumberInput);

                if (!dayNumberInput) {
                    console.error('Day number input not found');
                    return;
                }

                const dayIndexMatch = dayNumberInput.name.match(/days\[(\d+)\]/);
                console.log('dayIndexMatch:', dayIndexMatch);

                if (dayIndexMatch) {
                    const dayIndex = dayIndexMatch[1];
                    console.log('Updating indices for day:', dayIndex);
                    exerciseItems.forEach((item, index) => {
                        if (!item) {
                            console.error('Exercise item is null at index:', index);
                            return;
                        }
                        console.log('Updating exercise at index:', index);
                        const inputs = item.querySelectorAll('input, select');
                        if (!inputs) {
                            console.error('No inputs found in exercise item');
                            return;
                        }
                        inputs.forEach(input => {
                            if (!input) return;
                            const name = input.getAttribute('name');
                            if (name) {
                                const newName = name.replace(/days\[\d+\]\[exercises\]\[\d+\]/,
                                    `days[${dayIndex}][exercises][${index}]`);
                                input.setAttribute('name', newName);
                                console.log('Updated input name:', name, '->', newName);
                            }
                        });
                    });
                }
            } catch (error) {
                console.error('Error updating exercise indices:', error);
            }
        }

        function updateFieldNames() {
            const daySections = document.querySelectorAll('.day-section');
            daySections.forEach((section, dayIndex) => {
                // Update day index in all field names
                const inputs = section.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name && name.includes('days[')) {
                        const newName = name.replace(/days\[\d+\]/, `days[${dayIndex}]`);
                        input.setAttribute('name', newName);
                    }
                });

                // Update exercise indices within this day
                const exerciseItems = section.querySelectorAll('.exercise-item');
                exerciseItems.forEach((item, exerciseIndex) => {
                    const exerciseInputs = item.querySelectorAll('input, select');
                    exerciseInputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name && name.includes('[exercises]')) {
                            const newName = name.replace(/days\[\d+\]\[exercises\]\[\d+\]/,
                                `days[${dayIndex}][exercises][${exerciseIndex}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });

                // Update add exercise button onclick attribute
                const addExerciseBtn = section.querySelector('.add-exercise-btn');
                if (addExerciseBtn) {
                    addExerciseBtn.setAttribute('onclick', `addExercise(this, ${dayIndex})`);
                }
            });
        }

        function removeExercise(button) {
            const exerciseItem = button.closest('.exercise-item');
            const exerciseIdInput = exerciseItem.querySelector('input[name*="[id]"]');

            // If this is an existing exercise (has an ID), add it to deleted exercises
            console.log(exerciseIdInput);
            if (exerciseIdInput && exerciseIdInput.value) {
                const exerciseId = exerciseIdInput.value;
                console.log(exerciseIdInput);
                console.log(exerciseId);

                // Add a new hidden input for the deleted exercise
                const deletedItemsContainer = document.getElementById('deleted-items');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'deleted_exercises[]';
                input.value = exerciseId;
                deletedItemsContainer.appendChild(input);
            }

            exerciseItem.remove();

            // Update exercise indices within this day
            const daySection = button.closest('.day-section');
            if (!daySection) return;
            console.log('1');

            const exerciseItems = daySection.querySelectorAll('.exercise-item');
            if (!exerciseItems || exerciseItems.length === 0) return;
            console.log('2');

            const dayNumberInput = daySection.querySelector('input[name*="[day_number]"]');
            if (!dayNumberInput) return;
            console.log('3');

            const dayIndexMatch = dayNumberInput.name.match(/days\[(\d+)\]/);
            if (dayIndexMatch) {
                const dayIndex = dayIndexMatch[1];
                exerciseItems.forEach((item, index) => {
                    const inputs = item.querySelectorAll('input, select');
                    inputs.forEach(input => {
                        const name = input.getAttribute('name');
                        if (name) {
                            const newName = name.replace(/days\[\d+\]\[exercises\]\[\d+\]/,
                                `days[${dayIndex}][exercises][${index}]`);
                            input.setAttribute('name', newName);
                        }
                    });
                });
            }
            console.log('4');
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Make sure the deleted-items container exists
            if (!document.getElementById('deleted-items')) {
                const deletedItemsDiv = document.createElement('div');
                deletedItemsDiv.id = 'deleted-items';
                document.querySelector('form').appendChild(deletedItemsDiv);
            }
        });
    </script>
@endsection
