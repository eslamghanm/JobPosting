<x-app-layout>
    <main class=" overflow-hidden bg-gray-50 min-h-[80vh] dark:bg-slate-900">

        <div class="w-full mx-auto py-5 sm:px-6 lg:px-8">
            @php
                $collection = $jobPosts ?? ($posts ?? collect());
                $statusCounts = $collection->groupBy('status')->map->count();
                $publishedCount = ($statusCounts['accepted'] ?? 0) + ($statusCounts['published'] ?? 0);
                $draftCount = $statusCounts['draft'] ?? 0;
                $closedCount = $statusCounts['closed'] ?? 0;
                $draftCount = $statusCounts['draft'] ?? 0;
                $rejectedCount = $statusCounts['rejected'] ?? 0;
            @endphp

            <!-- Filter/Header Section -->
<div class="relative overflow-hidden rounded-xl mt-2 mb-4
             bg-cover bg-center bg-no-repeat"
     style="background-image: url('{{ asset('assets/search.jpeg') }}');">

    <!-- Overlay for better contrast -->
    <div class="absolute inset-0 bg-black/30 dark:bg-black/50"></div>

    <!-- Content -->
    <div class="relative mx-auto px-8 py-5 md:px-12 text-center">

        <!-- Filter Form -->
        <form action="{{ route('jobs.index') }}"
              class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center gap-6">

            <!-- Keywords -->
            <input type="text" name="keywords" value="{{ request('keywords') }}"
                   placeholder="Job title or description"
                   class="w-full rounded-full border border-gray-300 bg-white/30 px-4 py-2 text-gray-900 placeholder-gray-600
                          dark:bg-black/40 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none" />

            <!-- Location -->
            <input type="text" name="location" value="{{ request('location') }}"
                   placeholder="City, state..."
                   class="w-full rounded-full border border-gray-300 bg-white/30 px-4 py-2 text-gray-900 placeholder-gray-600
                          dark:bg-black/40 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none" />

            <!-- Category -->
            <select name="category"
                    class="w-full rounded-full border border-gray-300 bg-white/30 px-4 py-2 text-gray-900 placeholder-gray-600
                           dark:bg-black/40 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none">
                <option value="">-- All Categories --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
             <div class="md:col-span-3 flex items-center justify-center gap-4">
            <!-- Salary -->
            <input type="number" name="salary" value="{{ request('salary') }}" min="0"
                   placeholder="Expected salary"
                   class="w-[33.3%] rounded-full border border-gray-300 bg-white/30 px-4 py-2 text-gray-900 placeholder-gray-600
                          dark:bg-black/40 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none" />

            <!-- Date Posted -->
            <select name="date_posted"
                    class="w-[33.3%] rounded-full border border-gray-300 bg-white/30 px-4 py-2 text-gray-900 placeholder-gray-600
                           dark:bg-black/40 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400 focus:outline-none">
                <option value="">-- Any --</option>
                <option value="today" {{ request('date_posted') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="week" {{ request('date_posted') == 'week' ? 'selected' : '' }}>This Week</option>
                <option value="month" {{ request('date_posted') == 'month' ? 'selected' : '' }}>This Month</option>
            </select>
             </div>
            <!-- Buttons -->
            <div class="md:col-span-3 flex items-center justify-center gap-4 mt-4">
                <a href="{{ route('jobs.index') }}"
                   class="px-6 py-2 bg-white/30 dark:bg-white/10 text-white rounded-full hover:bg-white/40 dark:hover:bg-white/20 transition font-medium">
                    Reset
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition font-medium">
                    Filter
                </button>
            </div>

        </form>

    </div>
</div>



            <!-- Job Posts List -->
            <section class="">
                @if ($collection->isEmpty())
                    <div class="bg-gray-50 with dark:bg-slate-900 shadow-sm rounded-lg ">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">
                                {{ __('No job posts') }}</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">
                                {{ __('Get started by creating a new job post.') }}</p>
                        </div>
                    </div>
                @else
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($collection as $post)
                            <article
                                class="bg-gray-50 dark:bg-slate-900 shadow-sm rounded-lg overflow-hidden hover:shadow-md transition-shadow border border-gray-200 dark:border-slate-700">
                                <div class="p-6">
                                    <!-- Header: Title + Status -->
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1 flex items-center gap-4">
                                            <div
                                                class="w-16 h-16 flex-shrink-0 rounded-md overflow-hidden bg-gray-100 dark:bg-slate-700 border border-gray-200 dark:border-slate-600">
                                                @if (!empty($post->branding_image))
                                                    <img src="{{ asset('storage/' . $post->branding_image) }}"
                                                        alt="{{ $post->title }}" class="w-full h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M16 3v4M8 3v4m-5 4h18" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="min-w-0">
                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white truncate">
                                                    {{ $post->title ?? \Illuminate\Support\Str::limit($post->description ?? '', 60) }}
                                                </h3>
                                                @if (!empty($post->category))
                                                    <div class="mt-1">
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-900 dark:text-indigo-200">{{ $post->category->name }}</span>
                                                    </div>
                                                @endif
                                                <div
                                                    class="mt-1 flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                        {{ $post->location ?? '-' }}
                                                    </span>
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ ucfirst($post->work_type ?? 'n/a') }}
                                                    </span>
                                                    <span class="inline-flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ optional($post->created_at)->diffForHumans() ?? '-' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @php $s = $post->status ?? 'draft'; @endphp
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $s === 'published'
                                                ? 'bg-green-100 dark:bg-green-900 text-green-900 dark:text-green-100'
                                                : ($s === 'draft'
                                                    ? 'bg-yellow-100 dark:bg-yellow-900 text-yellow-900 dark:text-yellow-100'
                                                    : ($s === 'closed'
                                                        ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200'
                                                        : 'bg-yellow-500 dark:bg-yellow-600 text-yellow-900 dark:text-yellow-100')) }}">
                                            <span
                                                class="w-2 h-2 mr-2 rounded-full {{ $s === 'published'
                                                    ? 'bg-green-500 dark:bg-green-400'
                                                    : ($s === 'draft'
                                                        ? 'bg-yellow-500 dark:bg-yellow-400'
                                                        : ($s === 'closed'
                                                            ? 'bg-gray-500 dark:bg-gray-400'
                                                            : 'bg-yellow-500 dark:bg-yellow-400')) }}"></span>
                                            {{ ucfirst($s) }}
                                        </span>
                                    </div>

                                    <!-- Body: Description + Meta -->
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-600 dark:text-gray-300">Description :
                                            {{ \Illuminate\Support\Str::limit($post->description ?? '', 200) }}</p>
                                        @if (!empty($post->responsibilities))
                                            @php
                                                $firstResp = trim(
                                                    explode("\n", strip_tags($post->responsibilities))[0] ?? '',
                                                );
                                            @endphp
                                            @if ($firstResp)
                                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    <strong>{{ __('Responsibility:') }}</strong>
                                                    {{ \Illuminate\Support\Str::limit($firstResp, 100) }}
                                                </p>
                                            @endif
                                        @endif
                                        @if ($post->technologies)
                                            <div class="mt-4 flex flex-wrap gap-2">
                                                @foreach ((array) $post->technologies as $technology)
                                                    <span
                                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-900 dark:text-blue-100">
                                                        {{ $technology }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                        <!-- Benefits -->
                                        @if (!empty($post->benefits))
                                            @php
                                                if (is_array($post->benefits)) {
                                                    $parts = array_values($post->benefits);
                                                } else {
                                                    $raw = $post->benefits;
                                                    $parts = preg_split('/\r\n|\r|\n|,/', $raw);
                                                    $parts = array_filter(array_map('trim', $parts));
                                                    $parts = array_values($parts);
                                                }
                                                $shown = array_slice($parts, 0, 3);
                                                $hasMore = count($parts) > count($shown);
                                            @endphp
                                            @if (count($shown))
                                                <div class="mt-4">
                                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                        {{ __('Benefits') }}</h4>
                                                    <div class="mt-2 flex flex-wrap gap-2">
                                                        @foreach ($shown as $b)
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-100 dark:bg-slate-700 text-gray-900 dark:text-gray-200">
                                                                <svg class="w-4 h-4 mr-2 text-green-500 dark:text-green-400"
                                                                    fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M5 13l4 4L19 7" />
                                                                </svg>
                                                                {{ $b }}
                                                            </span>
                                                        @endforeach
                                                        @if ($hasMore)
                                                            <span
                                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-50 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-100">+
                                                                {{ count($parts) - count($shown) }} more</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </div>

                                    <!-- Footer: Meta + Actions -->
                                    <div
                                        class="mt-6 flex items-center justify-between border-t border-gray-200 dark:border-slate-700 pt-4">
                                        <div
                                            class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                            @if ($post->salary_min || $post->salary_max)
                                                <span class="inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $post->salary_min ? '$' . number_format($post->salary_min) : 'N/A' }}
                                                    -
                                                    {{ $post->salary_max ? '$' . number_format($post->salary_max) : 'N/A' }}
                                                </span>
                                            @endif
                                            @if ($post->application_deadline)
                                                <span class="inline-flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ \Carbon\Carbon::parse($post->application_deadline)->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('jobs.show', $post) }}"
                                                class="inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-slate-600 shadow-sm text-sm font-medium rounded text-gray-700 dark:text-gray-200 bg-gray-50 dark:bg-slate-700 hover:bg-gray-50 dark:hover:bg-slate-600">
                                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                {{ __('View') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    @if (method_exists($collection, 'links'))
                        <div class="mt-6">
                            {{ $collection->links() }}
                        </div>
                    @endif
                @endif
            </section>


        </div>
    </main>
</x-app-layout>
