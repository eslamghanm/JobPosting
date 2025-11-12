<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ darkMode: localStorage.getItem('theme') === 'dark' }" 
      x-init="$watch('darkMode', val => localStorage.setItem('theme', val ? 'dark' : 'light'))" 
      x-bind:class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300">
    
    <!-- Dark Mode Toggle -->
    <div class="fixed top-6 right-6 z-50">
        <button 
            @click="darkMode = !darkMode" 
            class="flex items-center justify-center w-12 h-12 rounded-full border border-gray-300 dark:border-gray-700 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm hover:bg-white dark:hover:bg-gray-700 transition-all shadow-lg"
            title="Toggle Dark Mode"
        >
            <template x-if="!darkMode">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 5.22a1 1 0 011.42 0L6.64 6.22a1 1 0 11-1.42 1.42L4.22 6.64a1 1 0 010-1.42zM3 10a1 1 0 011-1H5a1 1 0 110 2H4a1 1 0 01-1-1zm7 7a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm6.36-1.36a1 1 0 010 1.42l-1 1a1 1 0 11-1.42-1.42l1-1a1 1 0 011.42 0zM17 9h1a1 1 0 110 2h-1a1 1 0 110-2zm-2.64-3.36a1 1 0 010 1.42L13.93 8a1 1 0 11-1.42-1.42l.43-.43a1 1 0 011.42 0z" />
                    <path d="M10 5a5 5 0 100 10A5 5 0 0010 5z" />
                </svg>
            </template>
            <template x-if="darkMode">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M17.293 13.293A8 8 0 016.707 2.707 8 8 0 1017.293 13.293z" clip-rule="evenodd" />
                </svg>
            </template>
        </button>
    </div>

    <!-- Page Content -->
    {{ $slot }}

</body>
</html>