@extends('layouts.vertical', ['title' => 'Dashboard', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="container-fluid">
        <!-- Stats cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Trainees card -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h5 class="text-gray-500 dark:text-gray-400 font-normal truncate" title="Trainees">Trainees</h5>
                            <h3 class="text-2xl font-semibold my-2 py-1">{{ \App\Models\Trainee::count() }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-0">
                                <span class="text-green-500 mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Active
                                </span>
                            </p>
                        </div>
                        <div class="bg-blue-50 dark:bg-slate-700 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Programs card -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h5 class="text-gray-500 dark:text-gray-400 font-normal truncate" title="Programs">Programs</h5>
                            <h3 class="text-2xl font-semibold my-2 py-1">{{ \App\Models\Program::count() }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-0">
                                <span class="text-green-500 mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Active
                                </span>
                            </p>
                        </div>
                        <div class="bg-purple-50 dark:bg-slate-700 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exercises card -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h5 class="text-gray-500 dark:text-gray-400 font-normal truncate" title="Exercises">Exercises
                            </h5>
                            <h3 class="text-2xl font-semibold my-2 py-1">{{ \App\Models\Exercise::count() }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-0">
                                <span class="text-green-500 mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Available
                                </span>
                            </p>
                        </div>
                        <div class="bg-red-50 dark:bg-slate-700 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Training Days card -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm">
                <div class="p-5">
                    <div class="flex justify-between items-center">
                        <div>
                            <h5 class="text-gray-500 dark:text-gray-400 font-normal truncate" title="Training Days">Training
                                Days</h5>
                            <h3 class="text-2xl font-semibold my-2 py-1">{{ \App\Models\Day::count() }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-0">
                                <span class="text-green-500 mr-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    Scheduled
                                </span>
                            </p>
                        </div>
                        <div class="bg-green-50 dark:bg-slate-700 p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Recent Trainees</h4>
                        <a href="{{ route('trainees.index') }}"
                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded-md transition-colors">View
                            All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Phone number</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Programs</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach (\App\Models\Trainee::latest()->take(5)->get() as $trainee)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $trainee->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $trainee->phone }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $trainee->programs->count() }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">
                                            <a href="{{ route('trainees.show', $trainee) }}"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-5">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Recent Programs</h4>
                        <a href="{{ route('programs.index') }}"
                            class="px-3 py-1 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 text-sm rounded-md transition-colors">View
                            All</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Name</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Trainee</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Days</th>
                                    <th
                                        class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach (\App\Models\Program::with('trainee', 'days')->latest()->take(5)->get() as $program)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $program->title }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $program->trainee->name }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            {{ $program->days->count() }}</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm flex space-x-2">
                                            <a href="{{ route('programs.show', $program) }}"
                                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('programs.pdf', $program) }}?lang=ar"
                                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                <div class="p-5">
                    <div class="mb-4">
                        <h4 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Quick Actions</h4>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('trainees.create') }}"
                            class="flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            Add New Trainee
                        </a>
                        <a href="{{ route('programs.create') }}"
                            class="flex items-center justify-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Create New Program
                        </a>
                        <a href="{{ route('exercises.create') }}"
                            class="flex items-center justify-center px-4 py-3 bg-indigo-600 hover:bg-cyan-700 text-white rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Add New Exercise
                        </a>
                        <a href="{{ route('exercises.index') }}"
                            class="flex items-center justify-center px-4 py-3 bg-purple-600 hover:bg-amber-700 text-white rounded-md transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            View All Exercises
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
