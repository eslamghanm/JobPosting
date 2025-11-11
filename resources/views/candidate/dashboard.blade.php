<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Welcome, {{ $user->name }}</h1>

        <div class="bg-white shadow rounded p-4 mb-6">
            <h2 class="text-xl font-semibold mb-3">Your Applications</h2>

            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
            @endif

            @if($applications->count() > 0)
            <ul class="space-y-2">
                @foreach($applications as $application)
                <li class="border p-3 rounded flex justify-between items-center">
                    <div>
                        <strong>{{ $application->job->title }}</strong>
                        <p class="text-gray-500 text-sm">{{ $application->job->location ?? '' }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Status: {{ $application->status }}</span>
                        <a href="{{ route('candidate.applications.edit', $application) }}" class="text-blue-600 text-sm">Edit</a>
                        <form action="{{ route('candidate.applications.delete', $application) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 text-sm">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-500">You have not applied to any jobs yet.</p>
            @endif
        </div>

        <a href="{{ route('candidate.jobs') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Browse Jobs</a>
    </div>
</x-app-layout>
