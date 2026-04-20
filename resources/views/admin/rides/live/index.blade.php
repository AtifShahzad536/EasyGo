@extends('layouts.app')

@section('title', 'Live Rides')

@section('content')
<div class="space-y-6">
        <!-- Top Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Active Rides -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 border-l-4 border-l-blue-400 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1C69D4] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Active Rides</p>
                    <p class="text-2xl font-black text-gray-900">142</p>
                </div>
            </div>
            <!-- Drivers Online -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 border-l-4 border-l-green-400 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Drivers Online</p>
                    <p class="text-2xl font-black text-gray-900">1,234</p>
                </div>
            </div>
            <!-- Avg ETA -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 border-l-4 border-l-blue-500 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Avg ETA</p>
                    <p class="text-2xl font-black text-gray-900">8 mins</p>
                </div>
            </div>
            <!-- SOS Active -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4 border-l-4 border-l-red-500 transition-transform hover:-translate-y-1 duration-300">
                <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">SOS Active</p>
                    <p class="text-2xl font-black text-gray-900">0</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Map Side -->
            <div class="lg:col-span-7 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-bold text-gray-900">Live Activity Map</h3>
                    <button class="px-4 py-2 bg-gray-50 text-gray-600 font-bold rounded-xl hover:bg-gray-100 transition-all text-xs border border-gray-100">Refresh</button>
                </div>
                
                <div class="bg-gray-50 rounded-2xl relative h-[500px] flex flex-col items-center justify-center border border-dashed border-gray-200">
                    <!-- Symbolic Map Background -->
                    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/pinstriped-suit.png')]"></div>
                    
                    <!-- Pulsing Points -->
                    <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-blue-300 rounded-full animate-pulse"></div>
                    <div class="absolute top-1/2 left-1/3 w-3 h-3 bg-green-300 rounded-full animate-pulse"></div>
                    <div class="absolute bottom-1/4 right-1/4 w-3 h-3 bg-blue-300 rounded-full animate-pulse delay-700"></div>
                    <div class="absolute top-1/3 right-1/2 w-3 h-3 bg-purple-300 rounded-full animate-pulse delay-500"></div>

                    <!-- Center Marker -->
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-16 h-16 bg-[#1C69D4] rounded-full flex items-center justify-center text-white mb-4 shadow-[0_0_30px_rgba(28,105,212,0.4)]">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <h4 class="text-xl font-black text-gray-900 tracking-tight">Real-Time Map View</h4>
                        <p class="text-sm font-bold text-gray-400 mt-1 uppercase tracking-widest">Tracking 5 active rides</p>
                    </div>

                    <!-- Legend -->
                    <div class="absolute bottom-6 left-6 right-6 flex items-center gap-6 text-[10px] font-black uppercase tracking-widest text-gray-400">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-blue-400"></span> Idle Drivers
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400"></span> Active Rides
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span> SOS Alerts
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feed Side -->
            <div class="lg:col-span-5 bg-white rounded-2xl border border-gray-100 shadow-sm p-6 flex flex-col h-[600px]">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-gray-900">Active Rides</h3>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Live</span>
                    </div>
                </div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-6">Auto-refreshing every 5 seconds</p>

                <div class="flex-1 overflow-y-auto pr-2 -mr-2 space-y-4 font-sans">
                    @foreach([
                        ['id' => 'RD-5621', 'driver' => 'Ahmed Khan', 'rider' => 'Ali Hassan', 'pickup' => 'Clifton Block 5', 'drop' => 'Saddar Market', 'eta' => '12 mins', 'elapsed' => '8 mins', 'status' => 'On Trip', 'color' => 'green'],
                        ['id' => 'RD-5622', 'driver' => 'Sara Ali', 'rider' => 'Zara Malik', 'pickup' => 'Model Town', 'drop' => 'Gulberg III', 'eta' => '5 mins', 'elapsed' => '2 mins', 'status' => 'Driver En Route', 'color' => 'orange'],
                        ['id' => 'RD-5624', 'driver' => 'Fatima Malik', 'rider' => 'Ayesha Khan', 'pickup' => 'Korangi', 'drop' => 'Saddar', 'eta' => '2 mins', 'elapsed' => '22 mins', 'status' => 'Arriving', 'color' => 'blue'],
                        ['id' => 'RD-5625', 'driver' => 'Usman Shah', 'rider' => 'Farhan Ali', 'pickup' => 'Defence', 'drop' => 'Malir', 'eta' => '25 mins', 'elapsed' => '12 mins', 'status' => 'On Trip', 'color' => 'green'],
                    ] as $ride)
                    <div class="bg-gray-50 hover:bg-blue-50/50 rounded-2xl p-5 transition-all border border-transparent hover:border-blue-100 group cursor-pointer">
                        <div class="flex justify-between items-start mb-4">
                            <span class="text-[11px] font-black text-[#1C69D4] uppercase tracking-widest">{{ $ride['id'] }}</span>
                            <span class="px-3 py-1 bg-{{ $ride['color'] }}-50 text-{{ $ride['color'] }}-600 font-black text-[9px] uppercase tracking-widest rounded-lg">{{ $ride['status'] }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4 mb-5">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mb-1">Driver</p>
                                <p class="text-sm font-black text-gray-900 tracking-tight">{{ $ride['driver'] }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter mb-1">Rider</p>
                                <p class="text-sm font-black text-gray-900 tracking-tight">{{ $ride['rider'] }}</p>
                            </div>
                        </div>

                        <div class="space-y-3 mb-5">
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                <span class="text-xs font-bold text-gray-600 line-clamp-1">{{ $ride['pickup'] }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                                <span class="text-xs font-bold text-gray-600 line-clamp-1">{{ $ride['drop'] }}</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">ETA: <span class="text-gray-900 font-black">{{ $ride['eta'] }}</span></span>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Elapsed: <span class="text-gray-900 font-black">{{ $ride['elapsed'] }}</span></span>
                            </div>
                            <div class="w-8 h-8 rounded-lg bg-white border border-gray-100 text-[#1C69D4] flex items-center justify-center group-hover:bg-[#1C69D4] group-hover:text-white transition-all shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
@endsection
