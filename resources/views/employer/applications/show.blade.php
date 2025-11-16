@extends('employer.layouts.app')

@section('content')
<div class="py-6 space-y-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-sm">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">{{ $application->job->title }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300">Applicant</h3>
                <p class="mt-1 text-gray-900 dark:text-white">{{ $application->user->name ?? 'N/A' }}</p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300">Status</h3>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                     @if($application->status == 'accepted') bg-green-100 text-green-800
                     @elseif($application->status == 'rejected') bg-red-100 text-red-800
                     @else bg-gray-100 text-gray-800
                     @endif">
                    {{ ucfirst($application->status) }}
                </span>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300">Resume</h3>
                <a href="{{ asset('storage/' .$application->resume) }}" target="_blank" class="text-indigo-600 hover:underline">View Resume</a>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-300">Applied On</h3>
                <p class="mt-1 text-gray-900 dark:text-white">{{ $application->created_at->format('d M Y') }}</p>
            </div>
        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('Applications.index') }}"
               class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Back</a>
            <a href="{{ route('Applications.edit', $application) }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
        </div>
    </div>

</div>
@endsection
