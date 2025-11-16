<x-app-layout>

    {{-- Hero Section --}}
    <section class=" border-b border-gray-100 dark:border-slate-700 relative py-24 bg-gray-50 dark:bg-slate-900">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('assets/hero.avif') }}" class="w-full h-full object-cover opacity-30 dark:opacity-50"
                alt="Background">
            <div class="absolute inset-0 bg-gray-900/35 dark:bg-black/40"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4">
                Our Mission & Vision
            </h2>
            <p class="text-lg md:text-xl text-gray-200 mb-6 max-w-2xl mx-auto">
                Discover what drives us to create meaningful connections and life-changing opportunities.
            </p>
            <a href="#team"
                class="inline-block px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-semibold transition">
                Meet Our Team
            </a>
        </div>
    </section>

    {{-- Team Section --}}
    <section id="team" class="border-b border-gray-100 dark:border-slate-700  py-24 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl md:text-4xl font-bold text-center dark:text-white">Meet Our Team</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mt-2">
                A group of passionate individuals working to build the future of hiring.
            </p>

            <div class="grid md:grid-cols-4 gap-10 mt-16">

                @foreach ([
        [
            'name' => 'Fady Samire',
            'role' => 'Security Lead',
            'img' => 'D1.jpg',
            'description' => 'Responsible for maintaining the security of the platform, ensuring data privacy and system integrity.',
        ],
        [
            'name' => 'Eslam Ahmed',
            'role' => 'Admin Manager',
            'img' => 'D2.jpg',
            'description' => 'Handles all administrative functions, manages internal workflows, and ensures smooth operation of the admin panel.',
        ],
        [
            'name' => 'Ahmed Elnagar',
            'role' => 'Candidate Manager',
            'img' => 'D3.jpg',
            'description' => 'Manages the candidate experience, oversees applications, and ensures a seamless hiring process for job seekers.',
        ],
        [
            'name' => 'Moaz Yasser',
            'role' => 'Employer Manager',
            'img' => 'D4.jpg',
            'description' => 'Responsible for handling employer accounts, job postings, and ensuring businesses find the right talent efficiently.',
        ],
    ] as $member)
                    <div
                        class="bg-gray-50 dark:bg-slate-900 rounded-3xl shadow border border-gray-200 dark:border-gray-700 p-6 text-center">
                        <img src="{{ asset('assets/' . $member['img']) }}"
                            class="w-28 h-28 mx-auto rounded-full object-cover shadow mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $member['name'] }}</h3>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium mb-2">{{ $member['role'] }}</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $member['description'] }}</p>
                    </div>
                @endforeach

            </div>


        </div>
    </section>


    {{-- Mission & Vision --}}
    <section class=" border-b border-gray-100 dark:border-slate-700 py-20 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 dark:text-white mb-12">
                Our Mission & Vision
            </h2>

            <div class="grid md:grid-cols-2 gap-10">
                {{-- Mission --}}
                <div
                    class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-3">Our Mission</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        To empower job seekers and employers through a transparent, supportive, and
                        innovative hiring platform designed to create meaningful connections and life-changing
                        opportunities.
                    </p>
                </div>

                {{-- Vision --}}
                <div
                    class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-3">Our Vision</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        To become the most trusted hiring platform globally, where every individual
                        finds the right place, and every company finds the right talent effortlessly.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section
        class="py-20 bg-gray-50 border-b border-gray-100 dark:border-slate-700 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-6">

            <h2 class="text-3xl md:text-4xl font-bold text-center dark:text-white">Our Values</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 mt-2 max-w-2xl mx-auto">
                The core principles that guide everything we do.
            </p>

            <div class="grid md:grid-cols-3 gap-10 mt-14">

                <div
                    class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">Integrity</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        We uphold honesty and transparency, building trust with every interaction.
                    </p>
                </div>

                <div
                    class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">Innovation</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        We challenge norms and create smarter, faster ways for people to connect.
                    </p>
                </div>

                <div
                    class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow border border-gray-200 dark:border-gray-700">
                    <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400">Empowerment</h3>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        We provide tools and support that help individuals and companies grow.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="border-b border-gray-100 dark:border-slate-700 py-24 bg-gray-50 dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-6 text-center">

            <!-- Section Header -->
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Our Impact
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-12 max-w-2xl mx-auto">
                Over the years, we've helped thousands of candidates and employers connect successfully.
            </p>

            <!-- Stats Grid -->
            <div class="grid md:grid-cols-3 gap-10">

                <div class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow hover:shadow-lg transition">
                    <h3 class="text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">12k+</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg font-medium">Jobs Posted</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">
                        Thousands of opportunities across different industries for candidates to find their dream jobs.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow hover:shadow-lg transition">
                    <h3 class="text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">40k+</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg font-medium">Candidates</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">
                        Talented job seekers have registered and successfully connected with companies worldwide.
                    </p>
                </div>

                <div class="bg-gray-50 dark:bg-slate-900 p-8 rounded-3xl shadow hover:shadow-lg transition">
                    <h3 class="text-5xl font-bold text-indigo-600 dark:text-indigo-400 mb-2">1.2k+</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-lg font-medium">Company Partners</p>
                    <p class="text-gray-500 dark:text-gray-400 mt-2 text-sm">
                        Businesses trust our platform to find the right talent efficiently and effortlessly.
                    </p>
                </div>

            </div>
        </div>
    </section>




</x-app-layout>
