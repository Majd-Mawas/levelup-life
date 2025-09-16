@extends('layouts.vertical', ['title' => 'Create Training Day', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Create Training Day</h1>
        <a href="{{ isset($program_id) ? route('programs.show', $program_id) : route('days.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
            Back
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <form action="{{ route('days.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label for="program_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Program</label>
                <select name="program_id" id="program_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="{{ $program->id }}" selected>{{ $program->title }}</option>
                </select>
                @error('program_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="day_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Day Number</label>
                <input type="number" name="day_number" id="day_number" value="{{ old('day_number') }}" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                @error('day_number')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Create Training Day
                </button>
            </div>
        </form>
    </div>
</div>
@endsection