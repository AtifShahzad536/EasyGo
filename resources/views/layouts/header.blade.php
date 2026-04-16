<header class="bg-white border-b border-gray-100 h-20 shrink-0 flex items-center pl-4 lg:pl-8 pr-0 justify-between sticky top-0 z-20 shadow-sm w-full">
    <!-- Left: Hamburger + Page Title -->
    <div class="flex items-center gap-2 lg:gap-4">
        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" 
                class="p-2 -ml-2 text-gray-400 hover:text-[#1C69D4] hover:bg-blue-50 rounded-xl transition-all lg:hidden group active:scale-95">
            <svg class="w-6 h-6 transition-transform" :class="mobileMenuOpen ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Page Title & Breadcrumbs -->
        <div class="flex items-center gap-3 lg:gap-4">
            <!-- Vertical Accent Bar -->
            <div class="hidden xs:block w-1 h-8 lg:w-1.5 lg:h-10 bg-[#1C69D4] rounded-full shadow-[0_0_15px_rgba(28,105,212,0.3)]"></div>
        
            <div class="flex flex-col">
                <!-- Breadcrumbs -->
                <div class="hidden sm:flex items-center gap-1.5 text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">
                    <span>Platform</span>
                    <svg class="w-2.5 h-2.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-[#1C69D4]">
                        @isset($header)
                            {{ str_replace(['index', '.', '-'], ['', ' ', ' '], request()->route()->getName()) }}
                        @else 
                            Overview
                        @endisset
                    </span>
                </div>

                <!-- Page Title Slot -->
                <div class="translate-y-[-1px] sm:translate-y-[-2px]">
                    @isset($header)
                        <div class="text-lg sm:text-2xl font-black text-gray-900 tracking-tight leading-tight">
                            {{ $header }}
                        </div>
                    @else
                        <h1 class="text-lg sm:text-2xl font-black text-gray-900 tracking-tight leading-tight">Overview</h1>
                    @endisset
                </div>
            </div>
        </div>
    </div>  {{-- ✅ FIXED: Left section properly closed here --}}

    <!-- Right Controls -->
    <div class="flex items-center gap-4 lg:gap-6 ml-auto justify-end">
        <!-- Search bar -->
        <div class="relative hidden sm:block w-64 lg:w-80">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" /></svg>
            </div>
            <input type="text" class="block w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-full leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] sm:text-sm transition-all text-gray-900" placeholder="Search...">
        </div>

        <!-- Notifications Dropdown -->
        <div class="relative" x-data="{ open: false }" @click.away="open = false">
            <button @click="open = !open" 
                    class="relative p-2.5 text-gray-500 hover:text-[#1C69D4] hover:bg-blue-50 rounded-full transition-all group active:scale-95"
                    :class="open ? 'bg-blue-50 text-[#1C69D4]' : ''">
                <!-- Notification Dot -->
                <span class="absolute top-2 right-2.5 block h-2.5 w-2.5 rounded-full bg-red-500 ring-4 ring-white shadow-sm"></span>
                <svg class="h-6 w-6 transform group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
            </button>

            <!-- Notification Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                 class="fixed inset-x-4 top-24 sm:absolute sm:inset-auto sm:right-0 sm:mt-3 w-auto sm:w-80 lg:w-96 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[100]"
                 x-cloak>
                
                <div class="px-5 py-4 border-b border-gray-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-black text-gray-900 tracking-tight">Notifications</h3>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">3 Unread Messages</p>
                    </div>
                    <button class="text-[10px] font-black text-[#1C69D4] hover:underline uppercase tracking-widest">Mark all as read</button>
                </div>

                <div class="max-h-[350px] overflow-y-auto custom-scrollbar">
                    <!-- Notification Item 1 -->
                    <div class="px-5 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 cursor-pointer group">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0 border border-orange-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black text-gray-900 truncate tracking-tight">New Payout Request</p>
                                    <span class="text-[9px] font-bold text-gray-400 capitalize">2 mins ago</span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-1 line-clamp-2">Driver <span class="font-bold text-gray-700">Ahmed Khan</span> requested a payout of PKR 28,500.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Item 2 -->
                    <div class="px-5 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 cursor-pointer group">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#1C69D4] flex items-center justify-center shrink-0 border border-blue-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black text-gray-900 truncate tracking-tight">New Rider Signup</p>
                                    <span class="text-[9px] font-bold text-gray-400 capitalize">1 hour ago</span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-1 line-clamp-2">12 new riders joined the platform in the last 2 hours.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Notification Item 3 -->
                    <div class="px-5 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 cursor-pointer group">
                        <div class="flex gap-4">
                            <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center shrink-0 border border-red-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs font-black text-gray-900 truncate tracking-tight">Critical System Update</p>
                                    <span class="text-[9px] font-bold text-gray-400 capitalize">5 hours ago</span>
                                </div>
                                <p class="text-[11px] text-gray-500 mt-1 line-clamp-2">Application v2.4.1 deployment scheduled for 12:00 AM tonight.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 bg-gray-50/50">
                    <button class="w-full py-2.5 bg-white border border-gray-100 rounded-xl text-[11px] font-black text-gray-500 hover:text-[#1C69D4] hover:border-blue-100 shadow-sm transition-all uppercase tracking-widest">
                        View All Notifications
                    </button>
                </div>
            </div>
        </div>

        <!-- Profile Dropdown -->
        <div class="relative mr-4" x-data="{ open: false }" @click.away="open = false">  {{-- ✅ FIXED: -mr-4 → mr-4 --}}
            <!-- Profile Chip -->
            <div @click="open = !open" 
                 class="flex items-center gap-2 pl-4 pr-3 py-1.5 bg-gray-50/50 hover:bg-gray-100 rounded-full border border-gray-100 transition-all cursor-pointer group active:scale-95"
                 :class="open ? 'bg-gray-100 ring-2 ring-blue-50' : ''">
                
                <div class="flex flex-col items-end hidden lg:flex text-right">
                    <span class="text-xs font-black text-gray-900 tracking-tight leading-none">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mt-0.5">Super Admin</span>
                </div>
                
                <div class="relative">
                    <div class="h-10 w-10 bg-[#1C69D4] text-white rounded-full flex items-center justify-center font-black text-xs shadow-lg shadow-blue-200 border-2 border-white transform group-hover:scale-105 transition-all">
                        {{ strtoupper(substr(Auth::user()->name ?? 'SA', 0, 2)) }}
                    </div>
                    <!-- Online Status Dot -->
                    <span class="absolute -bottom-0.5 -right-0.5 block h-3.5 w-3.5 rounded-full bg-green-500 ring-2 ring-white shadow-sm"></span>
                </div>

                <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-900 transition-transform duration-200" 
                     :class="open ? 'rotate-180 text-gray-900' : ''"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            </div>

            <!-- Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                 class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-[100]"
                 x-cloak>
                
                <div class="p-3 border-b border-gray-50 bg-gray-50/50">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-1 px-2">Account Status</p>
                    <div class="flex items-center gap-2 px-2 py-1">
                        <div class="w-2.5 h-2.5 rounded-full bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.4)]"></div>
                        <span class="text-xs font-bold text-gray-700">Online & Active</span>
                    </div>
                </div>

                <div class="p-2">
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold text-gray-600 hover:text-[#1C69D4] hover:bg-blue-50 rounded-xl transition-all group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-blue-100 text-gray-400 group-hover:text-[#1C69D4] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <span>My Profile</span>
                    </a>
                    <a href="{{ route('reports.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm font-bold text-gray-600 hover:text-[#1C69D4] hover:bg-blue-50 rounded-xl transition-all group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 group-hover:bg-blue-100 text-gray-400 group-hover:text-[#1C69D4] flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <span>Reports Dashboard</span>
                    </a>
                </div>

                <div class="p-2 border-t border-gray-50 bg-gray-50/30">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all group">
                            <div class="w-8 h-8 rounded-lg bg-red-100/50 group-hover:bg-red-100 text-red-400 group-hover:text-red-600 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            </div>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>