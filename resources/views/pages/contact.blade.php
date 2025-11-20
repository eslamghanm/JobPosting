<x-app-layout>
    {{-- Contact Us Section --}}
    <section class="relative bg-gray-50 dark:bg-gray-900 py-24">
        <!-- Background Accent -->
        <div class="absolute inset-0">
            <div class="bg-indigo-600/10 dark:bg-indigo-700/20 w-full h-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white">
                    Contact <span class="text-indigo-600 dark:text-indigo-400">HireUp</span>
                </h2>
                <p class="mt-4 text-gray-600 dark:text-gray-300 text-lg max-w-2xl mx-auto">
                    Have a question or want to work with us? We'd love to hear from you. Reach out via the form below, email, or phone.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700">
                    <form method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Full Name
                            </label>
                            <input type="text" name="name" id="name" required
                                   class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Email Address
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Subject
                            </label>
                            <input type="text" name="subject" id="subject" required
                                   class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Message
                            </label>
                            <textarea name="message" id="message" rows="5" required
                                      class="mt-2 w-full px-4 py-3 rounded-xl border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <button type="submit"
                                class="w-full py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition">
                            Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Details -->
                <div class="space-y-8">
                    <div class="bg-white dark:bg-gray-800 p-8 rounded-3xl shadow-lg border border-gray-200 dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-4">Get in Touch</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            We're here to answer your questions and help you find the best talent or job opportunities.
                        </p>

                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 2H8a2 2 0 00-2 2v16a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2z"/>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">123 Job Street, Cairo, Egypt</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v9a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">support@hireup.com</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.6a2 2 0 011.95 1.5l.5 2.5a2 2 0 01-2 2H5.6a2 2 0 01-2-2V5zM21 13v6a2 2 0 01-2 2h-3.6a2 2 0 01-1.95-1.5l-.5-2.5a2 2 0 012-2H18.4a2 2 0 012 2z"/>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">+20 123 456 789</span>
                            </div>
                        </div>

                        {{-- Social Links --}}
                        <div class="mt-6 flex gap-4">
                            <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.877v-6.987H7.898v-2.89h2.54V9.845c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.242 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c-5.406 0-9.837 4.432-9.837 9.837 0 4.368 2.845 8.074 6.765 9.404.495.09.675-.215.675-.478 0-.236-.009-.864-.013-1.696-2.753.598-3.334-1.327-3.334-1.327-.451-1.147-1.102-1.451-1.102-1.451-.902-.617.069-.604.069-.604 1.002.071 1.53 1.029 1.53 1.029.887 1.519 2.327 1.08 2.894.826.091-.641.348-1.081.634-1.329-2.197-.25-4.508-1.098-4.508-4.889 0-1.08.387-1.963 1.023-2.656-.103-.25-.443-1.256.097-2.617 0 0 .834-.267 2.735 1.021a9.544 9.544 0 012.49-.335 9.54 9.54 0 012.49.335c1.9-1.288 2.734-1.021 2.734-1.021.541 1.361.201 2.367.098 2.617.637.693 1.023 1.576 1.023 2.656 0 3.801-2.314 4.635-4.518 4.879.358.308.678.916.678 1.847 0 1.333-.012 2.408-.012 2.735 0 .264.18.571.681.475C19.992 20.074 22.837 16.368 22.837 12 22.837 6.595 18.406 2.163 12 2.163z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Map Placeholder --}}
                   {{-- Map Section --}}
<div class="w-full h-64 md:h-72 lg:h-80 rounded-3xl overflow-hidden shadow border border-gray-200 dark:border-gray-700">
    <iframe
        width="100%"
        height="100%"
        frameborder="0"
        style="border:0;"
        loading="lazy"
        allowfullscreen
        referrerpolicy="no-referrer-when-downgrade"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.180135904908!2d31.304!3d30.215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzDCsDEyJzU0LjAiTiAzMcKwMTgnMTQuNCJF!5e0!3m2!1sar!2seg!4v1700000000000">
    </iframe>
</div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
