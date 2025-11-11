<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('candidate.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Phone</label>
                <input type="text" name="phone" value="{{ $user->phone }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Address</label>
                <input type="text" name="address" value="{{ $user->address }}" class="border p-2 w-full rounded">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Resume (PDF)</label>
                <input type="file" name="resume" class="border p-2 w-full rounded">
                @if($user->resume)
                <p class="text-sm text-gray-500 mt-1">Current: <a href="{{ asset('storage/' . $user->resume) }}" target="_blank">Download</a></p>
                @endif
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
        </form>
    </div>
</x-app-layout>
