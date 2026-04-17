<aside 
    id="sidebar"
    class="fixed inset-y-0 left-0 z-[50] w-72 bg-[#1C69D4] text-white flex flex-col h-screen shadow-2xl transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:flex shrink-0 lg:relative overflow-hidden"
    :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    x-cloak>
    <!-- Animated Mirror BG Effect -->
    <div class="absolute top-0 left-0 w-full h-[180px] bg-gradient-to-br from-[#2B83F2] to-[#1C69D4] opacity-50 pointer-events-none"></div>
    <div class="absolute -top-12 -left-12 w-48 h-48 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-20 -right-10 w-32 h-32 bg-blue-400/10 rounded-full blur-2xl pointer-events-none"></div>

    <!-- Platform Header (Mirror Style) -->
    <div class="h-44 flex flex-col items-center justify-center border-b border-white/10 shrink-0 relative overflow-hidden group">
        <!-- Moving Gloss/Mirror Animation -->
        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-[200%] group-hover:translate-x-[200%] transition-transform duration-[2000ms] skew-x-[-30deg]"></div>
        
        <!-- Logo Circle with Shadow -->
        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-[0_0_30px_rgba(255,255,255,0.2)] border border-white/30 mb-4 transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
            <svg class="w-10 h-10 text-[#1C69D4]" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
            </svg>
        </div>

        <div class="text-center">
            <h1 class="font-black text-2xl tracking-[0.1em] uppercase leading-none drop-shadow-md">EASYGO</h1>
            <div class="flex items-center justify-center gap-2 mt-2">
                <span class="h-[1px] w-4 bg-blue-300/50"></span>
                <span class="text-[9px] font-black text-blue-100/80 tracking-[0.3em] uppercase">Enterprise</span>
                <span class="h-[1px] w-4 bg-blue-300/50"></span>
            </div>
        </div>

        <!-- Floating Decorative Icons (Background) -->
        <div class="absolute top-4 left-4 opacity-10 animate-pulse delay-75">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8L12 16M16 12L8 12" stroke="white" stroke-width="2" stroke-linecap="round"/></svg>
        </div>
        <div class="absolute bottom-6 right-6 opacity-10 animate-bounce transition-all duration-1000">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="white" stroke-width="2"/></svg>
        </div>
    </div>


    <!-- Navigation Links -->
    <nav id="sidebar-nav" class="flex-1 overflow-y-auto py-5 w-full">
        <ul class="space-y-1.5 px-4">
            @php
                $navItems = [
                    ['name' => 'Dashboard', 'route' => 'dashboard', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />'],
                    ['name' => 'Riders', 'route' => 'riders.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />'],
                    ['name' => 'Drivers', 'route' => 'drivers.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />'],
                    ['name' => 'Live Rides', 'route' => 'live-rides.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />'],
                    ['name' => 'Ride History', 'route' => 'ride-history.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                    ['name' => 'Transactions', 'route' => 'transactions.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />'],
                    ['name' => 'Payouts', 'route' => 'payouts.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                    ['name' => 'Wallets', 'route' => 'wallets.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3" />'],
                    ['name' => 'Promotions', 'route' => 'promotions.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l4.318-4.318a2.25 2.25 0 000-3.182L11.159 3.659A2.25 2.25 0 009.568 3zM6 6h.008v.008H6V6z" />'],
                    ['name' => 'Reports', 'route' => 'reports.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />'],
                    ['name' => 'Reviews', 'route' => 'reviews.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.499z" />'],
                    ['name' => 'Scheduled Rides', 'route' => 'scheduled-rides.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />'],
                    ['name' => 'Driver Status', 'route' => 'driver-status.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V3.375c0-.621-.508-1.125-1.129-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5m1.5 1.5h1.5m-.75-3v3M3.75 18h15M4.5 4.5h15M4.5 10.5H18V15H4.5v-4.5z" />'],
                    ['name' => 'Settings', 'route' => 'settings.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12a7.5 7.5 0 0015 0m-15 0a7.5 7.5 0 1115 0m-15 0H3m16.5 0H21m-1.5 0H12m0 0V4.5m0 15V12" />'],
                ];
            @endphp
            @foreach($navItems as $item)
                @php
                    $isActive = request()->routeIs($item['route']);
                @endphp
                <li>
                    <a href="{{ $item['route'] !== '#' ? route($item['route']) : '#' }}" class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 {{ $isActive ? 'bg-[#1557B0] text-white font-bold shadow-inner' : 'text-blue-100/90 hover:bg-white/10 hover:text-white font-medium hover:translate-x-1' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">{!! $item['icon'] !!}</svg>
                        <span>{{ $item['name'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-white/10 shrink-0">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-4 px-4 py-3.5 w-full text-left rounded-xl font-medium text-blue-100 hover:bg-white/10 transition-all hover:text-white hover:translate-x-1">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
