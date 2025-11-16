@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">All Jobs</h1>

    <div class="space-y-4">
        @foreach($jobs as $job)
            <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow">
                <h2 class="text-xl font-semibold">{{ $job->title }}</h2>
                <p>{{ Str::limit($job->description, 150) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
