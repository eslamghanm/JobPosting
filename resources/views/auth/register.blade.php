<x-guest-layout>
    <!-- Full-Width Book Layout -->
    <div class="min-h-screen flex flex-col lg:flex-row">
        
        <!-- Left Page - Image Side -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transform transition-transform duration-700 hover:scale-105"
                 style="background-image: url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1470&q=80');">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/30 via-purple-600/20 to-transparent"></div>
            </div>
            
            <!-- Decorative Content -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                <div class="max-w-lg space-y-8">
                    <a href="/" class="inline-block">
                        <x-application-logo class="w-20 h-20 fill-current text-white drop-shadow-2xl" />
                    </a>
                    <div class="space-y-4 backdrop-blur-md bg-white/10 p-10 rounded-3xl border border-white/20 shadow-2xl">
                        <h1 class="text-5xl font-bold drop-shadow-lg">Join Our Platform</h1>
                        <p class="text-xl text-gray-100 drop-shadow-md">Connect with opportunities or find the perfect talent for your team</p>
                        <div class="pt-6 space-y-3">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Quick & Easy Registration</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Connect with Top Employers</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Secure & Private</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Page - Form Side -->
        <div class="flex w-full lg:w-1/2 justify-center items-center p-6 lg:p-12 bg-white dark:bg-gray-800 transition-colors duration-300">
            <div class="w-full max-w-md space-y-6">
                
                <!-- Mobile Logo (hidden on desktop) -->
                <div class="lg:hidden text-center">
                    <a href="/" class="inline-block">
                        <x-application-logo class="w-16 h-16 mx-auto text-indigo-600 dark:text-indigo-400" />
                    </a>
                </div>

                <!-- Header -->
                <div class="text-center space-y-2">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Create an Account</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Start your journey with us today</p>
                </div>

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <!-- Profile Photo -->
                    <div>
                        <x-input-label :value="__('Profile Photo (Optional)')" />
                        <div class="mt-2 flex items-center space-x-4">
                            <div class="shrink-0">
                                <img id="preview" 
                                     class="h-16 w-16 object-cover rounded-full border-2 border-gray-300 dark:border-gray-600" 
                                     src="https://ui-avatars.com/api/?name=User&size=200&background=6366f1&color=ffffff" 
                                     alt="Profile preview">
                            </div>
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" 
                                       id="profile_photo"
                                       name="profile_photo"
                                       accept="image/jpeg,image/jpg,image/png,image/webp"
                                       onchange="previewImage(event)"
                                       class="block w-full text-sm text-gray-500 dark:text-gray-400
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-indigo-50 file:text-indigo-700
                                              dark:file:bg-indigo-900/30 dark:file:text-indigo-400
                                              hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50
                                              file:cursor-pointer cursor-pointer
                                              transition-all duration-200">
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPG, PNG or WebP. Max 5MB.</p>
                        <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                    </div>

                    <script>
                        function previewImage(event) {
                            const input = event.target;
                            const preview = document.getElementById('preview');
                            
                            if (input.files && input.files[0]) {
                                const reader = new FileReader();
                                
                                reader.onload = function(e) {
                                    preview.src = e.target.result;
                                }
                                
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" 
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                      type="text" 
                                      name="name" 
                                      :value="old('name')" 
                                      required 
                                      autofocus 
                                      autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" 
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required 
                                      autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" 
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                      type="password" 
                                      name="password" 
                                      required 
                                      autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" 
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                      type="password" 
                                      name="password_confirmation" 
                                      required 
                                      autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Role Selection -->
                    <div>
                        <x-input-label :value="__('Register as')" class="mb-3" />
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer transition-all hover:border-indigo-400 dark:hover:border-indigo-500 hover:shadow-md has-[:checked]:border-indigo-600 dark:has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/30 has-[:checked]:shadow-lg">
                                <input type="radio" 
                                       name="role" 
                                       value="candidate" 
                                       class="sr-only peer" 
                                       required>
                                <svg class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400 peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 peer-checked:text-indigo-700 dark:peer-checked:text-indigo-300">Candidate</span>
                            </label>
                            <label class="relative flex flex-col items-center justify-center p-4 border-2 border-gray-300 dark:border-gray-600 rounded-xl cursor-pointer transition-all hover:border-indigo-400 dark:hover:border-indigo-500 hover:shadow-md has-[:checked]:border-indigo-600 dark:has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/30 has-[:checked]:shadow-lg">
                                <input type="radio" 
                                       name="role" 
                                       value="employer" 
                                       class="sr-only peer" 
                                       required>
                                <svg class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400 peer-checked:text-indigo-600 dark:peer-checked:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-200 peer-checked:text-indigo-700 dark:peer-checked:text-indigo-300">Employer</span>
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center py-3 text-base font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-lg hover:shadow-xl">
                            {{ __('Create Account') }}
                        </x-primary-button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center pt-2">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Already have an account? </span>
                        <a href="{{ route('login') }}" 
                           class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-semibold transition-colors">
                            Sign in
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>