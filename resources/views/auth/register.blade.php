<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Create Account</h2>
        <p class="text-gray-500 mt-2 text-sm font-medium">Join the platform to manage drivers and rides.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5 whitespace-nowrap">Full Name</label>
            <input id="name" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-1.5 text-sm" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5 whitespace-nowrap">Email Address</label>
            <input id="email" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="admin@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-1.5 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
            <input id="password" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1.5 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
            <input id="password_confirmation" class="block w-full rounded-xl border border-gray-200 bg-gray-50/50 text-gray-900 focus:bg-white focus:border-[#1C69D4] focus:ring-4 focus:ring-[#1C69D4]/10 transition-all shadow-sm px-4 py-3"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5 text-sm" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-md shadow-[#1C69D4]/20 text-sm font-bold text-white bg-[#1C69D4] hover:bg-[#1557B0] hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/30 active:scale-[0.98] transition-all duration-200">
                Register Account
            </button>
        </div>
    </form>
    
    <div class="mt-8 text-center text-sm font-medium text-gray-500">
        Already registered? 
        <a href="{{ route('login') }}" class="text-[#1C69D4] hover:underline hover:text-[#1557B0]">Sign in here</a>
    </div>
</x-guest-layout>
