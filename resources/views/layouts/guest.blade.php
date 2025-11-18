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

      <!-- Dark / Light Toggle -->
                <div class="fixed top-7 right-10 z-50"
     x-data="{ darkMode: localStorage.theme === 'dark' }"
     x-init="
        document.documentElement.classList.toggle('dark', darkMode);
     "
>
    <button
        @click="
            darkMode = !darkMode;
            localStorage.theme = darkMode ? 'dark' : 'light';
            document.documentElement.classList.toggle('dark', darkMode);
        "
        class="inline-flex items-center justify-center p-2 rounded-full border border-slate-300 dark:border-slate-700
               text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800/50
               transition-all duration-200"
        aria-label="Toggle dark mode"
    >

        <!-- Light Mode Icon (Sun) -->
        <template x-if="!darkMode">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-5 h-5 text-yellow-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 3v2.25M12 18.75V21M4.22 4.22l1.59 1.59M18.19 18.19l1.59 1.59M3 12h2.25M18.75 12H21M4.22 19.78l1.59-1.59M18.19 5.81l1.59-1.59M12 8.25A3.75 3.75 0 1 0 15.75 12 3.75 3.75 0 0 0 12 8.25Z" />
            </svg>
        </template>

        <!-- Dark Mode Icon (Moon) -->
        <template x-if="darkMode">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-5 h-5 text-slate-300">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z" />
            </svg>
        </template>

    </button>
</div>


    <!-- Page Content -->
    {{ $slot }}

</body>
</html>
