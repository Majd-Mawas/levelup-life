@extends('layouts.vertical', ['title' => 'Trainee Details', 'sub_title' => 'Coach', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Trainee Details</h1>
            <a href="{{ route('trainees.index') }}"
                class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition-colors">
                <i class="uil uil-arrow-left"></i> Back to Trainees
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $trainee->name }}</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('trainees.edit', $trainee->id) }}"
                        class="px-3 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <i class="uil uil-edit"></i> Edit
                    </a>
                    <form action="{{ route('trainees.destroy', $trainee->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors"
                            onclick="return confirm('Are you sure you want to delete this trainee?')">
                            <i class="uil uil-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Phone</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->phone ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Birthdate</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->birthdate ?? 'N/A' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Height</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->height ? $trainee->height . ' cm' : 'N/A' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Weight</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->weight ? $trainee->weight . ' kg' : 'N/A' }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Gender</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->gender ? ucfirst($trainee->gender) : 'N/A' }}
                    </p>
                </div>

                <div class="md:col-span-2">
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Notes</h3>
                    <p class="text-gray-800 dark:text-gray-200">{{ $trainee->notes ?? 'No notes available' }}</p>
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase mb-3">Assigned Programs</h3>
                @if ($trainee->programs && $trainee->programs->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Program Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Days</th>
                                    {{-- <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th> --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($trainee->programs as $program)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $program->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $program->days->count() ?? 'Not set' }}</td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span
                                                class="px-2 py-1 text-xs rounded-full {{ $program->pivot->status == 'active' ? 'bg-green-100 text-green-800' : ($program->pivot->status == 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($program->pivot->status ?? 'pending') }}
                                            </span>
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <a href="{{ route('programs.show', $program->id) }}"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                <i class="uil uil-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-600 dark:text-gray-400">No programs assigned yet.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
