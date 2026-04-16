<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50">
        <div class="min-h-screen flex">
            <!-- Left Side Branding (Hidden on mobile) -->
            <div class="hidden lg:flex lg:w-1/2 bg-[#1C69D4] flex-col justify-center items-center p-12 text-white relative overflow-hidden">
                <!-- Abstract circles background for premium feel -->
                <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-white/10 blur-3xl pointer-events-none"></div>
                <div class="absolute bottom-[-10%] left-[-10%] w-[400px] h-[400px] rounded-full bg-blue-400/20 blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center p-5 border border-white/20 mb-8 shadow-2xl">
                        <svg class="w-full h-full text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </div>
                    <h1 class="text-4xl font-bold tracking-tight mb-4 drop-shadow-sm">Platform Admin</h1>
                    <p class="text-blue-100 text-lg text-center max-w-md leading-relaxed">
                        Manage your entire ecosystem, monitor drivers, and track earnings seamlessly from one centralized dashboard.
                    </p>
                </div>
            </div>

            <!-- Right Side Form Container -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-slate-50 relative">
                <!-- Mobile Logo -->
                <div class="absolute top-8 left-8 lg:hidden flex items-center gap-2">
                    <div class="w-10 h-10 bg-[#1C69D4] rounded-xl flex items-center justify-center p-2 shadow-md">
                        <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                    </div>
                    <span class="font-bold text-gray-900">Admin</span>
                </div>

                <!-- Form Card -->
                <div class="w-full max-w-md mt-16 lg:mt-0 p-8 sm:p-10 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-[2rem] border border-gray-100">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
