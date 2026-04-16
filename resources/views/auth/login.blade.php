<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Welcome back</h2>
        <p class="text-gray-500 mt-2 text-sm font-medium">Please enter your credentials to access the dashboard.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 whitespace-nowrap">Email Address</label>
            <input id="email" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3.5" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2">
                <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-sm font-semibold text-[#1C69D4] hover:text-blue-800 transition-colors" href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3.5"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center pt-1">
            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#1C69D4] shadow-sm focus:ring-[#1C69D4] focus:ring-2 focus:ring-offset-0 cursor-pointer" name="remember">
            <label for="remember_me" class="ms-2.5 block text-sm font-medium text-gray-600 cursor-pointer">
                Keep me signed in
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-md shadow-[#1C69D4]/20 text-sm font-bold text-white bg-[#1C69D4] hover:bg-[#1557B0] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/30 active:scale-[0.98] transition-all duration-200">
                Sign In to Dashboard
            </button>
        </div>
    </form>
    
    <div class="mt-8 text-center text-sm font-medium text-gray-500">
        Don't have an admin account? 
        <a href="{{ route('register') }}" class="text-[#1C69D4] hover:underline hover:text-[#1557B0]">Request access</a>
    </div>
</x-guest-layout>
