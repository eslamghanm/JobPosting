<!-- resources/views/candidate/edit-profile.blade.php -->

<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('candidate.updateProfile') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="phone">Phone</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $candidate->phone) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $candidate->address) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="resume">Resume (PDF)</label>
                <input type="file" name="resume" id="resume" class="w-full">
                @if($candidate->resume)
                <p class="mt-2 text-sm text-gray-500">Current file: <a href="{{ asset('storage/' . $candidate->resume) }}" target="_blank" class="text-blue-500 underline">View Resume</a></p>
                @endif
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Profile</button>
        </form>
    </div>
</x-app-layout>
