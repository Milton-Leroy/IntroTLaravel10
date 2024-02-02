<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <form method="post" action="{{ route('login.github') }}" class="mt-4">
        @csrf
        
        <button type="submit" class="flex items-center justify-center space-x-2 mx-24 px-4 py-2 border border-gray-300 rounded-md bg-white text-gray-800 hover:bg-gray-100 focus:outline-none focus:border-blue-500 focus:ring-blue-500">
            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 .25a8 8 0 0 0-2.54 15.602c.4.074.548-.174.548-.386 0-.19-.007-.693-.01-1.36-2.233.487-2.705-1.08-2.705-1.08-.365-.927-.89-1.174-.89-1.174-.727-.497.056-.487.056-.487.798.057 1.22.86 1.22.86.712 1.222 1.868.87 2.324.665.073-.516.281-.87.51-1.07-1.774-.2-3.637-.886-3.637-3.952 0-.874.312-1.59.824-2.155-.083-.2-.36-1.017.078-2.12 0 0 .67-.214 2.2.82a7.62 7.62 0 0 1 2-.27 7.62 7.62 0 0 1 2 .27c1.53-1.034 2.2-.82 2.2-.82.44 1.103.163 1.92.08 2.12.514.565.824 1.28.824 2.154 0 3.073-1.866 3.75-3.648 3.947.287.246.54.733.54 1.48 0 1.07-.01 1.93-.01 2.19 0 .21.145.46.55.38A8.003 8.003 0 0 0 8 .25"></path>
            </svg>
            <span class="font-medium">Sign In with GitHub</span>
        </button>

    </form>

</x-guest-layout>
