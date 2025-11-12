<x-guest-layout>
    <!-- Full-Width Book Layout -->
    <div class="min-h-screen flex flex-col lg:flex-row">
        
        <!-- Left Page - Image Side -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center transform transition-transform duration-700 hover:scale-105"
                 style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=1470&q=80');">
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/40 via-indigo-600/30 to-transparent"></div>
            </div>
            
            <!-- Decorative Content -->
            <div class="relative z-10 flex flex-col justify-center items-center w-full p-12 text-white">
                <div class="max-w-lg space-y-8">
                    <a href="/" class="inline-block">
                        <x-application-logo class="w-20 h-20 fill-current text-white drop-shadow-2xl" />
                    </a>
                    <div class="space-y-4 backdrop-blur-md bg-white/10 p-10 rounded-3xl border border-white/20 shadow-2xl">
                        <h1 class="text-5xl font-bold drop-shadow-lg">Welcome Back!</h1>
                        <p class="text-xl text-gray-100 drop-shadow-md">Sign in to continue your journey and unlock new opportunities</p>
                        <div class="pt-6 space-y-3">
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Access Your Dashboard</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Manage Your Profile</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-lg">Stay Connected</span>
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
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Sign In</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Welcome back! Please enter your credentials</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" 
                                      class="block mt-1.5 w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" 
                                      type="email" 
                                      name="email" 
                                      :value="old('email')" 
                                      required 
                                      autofocus 
                                      autocomplete="username" />
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
                                      autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" 
                                   type="checkbox" 
                                   class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:bg-gray-900 dark:focus:ring-offset-gray-800 transition" 
                                   name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium transition-colors" 
                               href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <x-primary-button class="w-full justify-center py-3 text-base font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 transition-all shadow-lg hover:shadow-xl">
                            {{ __('Sign In') }}
                        </x-primary-button>
                    </div>

                    <!-- Divider -->
                    <div class="relative py-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300 dark:border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-4 bg-white dark:bg-gray-800 text-gray-500 dark:text-gray-400">New here?</span>
                        </div>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <a href="{{ route('register') }}" 
                           class="inline-flex items-center justify-center w-full py-3 px-4 text-base font-semibold rounded-lg border-2 border-indigo-600 dark:border-indigo-500 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all">
                            Create an Account
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>