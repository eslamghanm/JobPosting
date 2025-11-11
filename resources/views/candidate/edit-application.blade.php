<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Application for: {{ $application->job->title }}</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('candidate.applications.update', $application) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Resume (PDF)</label>
                <input type="file" name="resume" class="border p-2 w-full rounded">
                @if($application->resume)
                <p class="text-sm text-gray-500 mt-1">Current: <a href="{{ asset('storage/' . $application->resume) }}" target="_blank">Download</a></p>
                @endif
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Status</label>
                <select name="status" class="border p-2 w-full rounded">
                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Application</button>
        </form>
    </div>
</x-app-layout>
