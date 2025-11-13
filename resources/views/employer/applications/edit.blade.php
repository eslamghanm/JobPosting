@extends('employer.layouts.app')

@section('content')
<div class="py-6">

    <div class="bg-white dark:bg-slate-800 p-6 rounded-lg shadow-sm">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Edit Application</h2>

        <form action="{{ route('Applications.update', $application) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Status --}}
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select id="status" name="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm px-4 py-2
                               dark:bg-gray-700 dark:text-gray-100 dark:border-gray-600">
                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('status')" />
            </div>

            {{-- Submit Button --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('Applications.show', $application) }}"
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</a>
                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Update</button>
            </div>
        </form>

    </div>

</div>
@endsection
