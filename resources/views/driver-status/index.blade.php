<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Driver Status</h2>
            
          
        </div>
    </x-slot>

    <!-- Leaflet Resources -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div class="space-y-8" x-data="{ view: 'table' }">
        <!-- Metrics Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border-l-4 border-l-green-500 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Online Drivers</p>
                <p class="text-4xl font-black text-green-600 mt-2 tracking-tighter">{{ $stats['online'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border-l-4 border-l-blue-500 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Idle Drivers</p>
                <p class="text-4xl font-black text-blue-600 mt-2 tracking-tighter">{{ $stats['idle'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border-l-4 border-l-orange-500 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">On Trip</p>
                <p class="text-4xl font-black text-orange-600 mt-2 tracking-tighter">{{ $stats['on_trip'] }}</p>
            </div>
            <div class="bg-white p-6 rounded-2xl border-l-4 border-l-gray-400 shadow-sm hover:shadow-md transition-shadow">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Offline</p>
                <p class="text-4xl font-black text-gray-400 mt-2 tracking-tighter">{{ $stats['offline'] }}</p>
            </div>
        </div>

        <!-- Controls Section -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between bg-white/50 backdrop-blur-sm p-2 rounded-2xl border border-white shadow-sm gap-2 sm:gap-0">
            <!-- Table/Map Toggle -->
            <div class="flex items-center gap-2 p-1 bg-gray-100/50 rounded-xl">
                <button @click="view = 'table'" :class="view === 'table' ? 'bg-[#1C69D4] text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100'" 
                        class="flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-6 py-2 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest transition-all flex-1 sm:flex-none">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 10h16M4 14h16M4 18h16" /></svg>
                    <span class="sm:hidden">Table</span><span class="hidden sm:inline">Table</span>
                </button>
                <button @click="view = 'map'; setTimeout(() => { window.initMap() }, 100)" :class="view === 'map' ? 'bg-[#1C69D4] text-white shadow-lg' : 'text-gray-500 hover:bg-gray-100'" 
                        class="flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-6 py-2 rounded-lg text-[10px] sm:text-xs font-black uppercase tracking-widest transition-all flex-1 sm:flex-none">
                    <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                    <span class="sm:hidden">Map</span><span class="hidden sm:inline">Map</span>
                </button>
            </div>

            <!-- Filters Row -->
            <div class="flex items-center justify-between sm:justify-end gap-2 sm:gap-4 sm:pr-4">
                <!-- Auto-refreshing indicator -->
                <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                    <span class="relative flex h-2 w-2 shrink-0">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                    <span class="text-[9px] sm:text-[10px] font-bold text-gray-400 uppercase tracking-widest whitespace-nowrap">Auto</span>
                    <span class="hidden sm:inline text-[10px] font-bold text-gray-400 uppercase tracking-widest">-refreshing</span>
                </div>

                <!-- Dropdowns -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <select class="bg-transparent border-none text-[10px] sm:text-[11px] font-black text-gray-700 uppercase tracking-widest focus:ring-0 cursor-pointer hover:text-[#1C69D4] transition-colors py-1">
                        <option>All Status</option>
                        <option>Online</option>
                        <option>On Trip</option>
                        <option>Idle</option>
                    </select>
                    <select class="hidden sm:block bg-transparent border-none text-[11px] font-black text-gray-700 uppercase tracking-widest focus:ring-0 cursor-pointer hover:text-[#1C69D4] transition-colors py-1">
                        <option>All Cities</option>
                        <option>Karachi</option>
                        <option>Lahore</option>
                        <option>Islamabad</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-xl overflow-hidden min-h-[600px] relative">
            <!-- Table View -->
            <div x-show="view === 'table'" x-cloak>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-blue-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Driver</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Vehicle</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">City</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Current Status</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">Last Active</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Today's Trips</th>
                                <th class="px-6 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Today's Earnings</th>
                                <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Location</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($drivers as $driver)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="relative">
                                            <div class="w-10 h-10 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-black text-xs border border-blue-100 shadow-sm">
                                                {{ $driver['avatar'] }}
                                            </div>
                                            <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full border-2 border-white 
                                                {{ $driver['status'] === 'Online' ? 'bg-green-500' : ($driver['status'] === 'On Trip' ? 'bg-orange-500' : ($driver['status'] === 'Idle' ? 'bg-blue-500' : 'bg-gray-400')) }}">
                                            </div>
                                        </div>
                                        <div class="font-black text-gray-900 text-sm tracking-tight group-hover:text-[#1C69D4] transition-colors">{{ $driver['name'] }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-gray-600">{{ $driver['vehicle'] }}</td>
                                <td class="px-6 py-5 text-sm font-bold text-gray-500">{{ $driver['city'] }}</td>
                                <td class="px-6 py-5">
                                    <span class="inline-flex px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest
                                        {{ $driver['status'] === 'Online' ? 'bg-green-50 text-green-600 border border-green-100' : 
                                           ($driver['status'] === 'On Trip' ? 'bg-orange-50 text-orange-600 border border-orange-100' : 
                                           ($driver['status'] === 'Idle' ? 'bg-blue-50 text-[#1C69D4] border border-blue-100' : 'bg-gray-50 text-gray-500 border border-gray-100')) }}">
                                        {{ $driver['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-sm font-bold text-gray-400 italic">{{ $driver['last_active'] }}</td>
                                <td class="px-6 py-5 text-sm font-black text-gray-800 text-center">{{ $driver['trips'] }}</td>
                                <td class="px-6 py-5 text-right">
                                    <span class="text-xs font-black text-green-600 tracking-tight bg-green-50/50 px-2.5 py-1 rounded-md">PKR {{ $driver['earnings'] }}</span>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <div class="flex items-center justify-end gap-1.5 text-sm font-bold text-gray-400 tracking-tight">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                                        {{ $driver['location'] }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Map View -->
            <div x-show="view === 'map'" x-cloak class="h-full absolute inset-0">
                <div id="driverMap" class="w-full h-full z-10"></div>
                
                <!-- Map Overlay Info -->
                <div class="absolute top-6 left-6 z-20 bg-white/90 backdrop-blur-md p-6 rounded-3xl border border-white shadow-2xl max-w-sm">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-[#1C69D4] rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200">
                             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-1.447-.894L15 9m0 11V9" /></svg>
                        </div>
                        <div>
                            <h4 class="font-black text-gray-900 tracking-tight">Live Driver Map</h4>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tracking {{ count($drivers) }} drivers</p>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-[11px] font-black uppercase tracking-widest">
                            <span class="text-gray-400">Status Legend</span>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="flex items-center gap-2 px-3 py-2 bg-green-50 rounded-xl border border-green-100">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-[9px] font-black text-green-700 uppercase tracking-widest">Online</span>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-2 bg-orange-50 rounded-xl border border-orange-100">
                                <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                                <span class="text-[9px] font-black text-orange-700 uppercase tracking-widest">On Trip</span>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-2 bg-blue-50 rounded-xl border border-blue-100">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                <span class="text-[9px] font-black text-blue-700 uppercase tracking-widest">Idle</span>
                            </div>
                            <div class="flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-xl border border-gray-100">
                                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                <span class="text-[9px] font-black text-gray-500 uppercase tracking-widest">Offline</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let map = null;

        window.initMap = function() {
            if (map) return; // Prevent double initialization

            // Center on Karachi (average coordinates of Karachi drivers)
            map = L.map('driverMap', {
                zoomControl: false,
                attributionControl: false
            }).setView([24.8607, 67.0011], 12);

            // Using CartoDB Voyager - clean and premium look
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager_all/{z}/{x}/{y}{r}.png', {
                maxZoom: 19
            }).addTo(map);

            L.control.zoom({
                position: 'bottomright'
            }).addTo(map);

            const drivers = @json($drivers);

            drivers.forEach(driver => {
                const color = driver.status === 'Online' ? '#10b981' : 
                             (driver.status === 'On Trip' ? '#f97316' : 
                             (driver.status === 'Idle' ? '#1C69D4' : '#9ca3af'));

                // Custom marker using divIcon for better styling
                const markerIcon = L.divIcon({
                    className: 'custom-div-icon',
                    html: `<div style="background-color: white; border: 4px solid ${color}; width: 32px; height: 32px; border-radius: 50%; display: flex; items-center; justify-content: center; font-weight: 900; color: ${color}; font-size: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">${driver.avatar}</div>`,
                    iconSize: [32, 32],
                    iconAnchor: [16, 32]
                });

                L.marker([driver.lat, driver.lng], {icon: markerIcon})
                    .addTo(map)
                    .bindPopup(`
                        <div class="p-2">
                            <p class="font-black text-gray-800">${driver.name}</p>
                            <p class="text-[10px] text-gray-400 uppercase font-black">${driver.vehicle}</p>
                            <div class="mt-2 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full" style="background-color: ${color}"></span>
                                <span class="text-[10px] font-black uppercase text-gray-600">${driver.status}</span>
                            </div>
                        </div>
                    `);
            });
        };

        // Styles for leaflet popups to match theme
        const style = document.createElement('style');
        style.innerHTML = `
            .leaflet-popup-content-wrapper { border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); border: 1px solid #f1f5f9; }
            .leaflet-popup-tip { box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
            .leaflet-container { font-family: 'Instrument Sans', sans-serif; }
            [x-cloak] { display: none !important; }
        `;
        document.head.appendChild(style);
    </script>
</x-app-layout>
