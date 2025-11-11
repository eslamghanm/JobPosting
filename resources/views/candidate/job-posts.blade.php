<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Available Jobs</h1>

        @if($jobs->count() > 0)
        <ul class="space-y-4">
            @foreach($jobs as $job)
            <li class="border p-4 rounded shadow hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <strong class="text-lg">{{ $job->title }}</strong>
                        <p class="text-gray-500">{{ $job->location ?? '-' }}</p>
                    </div>
                    <a href="{{ route('candidate.jobs.apply', $job) }}" class="bg-blue-600 text-white px-3 py-1 rounded">Apply</a>
                </div>
            </li>
            @endforeach
        </ul>

        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
        @else
        <p class="text-gray-500">No jobs available at the moment.</p>
        @endif
    </div>
</x-app-layout>
