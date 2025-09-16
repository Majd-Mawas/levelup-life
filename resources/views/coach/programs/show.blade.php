@extends('layouts.vertical', ['title' => 'View Training Program', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $program->title }}</h1>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('programs.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                    Back to List
                </a>
                <a href="{{ route('programs.edit', $program) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    Edit Program
                </a>
                <a href="{{ route('programs.pdf', $program) }}?lang=ar"
                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors m-0"
                    target="_blank">
                    Export PDF
                </a>
            </div>
        </div>

        <div class=" gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Program Details</h2>
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Description</h3>
                        <p class="mt-1 text-gray-800 dark:text-white whitespace-pre-line">{{ $program->description }}</p>
                    </div>
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Trainee</h3>
                        <p class="mt-1 text-gray-800 dark:text-white">
                            @if ($program->trainee)
                                <a href="{{ route('trainees.show', $program->trainee) }}"
                                    class="text-blue-600 hover:underline dark:text-blue-400">
                                    {{ $program->trainee->name }}
                                </a>
                            @else
                                <span>No trainee assigned</span>
                            @endif
                        </p>
                    </div>
                    {{-- <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Start Date</h3>
                        <p class="mt-1 text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($program->start_date)->format('Y-m-d') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">End Date</h3>
                        <p class="mt-1 text-gray-800 dark:text-white">{{ \Carbon\Carbon::parse($program->end_date)->format('Y-m-d') }}</p>
                    </div>
                </div> --}}
                    <div class="mb-4">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h3>
                        <p class="mt-1 text-gray-800 dark:text-white">{{ $program->created_at->format('Y-m-d H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Updated</h3>
                        <p class="mt-1 text-gray-800 dark:text-white">{{ $program->updated_at->format('Y-m-d H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Training Days</h2>
                        {{-- <a href="{{ route('days.create', ['program_id' => $program->id]) }}" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700 transition-colors">
                        Add Training Day
                    </a> --}}
                    </div>

                    @if ($program->days && $program->days->count() > 0)
                        <div class="space-y-3">
                            @foreach ($program->days as $day)
                                <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-md mb-4">
                                    <div class="flex justify-between items-center mb-2">
                                        <div>
                                            <h3 class="font-medium text-gray-800 dark:text-white">Day {{ $day->day_number }}
                                            </h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ Str::limit($day->description, 30) }}</p>
                                        </div>
                                    </div>

                                    <!-- Exercises for this day -->
                                    @if ($day->exercises->count() > 0)
                                        <div class="mt-2 p-2 border-l-2 border-danger">
                                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 px-3">
                                                Exercises:
                                            </h4>
                                            <div class="space-y-2 px-3">
                                                @foreach ($day->exercises as $exercise)
                                                    <div class="p-2 rounded shadow-sm">
                                                        <div class="flex justify-between">
                                                            <span
                                                                class="font-medium text-gray-800 dark:text-white">{{ $exercise->name }}</span>
                                                            <span
                                                                class="text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 px-2 py-0.5 rounded">{{ $exercise->category }}</span>
                                                        </div>
                                                        <div
                                                            class="grid grid-cols-4 gap-1 mt-1 text-xs text-gray-600 dark:text-gray-300">
                                                            <div><span class="font-medium">Sets:</span>
                                                                {{ $exercise->pivot->sets }}</div>
                                                            <div><span class="font-medium">Reps:</span>
                                                                {{ $exercise->pivot->reps }}</div>
                                                            <div><span class="font-medium">RPE:</span>
                                                                {{ $exercise->pivot->rpe }}</div>
                                                            <div><span class="font-medium">Rest:</span>
                                                                {{ $exercise->pivot->rest }}s</div>
                                                        </div>
                                                        @if ($exercise->pivot->notes)
                                                            <div
                                                                class="mt-1 text-xs italic text-gray-500 dark:text-gray-400">
                                                                {{ $exercise->pivot->notes }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No exercises added to this
                                            day</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No training days yet. Please click "Add
                            Training Day" button</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
