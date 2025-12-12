<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center w-full min-h-screen p-20 gap-16 overflow-hidden">

        <div class="w-1/2 flex flex-col">
            <h2 class="text-4xl font-bold mb-6 text-[#1B3C53] text-center">Sign In</h2>

            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col items-center p-10">
                @csrf

                <div class="mt-4 w-full flex justify-center">
                    <div class="w-1/2"> 
                        <x-input-label for="email" :value="__('Email')" />

                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute ml-3 text-gray-400">mail</span>

                            <x-text-input id="email"
                                class="block mt-1 w-full pl-10"
                                type="email"
                                name="email"
                                :value="old('email')"
                                required autofocus autocomplete="username" />
                        </div>

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4 w-full flex justify-center">
                    <div class="w-1/2">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative flex items-center">
                            <span class="material-symbols-outlined absolute left-3 text-gray-400">lock</span>

                            <x-text-input id="password"
                                class="block mt-1 w-full pl-10"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                            <span id="togglePassword" class="material-symbols-outlined absolute right-3 text-gray-400 cursor-default">visibility_off</span>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>


                <div class="mt-4 w-full flex justify-center">
                    <div class="w-1/2 flex justify-between items-center">
                        
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500"
                                name="remember">
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif

                    </div>
                </div>

                <div class="flex flex-col items-center w-full gap-3 mt-8 mb-5">
                    <x-primary-button class="w-1/2 justify-center">
                        {{ __('Log in') }}
                    </x-primary-button>

                    <a class="text-md text-gray-600 hover:text-gray-900" 
                       href="{{ route('register') }}">
                        Not registered yet? <span class="font-bold">Register</span>
                    </a>
                </div>

                <div class="flex items-center my-5 w-1/2">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="mx-4 text-gray-500 text-sm mb-3">or continue with</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <button type="button" 
                    class="w-1/2 inline-flex items-center justify-center py-3 px-4 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold rounded-lg shadow-md transition duration-150 ease-in-out">
                    <img src="https://img.icons8.com/color/48/google-logo.png"
                         alt="Google Logo" class="w-5 h-5 mr-3"/>
                    Google account
                </button>

            </form>
        </div>

        {{-- BAGIAN GAMBAR --}}
        <div class="w-1/2 flex items-center justify-center">
            <img src="{{ asset('/images/login-page2.avif') }}"
                alt="Login Image"
                class="w-full h-full object-cover rounded-[50px]" />
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePassword');

            if (passwordInput && toggleIcon) {
               
                toggleIcon.addEventListener('click', function () {
                    
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    if (type === 'password') {
                        toggleIcon.textContent = 'visibility_off';
                    } else {
                        toggleIcon.textContent = 'visibility';
                    }
                });
            }
        });
    </script>

</x-guest-layout>
