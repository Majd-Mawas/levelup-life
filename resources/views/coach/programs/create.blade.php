@extends('layouts.vertical', ['title' => 'Create Training Program', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Create Training Program</h1>
            <a href="{{ route('programs.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Back to List
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Program
                        title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
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
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
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
                            <option value="{{ $trainee->id }}" {{ old('trainee_id') == $trainee->id ? 'selected' : '' }}>
                                {{ $trainee->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('trainee_id')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Training Days Section -->
                <div class="mb-6 border-t pt-4 mt-4">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Training Days</h2>

                    <div id="days-container">
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
                                                    <option value="{{ $exercise->id }}">{{ $exercise->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="grid grid-cols-2 gap-2">
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Sets</label>
                                                <input type="number" name="days[0][exercises][0][sets]" min="1"
                                                    value="3"
                                                    class="w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Reps</label>
                                                <input type="text" name="days[0][exercises][0][reps]" value="10"
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
                    </div>

                    <button type="button" id="add-day-btn"
                        class="mt-2 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 px-4 py-2 rounded-md hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                        + Add Training Day
                    </button>
                </div>

                <script>
                    let dayCount = 1;

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

                                    <div class="exercise-item mb-3 p-3 rounded-md">
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
                        daySection.remove();

                        // Renumber the remaining days
                        const daySections = document.querySelectorAll('.day-section');
                        daySections.forEach((section, index) => {
                            // Update the day index in all field names
                            const inputs = section.querySelectorAll('input, select, textarea');
                            inputs.forEach(input => {
                                const name = input.getAttribute('name');
                                if (name && name.includes('days[')) {
                                    const newName = name.replace(/days\[\d+\]/, `days[${index}]`);
                                    input.setAttribute('name', newName);
                                }
                            });

                            // Update the day index in the add exercise button
                            const addExerciseBtn = section.querySelector('.add-exercise-btn');
                            addExerciseBtn.setAttribute('onclick', `addExercise(this, ${index})`);
                        });
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

                        button.insertAdjacentHTML('beforebegin', exerciseTemplate);
                    }

                    function removeExercise(button) {
                        const exerciseItem = button.closest('.exercise-item');
                        const exercisesContainer = exerciseItem.closest('.exercises-container');
                        exerciseItem.remove();

                        // Renumber the remaining exercises
                        const exerciseItems = exercisesContainer.querySelectorAll('.exercise-item');
                        const dayIndexMatch = exercisesContainer.querySelector('select[name*="[exercises]"]')?.name.match(
                            /days\[(\d+)\]/);
                        if (dayIndexMatch) {
                            const dayIndex = parseInt(dayIndexMatch[1]);

                            exerciseItems.forEach((item, index) => {
                                const inputs = item.querySelectorAll('input, select');
                                inputs.forEach(input => {
                                    const name = input.getAttribute('name');
                                    if (name && name.includes('[exercises]')) {
                                        const newName = name.replace(/days\[\d+\]\[exercises\]\[\d+\]/,
                                            `days[${dayIndex}][exercises][${index}]`);
                                        input.setAttribute('name', newName);
                                    }
                                });
                            });
                        }
                    }
                </script>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Create Program
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
