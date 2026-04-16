<x-app-layout>
    <x-slot name="header">
        Transactions
    </x-slot>

    <div class="space-y-4 sm:space-y-6 px-2 sm:px-0">
        <!-- Stats Cards Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            <!-- Total Revenue -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between border-l-[6px] border-l-green-500 h-28 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Total Revenue</p>
                    <p class="text-lg sm:text-2xl font-black text-green-600 mt-1">PKR 856,240</p>
                </div>
                <p class="text-[10px] text-gray-400 font-bold">Today</p>
            </div>

            <!-- Total Refunds -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between border-l-[6px] border-l-red-500 h-28 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Total Refunds</p>
                    <p class="text-lg sm:text-2xl font-black text-red-500 mt-1">PKR 12,450</p>
                </div>
                <p class="text-[10px] text-gray-400 font-bold">Today</p>
            </div>

            <!-- Net Revenue -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between border-l-[6px] border-l-blue-400 h-28 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Net Revenue</p>
                    <p class="text-lg sm:text-2xl font-black text-blue-500 mt-1">PKR 843,790</p>
                </div>
                <p class="text-[10px] text-gray-400 font-bold">Today</p>
            </div>

            <!-- Pending Transactions -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between border-l-[6px] border-l-orange-400 h-28 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Pending</p>
                    <p class="text-lg sm:text-2xl font-black text-gray-800 mt-1">8</p>
                </div>
                <p class="text-[10px] text-orange-500 font-bold">Requires attention</p>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-6">
            <div class="flex flex-col sm:flex-wrap sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4">
                <!-- Search -->
                <div class="relative w-full sm:flex-1 sm:min-w-[300px]">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <input type="text" class="block w-full pl-11 pr-4 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all" placeholder="Search by ID, rider, or driver...">
                </div>

                <div class="grid grid-cols-3 sm:flex sm:flex-row gap-3 sm:gap-4">
                    <!-- Date Picker -->
                    <div class="relative col-span-1 sm:w-48">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <input type="date" class="block w-full pl-10 pr-2 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:ring-4 focus:ring-[#1C69D4]/10 transition-all text-gray-500 font-medium">
                    </div>

                    <!-- Types -->
                    <select class="col-span-1 bg-gray-50/50 border border-gray-100 rounded-xl text-sm px-3 py-2.5 focus:ring-4 focus:ring-[#1C69D4]/10 transition-all outline-none font-medium text-gray-600 sm:min-w-[150px]">
                        <option>All Types</option>
                        <option>Payment</option>
                        <option>Refund</option>
                        <option>Wallet Top-up</option>
                        <option>Promo Credit</option>
                    </select>

                    <!-- Status -->
                    <select class="col-span-1 bg-gray-50/50 border border-gray-100 rounded-xl text-sm px-3 py-2.5 focus:ring-4 focus:ring-[#1C69D4]/10 transition-all outline-none font-medium text-gray-600 sm:min-w-[150px]">
                        <option>All Status</option>
                        <option>Completed</option>
                        <option>Failed</option>
                        <option>Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Horizontal scroll wrapper for mobile -->
            <div class="overflow-x-auto -webkit-overflow-scrolling-touch">
                <!-- Scroll hint label (mobile only) -->
                <div class="flex items-center gap-1.5 px-4 pt-3 pb-1 sm:hidden">
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12M8 12h8m-8 5h4"/></svg>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Scroll to see more</span>
                    <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>

                <table class="w-full text-left border-collapse" style="min-width: 750px;">
                    <thead>
                        <tr class="bg-gray-50/60">
                            <th class="px-4 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Transaction ID</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Date/Time</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Rider</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Driver</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Type</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Amount</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Method</th>
                            <th class="px-3 py-3.5 text-[9px] font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 whitespace-nowrap">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs">
                        @foreach([
                            ['id' => 'TXN-2458', 'date' => '2026-04-08 10:30 AM', 'rider' => 'Ali Hassan', 'driver' => 'Ahmed Khan', 'type' => 'Payment', 'amount' => 'PKR 450', 'method' => 'Card', 'status' => 'Completed', 'color' => 'green', 'type_color' => 'blue'],
                            ['id' => 'TXN-2457', 'date' => '2026-04-08 10:15 AM', 'rider' => 'Zara Malik', 'driver' => 'Sara Ali', 'type' => 'Payment', 'amount' => 'PKR 1,200', 'method' => 'Wallet', 'status' => 'Completed', 'color' => 'green', 'type_color' => 'blue'],
                            ['id' => 'TXN-2456', 'date' => '2026-04-08 10:00 AM', 'rider' => 'Hassan Raza', 'driver' => '-', 'type' => 'Refund', 'amount' => 'PKR 150', 'method' => 'Wallet', 'status' => 'Completed', 'color' => 'green', 'type_color' => 'orange'],
                            ['id' => 'TXN-2455', 'date' => '2026-04-08 09:45 AM', 'rider' => 'Ayesha Khan', 'driver' => 'Usman Shah', 'type' => 'Payment', 'amount' => 'PKR 290', 'method' => 'Card', 'status' => 'Failed', 'color' => 'red', 'type_color' => 'blue'],
                            ['id' => 'TXN-2454', 'date' => '2026-04-08 09:30 AM', 'rider' => 'Farhan Ali', 'driver' => '-', 'type' => 'Wallet Top-up', 'amount' => 'PKR 5,000', 'method' => 'Bank Transfer', 'status' => 'Completed', 'color' => 'green', 'type_color' => 'gray'],
                            ['id' => 'TXN-2453', 'date' => '2026-04-08 09:15 AM', 'rider' => 'Sana Ahmed', 'driver' => '-', 'type' => 'Promo Credit', 'amount' => 'PKR 100', 'method' => 'Promo', 'status' => 'Completed', 'color' => 'green', 'type_color' => 'green'],
                        ] as $txn)
                        <tr class="hover:bg-blue-50/20 transition-colors">
                            <td class="px-4 py-3 font-bold text-[#1C69D4] whitespace-nowrap">{{ $txn['id'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $txn['date'] }}</td>
                            <td class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap">{{ $txn['rider'] }}</td>
                            <td class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap">{{ $txn['driver'] }}</td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest bg-{{ $txn['type_color'] }}-50 text-{{ $txn['type_color'] }}-600 rounded-lg">{{ $txn['type'] }}</span>
                            </td>
                            <td class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap">{{ $txn['amount'] }}</td>
                            <td class="px-3 py-3 text-gray-500 font-medium whitespace-nowrap">{{ $txn['method'] }}</td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest bg-{{ $txn['color'] }}-50 text-{{ $txn['color'] }}-600 rounded-lg">{{ $txn['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="p-4 sm:p-6 border-t border-gray-50 flex flex-wrap items-center justify-between gap-3">
                <p class="text-[13px] font-bold text-gray-400">Showing 6 entries</p>
                <div class="flex items-center gap-1">
                    <button class="px-3 sm:px-4 py-2 text-sm font-bold text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">Previous</button>
                    <button class="w-9 h-9 sm:w-10 sm:h-10 bg-[#1C69D4] text-white rounded-xl text-sm font-bold shadow-md shadow-[#1C69D4]/20 border border-[#1C69D4]">1</button>
                    <button class="w-9 h-9 sm:w-10 sm:h-10 text-gray-600 hover:bg-gray-100 rounded-xl text-sm font-bold transition-all">2</button>
                    <button class="px-3 sm:px-4 py-2 text-sm font-bold text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all border-l border-gray-50">Next</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>