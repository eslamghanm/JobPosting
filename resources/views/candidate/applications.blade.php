<!-- resources/views/candidate/applications.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">My Applications</h1>

        @if($applications->isEmpty())
        <p class="text-gray-500">You have not applied to any jobs yet.</p>
        @else
        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Job Title</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Company</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Status</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Applied At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $application)
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{ $application->job->title ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $application->job->company ?? 'N/A' }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($application->status) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $application->created_at->format('d M, Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</x-app-layout>
