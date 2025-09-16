@extends('layouts.vertical', ['title' => 'View Training Day', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Day {{ $day->day_number }} - {{ $day->program->name }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('programs.show', $day->program) }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                Back to Program
            </a>
            <a href="{{ route('days.edit', $day) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                Edit
            </a>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Training Day Details</h2>
        
        <div class="mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Program</h3>
            <p class="mt-1 text-gray-800 dark:text-white">
                <a href="{{ route('programs.show', $day->program) }}" class="text-blue-600 hover:underline dark:text-blue-400">
                    {{ $day->program->name }}
                </a>
            </p>
        </div>
        
        <div class="mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Day Number</h3>
            <p class="mt-1 text-gray-800 dark:text-white">Day {{ $day->day_number }}</p>
        </div>
        
        <div class="mb-4">
            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
            <p class="mt-1 text-gray-800 dark:text-white whitespace-pre-line">{{ $day->description }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Training Content</h2>
            <a href="{{ route('day_exercises.create', ['day_id' => $day->id]) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors">
                Add Exercise
            </a>
        </div>
        
        @if($day->exercises && $day->exercises->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Exercise</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sets</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Reps</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Notes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($day->exercises as $exercise)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($exercise->exercise->image)
                                <img src="{{ asset('storage/' . $exercise->exercise->image) }}" alt="{{ $exercise->exercise->name }}" class="h-10 w-10 rounded-md object-cover mr-3">
                                @endif
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $exercise->exercise->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-300">{{ $exercise->sets }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500 dark:text-gray-300">{{ $exercise->reps }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500 dark:text-gray-300">{{ $exercise->notes }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('day_exercises.edit', $exercise) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('day_exercises.destroy', $exercise) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this exercise?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No exercises yet. Please click "Add Exercise" button</p>
        @endif
    </div>
</div>
@endsection