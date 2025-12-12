<x-guest-layout>

    <div class="flex items-center justify-center w-full min-h-screen bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('/images/register-bg2.jpg') }}')">>
        <form method="POST" action="{{ route('register') }}"
              class="w-[35%] bg-white p-10 m-10 rounded-2xl shadow-lg px-30 ">
            @csrf

            <h2 class="text-3xl font-bold text-center mb-5 text-[#1B3C53]">Create Account</h2>
            <a class="text-sm text-gray-600 block text-center mb-8">Provide your account details to join the employee management system.</a>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <div  class="relative flex items-center">
                    <span class="material-symbols-outlined absolute ml-3 text-gray-400">person</span>
                    <x-text-input id="name"
                    class="block mt-1 w-full pl-10"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required autofocus autocomplete="name" />
                </div>
                
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute ml-3 text-gray-400">mail</span>
                    <x-text-input id="email"
                        class="block mt-1 w-full pl-10"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required autocomplete="username" />
                </div>
                
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-gray-400">lock</span>
                    <x-text-input id="password"
                        class="block mt-1 w-full pl-10"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <span id="togglePassword" class="material-symbols-outlined absolute right-3 text-gray-400 cursor-default">visibility_off</span>
                </div>
                
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <div class="relative flex items-center">
                    <span class="material-symbols-outlined absolute left-3 text-gray-400">lock</span>
                    <x-text-input id="password_confirmation"
                        class="block mt-1 w-full pl-10"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />
                    <span id="togglePassword" class="material-symbols-outlined absolute right-3 text-gray-400 cursor-default">visibility_off</span>
                </div>
                
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Action -->
            <div class="flex flex-col items-center mt-8">
                <a class="text-sm text-gray-600 block text-center">By clicking Register, you confirm that you have read and agree to our <span class="font-bold">Terms of Service</span> and <span class="font-bold">Privacy Policy</span>.</a>

                <x-primary-button class="w-full ms-4 px-6 justify-center mt-5">
                    {{ __('Register') }}
                </x-primary-button>


                <a href="{{ route('login') }}"
                    class="text-sm text-gray-600 hover:text-gray-900 mt-4">
                    {{ __('Already registered?') }}
                    <span class="font-bold">Log in</span>
                </a>
            </div>
        </form>
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
