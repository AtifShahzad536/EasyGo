<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Ride History</h2>
    </x-slot>

    @php
        $rides = [
            ['id'=>'RD-5621','date'=>'2026-04-08 10:30 AM','rider'=>'Ali Hassan',  'rider_rating'=>4.8,'driver'=>'Ahmed Khan',  'driver_rating'=>4.9,'from'=>'Clifton',  'to'=>'Saddar', 'distance'=>'8.5 km', 'duration'=>'22 mins','fare'=>'PKR 450', 'base'=>'PKR 150','dist_fare'=>'PKR 300','payment'=>'Card',  'status'=>'Completed','color'=>'green','timeline'=>[['label'=>'Booked','time'=>'2026-04-08 10:30 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'2 mins later','dot'=>'blue'],['label'=>'Picked Up','time'=>'8 mins later','dot'=>'orange'],['label'=>'Completed','time'=>'22 mins later','dot'=>'green']]],
            ['id'=>'RD-5620','date'=>'2026-04-08 10:15 AM','rider'=>'Zara Malik',  'rider_rating'=>4.6,'driver'=>'Sara Ali',    'driver_rating'=>4.7,'from'=>'DHA',       'to'=>'Airport','distance'=>'25 km',  'duration'=>'45 mins','fare'=>'PKR 1200','base'=>'PKR 350','dist_fare'=>'PKR 850','payment'=>'Wallet','status'=>'Completed','color'=>'green','timeline'=>[['label'=>'Booked','time'=>'2026-04-08 10:15 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'3 mins later','dot'=>'blue'],['label'=>'Picked Up','time'=>'10 mins later','dot'=>'orange'],['label'=>'Completed','time'=>'45 mins later','dot'=>'green']]],
            ['id'=>'RD-5619','date'=>'2026-04-08 10:00 AM','rider'=>'Hassan Raza', 'rider_rating'=>4.9,'driver'=>'Bilal Ahmed', 'driver_rating'=>4.5,'from'=>'Gulshan',   'to'=>'Clifton','distance'=>'12 km',  'duration'=>'28 mins','fare'=>'PKR 320', 'base'=>'PKR 120','dist_fare'=>'PKR 200','payment'=>'Cash',  'status'=>'Cancelled','color'=>'red',  'timeline'=>[['label'=>'Booked','time'=>'2026-04-08 10:00 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'2 mins later','dot'=>'blue'],['label'=>'Cancelled','time'=>'5 mins later','dot'=>'red']]],
            ['id'=>'RD-5618','date'=>'2026-04-08 09:45 AM','rider'=>'Ayesha Khan', 'rider_rating'=>4.3,'driver'=>'Usman Shah',  'driver_rating'=>4.6,'from'=>'Korangi',   'to'=>'Saddar', 'distance'=>'15 km',  'duration'=>'32 mins','fare'=>'PKR 580', 'base'=>'PKR 180','dist_fare'=>'PKR 400','payment'=>'Card',  'status'=>'Completed','color'=>'green','timeline'=>[['label'=>'Booked','time'=>'2026-04-08 09:45 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'4 mins later','dot'=>'blue'],['label'=>'Picked Up','time'=>'12 mins later','dot'=>'orange'],['label'=>'Completed','time'=>'32 mins later','dot'=>'green']]],
            ['id'=>'RD-5617','date'=>'2026-04-08 09:30 AM','rider'=>'Farhan Ali',  'rider_rating'=>4.7,'driver'=>'Fatima Malik','driver_rating'=>4.8,'from'=>'Defence',   'to'=>'Malir',  'distance'=>'28 km',  'duration'=>'52 mins','fare'=>'PKR 890', 'base'=>'PKR 250','dist_fare'=>'PKR 640','payment'=>'Wallet','status'=>'Completed','color'=>'green','timeline'=>[['label'=>'Booked','time'=>'2026-04-08 09:30 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'3 mins later','dot'=>'blue'],['label'=>'Picked Up','time'=>'9 mins later','dot'=>'orange'],['label'=>'Completed','time'=>'52 mins later','dot'=>'green']]],
            ['id'=>'RD-5616','date'=>'2026-04-08 09:15 AM','rider'=>'Sana Ahmed',  'rider_rating'=>4.5,'driver'=>'Ahmed Khan',  'driver_rating'=>4.9,'from'=>'Nazimabad', 'to'=>'Saddar', 'distance'=>'10 km',  'duration'=>'25 mins','fare'=>'PKR 280', 'base'=>'PKR 100','dist_fare'=>'PKR 180','payment'=>'Cash',  'status'=>'Cancelled','color'=>'red',  'timeline'=>[['label'=>'Booked','time'=>'2026-04-08 09:15 AM','dot'=>'blue'],['label'=>'Driver Assigned','time'=>'5 mins later','dot'=>'blue'],['label'=>'Cancelled','time'=>'8 mins later','dot'=>'red']]],
        ];
        $currentStatus = $status ?? 'all';
        $filteredRides = array_values(array_filter($rides, function($ride) use ($currentStatus) {
            if ($currentStatus === 'all') return true;
            return strtolower($ride['status']) === strtolower($currentStatus);
        }));
        $counts = [
            'all'       => count($rides),
            'completed' => count(array_filter($rides, fn($r) => $r['status'] === 'Completed')),
            'cancelled' => count(array_filter($rides, fn($r) => $r['status'] === 'Cancelled')),
        ];
    @endphp

    <div class="space-y-4 px-2 sm:px-0" x-data="{ receiptOpen: false, receiptData: null }">

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Status Tabs — scrollable on mobile -->
            <div class="flex border-b border-gray-100 px-2 sm:px-4 overflow-x-auto">
                <a href="{{ route('ride-history.index', ['status' => 'all']) }}"
                   class="flex-shrink-0 px-4 sm:px-5 py-4 text-xs font-black uppercase tracking-widest transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'all' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    All ({{ $counts['all'] }})
                </a>
                <a href="{{ route('ride-history.index', ['status' => 'completed']) }}"
                   class="flex-shrink-0 px-4 sm:px-5 py-4 text-xs font-black uppercase tracking-widest transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'completed' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Completed ({{ $counts['completed'] }})
                </a>
                <a href="{{ route('ride-history.index', ['status' => 'cancelled']) }}"
                   class="flex-shrink-0 px-4 sm:px-5 py-4 text-xs font-black uppercase tracking-widest transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'cancelled' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Cancelled ({{ $counts['cancelled'] }})
                </a>
            </div>

            <!-- Filters -->
            <div class="p-3 sm:p-4 border-b border-gray-50">
                <div class="flex flex-col gap-3">
                    <!-- Search row -->
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" class="block w-full pl-10 pr-4 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-medium text-gray-900 focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all placeholder-gray-400" placeholder="Search by ride ID, rider, or driver...">
                    </div>
                    <!-- Filters row -->
                    <div class="flex flex-wrap gap-2">
                        <div class="relative flex-1 min-w-[130px]">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <input type="text" class="block w-full pl-9 pr-3 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-medium text-gray-500 focus:ring-4 focus:ring-[#1C69D4]/10 transition-all" value="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                        </div>
                        <select class="flex-1 min-w-[120px] bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-black uppercase tracking-widest px-3 py-2.5 focus:ring-4 focus:ring-[#1C69D4]/10 transition-all outline-none text-gray-500 cursor-pointer">
                            <option>All Types</option><option>Economy</option><option>Premium</option>
                        </select>
                        <select class="flex-1 min-w-[120px] bg-gray-50/50 border border-gray-100 rounded-xl text-xs font-black uppercase tracking-widest px-3 py-2.5 focus:ring-4 focus:ring-[#1C69D4]/10 transition-all outline-none text-gray-500 cursor-pointer">
                            <option>All Payments</option><option>Card</option><option>Wallet</option><option>Cash</option>
                        </select>
                        <button class="flex items-center gap-2 px-4 py-2.5 bg-[#1C69D4] text-white font-black text-xs rounded-xl hover:bg-blue-700 transition-all shadow-md shadow-blue-200 uppercase tracking-widest active:scale-95 whitespace-nowrap">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Export
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table with horizontal scroll -->
            <div class="w-full overflow-x-auto" style="-webkit-overflow-scrolling: touch;">
                <table class="w-full text-left border-collapse" style="min-width: 900px;">
                    <thead>
                        <tr class="bg-gray-50/60 text-[9px] text-gray-400 font-black uppercase tracking-widest border-b border-gray-100">
                            <th class="px-4 py-3.5">Ride ID</th>
                            <th class="px-3 py-3.5">Date / Time</th>
                            <th class="px-3 py-3.5">Rider</th>
                            <th class="px-3 py-3.5">Driver</th>
                            <th class="px-3 py-3.5">From</th>
                            <th class="px-3 py-3.5">To</th>
                            <th class="px-3 py-3.5">Distance</th>
                            <th class="px-3 py-3.5">Duration</th>
                            <th class="px-3 py-3.5">Fare</th>
                            <th class="px-3 py-3.5">Payment</th>
                            <th class="px-3 py-3.5">Status</th>
                            <th class="px-3 py-3.5 text-center">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs">
                        @foreach($filteredRides as $ride)
                        <tr class="hover:bg-blue-50/20 transition-colors">
                            <td class="px-4 py-3 font-bold text-[#1C69D4] whitespace-nowrap">{{ $ride['id'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $ride['date'] }}</td>
                            <td class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap">{{ $ride['rider'] }}</td>
                            <td class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap">{{ $ride['driver'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $ride['from'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $ride['to'] }}</td>
                            <td class="px-3 py-3 text-gray-700 font-semibold whitespace-nowrap">{{ $ride['distance'] }}</td>
                            <td class="px-3 py-3 text-gray-700 font-semibold whitespace-nowrap">{{ $ride['duration'] }}</td>
                            <td class="px-3 py-3 font-black text-gray-900 whitespace-nowrap">{{ $ride['fare'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $ride['payment'] }}</td>
                            <td class="px-3 py-3">
                                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-lg border whitespace-nowrap
                                    {{ $ride['color'] === 'green' ? 'bg-green-50 text-green-600 border-green-100' : 'bg-red-50 text-red-600 border-red-100' }}">
                                    {{ $ride['status'] }}
                                </span>
                            </td>
                            <td class="px-3 py-3 text-center">
                                <button @click="receiptData = {{ json_encode($ride) }}; receiptOpen = true"
                                        class="text-[#1C69D4] hover:bg-blue-50 p-1.5 rounded-lg transition-colors mx-auto" title="View Receipt">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-4 sm:p-5 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Showing {{ count($filteredRides) }} entries</p>
                <div class="flex items-center gap-1">
                    <button class="px-3 sm:px-4 py-2 text-xs font-black text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all uppercase tracking-widest">Previous</button>
                    <button class="w-9 h-9 bg-[#1C69D4] text-white rounded-xl text-xs font-black shadow-md shadow-blue-200">1</button>
                    <button class="w-9 h-9 text-gray-600 hover:bg-gray-100 rounded-xl text-xs font-black transition-all">2</button>
                    <button class="px-3 sm:px-4 py-2 text-xs font-black text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all uppercase tracking-widest">Next</button>
                </div>
            </div>
        </div>

        <!-- ===== Ride Receipt Modal — bottom sheet on mobile, centered on sm+ ===== -->
        <div class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center sm:p-4" x-show="receiptOpen" x-cloak @keydown.escape.window="receiptOpen = false">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
                 x-show="receiptOpen"
                 x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="receiptOpen = false"></div>

            <!-- Modal Card -->
            <div class="relative w-full sm:max-w-lg bg-white sm:rounded-3xl rounded-t-[2rem] shadow-2xl overflow-hidden max-h-[95vh] flex flex-col"
                 x-show="receiptOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full sm:scale-95">

                <template x-if="receiptData">
                    <div class="flex flex-col max-h-[95vh]">

                        <!-- Drag handle — mobile only -->
                        <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0">
                            <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
                        </div>

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between px-5 sm:px-7 py-4 border-b border-gray-100 shrink-0">
                            <h3 class="text-sm sm:text-base font-black text-gray-900 tracking-tight" x-text="'Receipt — ' + receiptData.id"></h3>
                            <button @click="receiptOpen = false" class="p-2 hover:bg-gray-100 rounded-xl text-gray-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Scrollable Body -->
                        <div class="flex-1 overflow-y-auto overscroll-contain px-5 sm:px-7 py-5 space-y-5">

                            <!-- Route Map Placeholder -->
                            <div class="bg-blue-50/60 border border-blue-100 rounded-2xl flex flex-col items-center justify-center h-28 sm:h-36 gap-2.5">
                                <div class="w-12 h-12 bg-[#1C69D4] rounded-full flex items-center justify-center shadow-lg shadow-blue-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
                                </div>
                                <p class="text-xs font-black text-[#1C69D4] uppercase tracking-widest">Route Map Visualization</p>
                            </div>

                            <!-- Rider & Driver Info -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="bg-gray-50/70 rounded-2xl p-3.5 border border-gray-100">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Rider</p>
                                    <p class="text-xs font-black text-gray-900" x-text="receiptData.rider"></p>
                                    <div class="flex items-center gap-1 mt-1.5">
                                        <svg class="w-3 h-3 text-yellow-400 fill-current shrink-0" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-xs font-black text-gray-900" x-text="receiptData.rider_rating"></span>
                                    </div>
                                </div>
                                <div class="bg-gray-50/70 rounded-2xl p-3.5 border border-gray-100">
                                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest mb-2">Driver</p>
                                    <p class="text-xs font-black text-gray-900" x-text="receiptData.driver"></p>
                                    <div class="flex items-center gap-1 mt-1.5">
                                        <svg class="w-3 h-3 text-yellow-400 fill-current shrink-0" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        <span class="text-xs font-black text-gray-900" x-text="receiptData.driver_rating"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Route Details -->
                            <div class="space-y-3.5">
                                <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Route</p>
                                <div class="flex items-start gap-3">
                                    <div class="w-2.5 h-2.5 rounded-full bg-green-500 mt-1 shrink-0 shadow-sm shadow-green-200"></div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Pickup</p>
                                        <p class="text-sm font-black text-gray-900 mt-0.5" x-text="receiptData.from"></p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-2.5 h-2.5 rounded-full bg-red-500 mt-1 shrink-0 shadow-sm shadow-red-200"></div>
                                    <div>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Destination</p>
                                        <p class="text-sm font-black text-gray-900 mt-0.5" x-text="receiptData.to"></p>
                                    </div>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Fare Breakdown -->
                            <div class="space-y-3">
                                <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Fare Breakdown</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold text-gray-500">Base Fare</span>
                                    <span class="text-xs font-bold text-gray-900" x-text="receiptData.base"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold text-gray-500">Distance (<span x-text="receiptData.distance"></span>)</span>
                                    <span class="text-xs font-bold text-gray-900" x-text="receiptData.dist_fare"></span>
                                </div>
                                <hr class="border-gray-100">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm font-black text-gray-900">Total</span>
                                    <span class="text-sm font-black text-green-600" x-text="receiptData.fare"></span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-semibold text-gray-500">Payment Method</span>
                                    <span class="text-xs font-bold text-gray-700" x-text="receiptData.payment"></span>
                                </div>
                            </div>

                            <hr class="border-gray-100">

                            <!-- Ride Timeline -->
                            <div class="space-y-3.5">
                                <p class="text-xs font-black text-gray-900 uppercase tracking-widest">Timeline</p>
                                <template x-for="(event, index) in receiptData.timeline" :key="index">
                                    <div class="flex items-center gap-3">
                                        <div class="w-2.5 h-2.5 rounded-full shrink-0"
                                             :class="{
                                                 'bg-blue-500': event.dot === 'blue',
                                                 'bg-orange-400': event.dot === 'orange',
                                                 'bg-green-500': event.dot === 'green',
                                                 'bg-red-500': event.dot === 'red'
                                             }"></div>
                                        <span class="text-xs font-bold text-gray-900" x-text="event.label"></span>
                                        <span class="text-xs font-semibold text-gray-400 ml-auto text-right" x-text="event.time"></span>
                                    </div>
                                </template>
                            </div>

                        </div>

                        <!-- Modal Footer -->
                        <div class="px-5 sm:px-7 py-4 border-t border-gray-100 flex gap-3 bg-white shrink-0 pb-safe">
                            <button class="flex-1 py-3 bg-white border border-gray-200 text-gray-700 font-black text-xs rounded-xl hover:bg-gray-50 transition-all uppercase tracking-widest flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Download PDF
                            </button>
                            <button @click="receiptOpen = false"
                                    class="flex-1 py-3 bg-[#1C69D4] text-white font-black text-xs rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all uppercase tracking-widest">
                                Close
                            </button>
                        </div>

                    </div>
                </template>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] { display: none !important; }
        .pb-safe { padding-bottom: max(1rem, env(safe-area-inset-bottom)); }
        .overscroll-contain { overscroll-behavior: contain; }
    </style>
</x-app-layout>