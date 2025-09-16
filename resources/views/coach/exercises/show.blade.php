@extends('layouts.vertical', ['title' => 'View Exercise', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="container-fluid">
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Exercise Details</h4>
        <a href="{{ route('exercises.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back to Exercises
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/3">
                    @if($exercise->hasMedia('exercise_image'))
                        <img src="{{ $exercise->getFirstMediaUrl('exercise_image') }}" alt="{{ $exercise->name }}" class="w-full h-auto rounded-lg object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center p-8 bg-gray-100 dark:bg-gray-700 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 dark:text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                            <p class="mt-2 text-gray-500 dark:text-gray-400">No image available</p>
                        </div>
                    @endif
                </div>
                <div class="md:w-2/3">
                    <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ $exercise->name }}</h3>
                    <div class="my-4 border-t border-gray-200 dark:border-gray-700"></div>
                    <h5 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-2">Description</h5>
                    <p class="text-gray-600 dark:text-gray-400">{{ $exercise->description ?? 'No description available' }}</p>
                    
                    <div class="mt-6 flex space-x-3">
                        <a href="{{ route('exercises.edit', $exercise) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('exercises.destroy', $exercise) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this exercise?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                Delete
                            </button>
                        </form>
                    </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection