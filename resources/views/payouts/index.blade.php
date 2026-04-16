<x-app-layout>
    <x-slot name="header">
        Payouts
    </x-slot>

    @php
        $payouts = [
            ['id' => 1, 'name' => 'Ahmed Khan', 'initials' => 'AK', 'account' => '****8901', 'amount' => 'PKR 28,500', 'rides' => '145 rides', 'date' => '2026-04-07', 'status' => 'Pending', 'color' => 'orange'],
            ['id' => 2, 'name' => 'Sara Ali', 'initials' => 'SA', 'account' => '****7823', 'amount' => 'PKR 24,500', 'rides' => '128 rides', 'date' => '2026-04-07', 'status' => 'Pending', 'color' => 'orange'],
            ['id' => 3, 'name' => 'Bilal Ahmed', 'initials' => 'BA', 'account' => '****5612', 'amount' => 'PKR 19,800', 'rides' => '98 rides', 'date' => '2026-04-07', 'status' => 'Approved', 'color' => 'green'],
            ['id' => 4, 'name' => 'Fatima Malik', 'initials' => 'FM', 'account' => '****4231', 'amount' => 'PKR 31,200', 'rides' => '156 rides', 'date' => '2026-04-06', 'status' => 'Approved', 'color' => 'green'],
            ['id' => 5, 'name' => 'Usman Shah', 'initials' => 'US', 'account' => '****9087', 'amount' => 'PKR 7,800', 'rides' => '45 rides', 'date' => '2026-04-07', 'status' => 'Rejected', 'color' => 'red'],
        ];

        $currentStatus = $status ?? 'pending';
        $filteredPayouts = array_filter($payouts, function($p) use ($currentStatus) {
            if ($currentStatus === 'all') return true;
            if ($currentStatus === 'processed') return in_array($p['status'], ['Approved', 'Rejected']);
            return strtolower($p['status']) === strtolower($currentStatus);
        });

        $counts = [
            'pending' => count(array_filter($payouts, fn($p) => $p['status'] === 'Pending')),
            'processed' => count(array_filter($payouts, fn($p) => in_array($p['status'], ['Approved', 'Rejected']))),
            'all' => count($payouts),
        ];
    @endphp

    <div class="space-y-4 sm:space-y-6 px-2 sm:px-0" x-data="{
        selectAll: false,
        selected: [],
        ids: [1, 2, 3, 4, 5],
        toggleAll() {
            this.selectAll ? this.selected = [...this.ids] : this.selected = [];
        },
        toggleRow(id) {
            this.selected.includes(id)
                ? this.selected = this.selected.filter(i => i !== id)
                : this.selected.push(id);
            this.selectAll = this.selected.length === this.ids.length;
        }
    }">
        <!-- Payout Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-6">
            <!-- Total Pending -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center sm:flex-col sm:items-start justify-between sm:justify-between border-l-[6px] border-l-orange-400 h-20 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Total Pending Amount</p>
                    <p class="text-xl sm:text-2xl font-black text-orange-500 mt-0.5 sm:mt-1">PKR 52,300</p>
                </div>
                <span class="sm:hidden px-2 py-1 bg-orange-50 text-orange-500 rounded-lg text-[9px] font-black uppercase tracking-widest">Pending</span>
            </div>

            <!-- Total Paid -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center sm:flex-col sm:items-start justify-between sm:justify-between border-l-[6px] border-l-green-500 h-20 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Total Paid This Month</p>
                    <p class="text-xl sm:text-2xl font-black text-green-600 mt-0.5 sm:mt-1">PKR 2.1M</p>
                </div>
                <span class="sm:hidden px-2 py-1 bg-green-50 text-green-600 rounded-lg text-[9px] font-black uppercase tracking-widest">This Month</span>
            </div>

            <!-- Drivers Awaiting -->
            <div class="bg-white p-4 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center sm:flex-col sm:items-start justify-between sm:justify-between border-l-[6px] border-l-blue-400 h-20 sm:h-32">
                <div>
                    <p class="text-[10px] sm:text-[11px] font-bold text-gray-400 uppercase tracking-tight">Drivers Awaiting Payout</p>
                    <p class="text-xl sm:text-2xl font-black text-blue-500 mt-0.5 sm:mt-1">24</p>
                </div>
                <span class="sm:hidden px-2 py-1 bg-blue-50 text-blue-500 rounded-lg text-[9px] font-black uppercase tracking-widest">Awaiting</span>
            </div>
        </div>

        <!-- Payout Content Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- Tabs — scrollable on mobile -->
            <div class="flex border-b border-gray-100 px-2 sm:px-6 overflow-x-auto scrollbar-none">
                <a href="{{ route('payouts.index', ['status' => 'pending']) }}"
                   class="px-4 sm:px-6 py-4 text-xs sm:text-sm font-bold transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'pending' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Pending ({{ $counts['pending'] }})
                </a>
                <a href="{{ route('payouts.index', ['status' => 'processed']) }}"
                   class="px-4 sm:px-6 py-4 text-xs sm:text-sm font-bold transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'processed' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Processed
                </a>
                <a href="{{ route('payouts.index', ['status' => 'all']) }}"
                   class="px-4 sm:px-6 py-4 text-xs sm:text-sm font-bold transition-all border-b-2 whitespace-nowrap {{ $currentStatus === 'all' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    All
                </a>
            </div>

            <!-- Table Header Actions -->
            <div class="p-4 sm:p-6 flex items-center justify-between gap-3">
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-gray-800">Payout Requests</h3>
                    <p class="text-xs font-semibold text-gray-400 mt-0.5"
                       x-show="selected.length > 0"
                       x-text="selected.length + ' driver(s) selected'"></p>
                </div>
                <button class="px-4 sm:px-6 py-2.5 bg-[#00A651] text-white font-bold rounded-xl hover:bg-green-700 transition-all text-xs sm:text-sm shadow-md shadow-green-600/20 active:scale-95 whitespace-nowrap"
                        :class="selected.length === 0 ? 'opacity-50 cursor-not-allowed' : ''"
                        :disabled="selected.length === 0">
                    Batch Approve
                    <span x-show="selected.length > 0" x-text="'(' + selected.length + ')'"></span>
                </button>
            </div>

            <!-- ─── DESKTOP TABLE (hidden on mobile) ─── -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full text-left border-collapse" style="min-width: 750px;">
                    <thead>
                        <tr class="bg-gray-50/60 text-[9px] text-gray-400 font-black uppercase tracking-widest border-b border-gray-100">
                            <th class="px-5 py-3.5 w-10">
                                <input type="checkbox" x-model="selectAll" @change="toggleAll()"
                                       class="w-3.5 h-3.5 rounded border-gray-300 text-[#1C69D4] focus:ring-[#1C69D4] cursor-pointer">
                            </th>
                            <th class="px-3 py-3.5">Driver</th>
                            <th class="px-3 py-3.5 text-center">Account</th>
                            <th class="px-3 py-3.5 text-center">Amount</th>
                            <th class="px-3 py-3.5 text-center">Rides</th>
                            <th class="px-3 py-3.5 text-center">Date</th>
                            <th class="px-3 py-3.5 text-center">Status</th>
                            <th class="px-3 py-3.5 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs font-medium">
                        @foreach($filteredPayouts as $p)
                        <tr class="transition-colors"
                            :class="selected.includes({{ $p['id'] }}) ? 'bg-blue-50/30' : 'hover:bg-blue-50/10'">
                            <td class="px-5 py-3">
                                <input type="checkbox"
                                       :checked="selected.includes({{ $p['id'] }})"
                                       @change="toggleRow({{ $p['id'] }})"
                                       class="w-3.5 h-3.5 rounded border-gray-300 text-[#1C69D4] focus:ring-[#1C69D4] cursor-pointer">
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-black text-[10px] border border-blue-100 uppercase shrink-0">{{ $p['initials'] }}</div>
                                    <span class="font-black text-gray-900 text-xs tracking-tight">{{ $p['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-center text-gray-500 font-mono tracking-widest">{{ $p['account'] }}</td>
                            <td class="px-3 py-3 text-center font-black text-green-600">{{ $p['amount'] }}</td>
                            <td class="px-3 py-3 text-center text-gray-500">{{ $p['rides'] }}</td>
                            <td class="px-3 py-3 text-center text-gray-400">{{ $p['date'] }}</td>
                            <td class="px-3 py-3 text-center">
                                <span class="px-2 py-0.5 bg-{{ $p['color'] }}-50 text-{{ $p['color'] }}-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-{{ $p['color'] }}-100">{{ $p['status'] }}</span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex items-center justify-center gap-1.5">
                                    @if($p['status'] === 'Pending')
                                    <button class="w-7 h-7 rounded-lg bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-100 transition-colors" title="Approve">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                    <button class="w-7 h-7 rounded-lg bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-100 transition-colors" title="Reject">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                    @else
                                    <span class="text-[10px] text-gray-400 font-semibold italic">Handled</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ─── MOBILE CARDS (shown only on mobile) ─── -->
            <div class="sm:hidden divide-y divide-gray-50">
                @foreach($filteredPayouts as $p)
                <div class="p-4 transition-colors"
                     :class="selected.includes({{ $p['id'] }}) ? 'bg-blue-50/40' : 'hover:bg-gray-50/50'">
                    <!-- Card Top Row: Checkbox + Avatar + Name + Status -->
                    <div class="flex items-center gap-3">
                        <input type="checkbox"
                               :checked="selected.includes({{ $p['id'] }})"
                               @change="toggleRow({{ $p['id'] }})"
                               class="w-4 h-4 rounded border-gray-300 text-[#1C69D4] focus:ring-[#1C69D4] cursor-pointer shrink-0">

                        <div class="w-9 h-9 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-black text-[11px] border border-blue-100 uppercase shrink-0">{{ $p['initials'] }}</div>

                        <div class="flex-1 min-w-0">
                            <p class="font-black text-gray-900 text-sm tracking-tight truncate">{{ $p['name'] }}</p>
                            <p class="text-[10px] text-gray-400 font-mono tracking-widest">{{ $p['account'] }}</p>
                        </div>

                        <span class="px-2 py-0.5 bg-{{ $p['color'] }}-50 text-{{ $p['color'] }}-600 rounded-lg text-[9px] font-black uppercase tracking-widest border border-{{ $p['color'] }}-100 shrink-0">{{ $p['status'] }}</span>
                    </div>

                    <!-- Card Details Grid -->
                    <div class="mt-3 grid grid-cols-3 gap-2 pl-12">
                        <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Amount</p>
                            <p class="text-xs font-black text-green-600 mt-0.5">{{ $p['amount'] }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Rides</p>
                            <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $p['rides'] }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Date</p>
                            <p class="text-xs font-bold text-gray-700 mt-0.5">{{ $p['date'] }}</p>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    @if($p['status'] === 'Pending')
                    <div class="mt-3 pl-12 flex gap-2">
                        <button class="flex-1 py-2 rounded-xl bg-green-50 text-green-600 text-xs font-black hover:bg-green-100 transition-colors flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Approve
                        </button>
                        <button class="flex-1 py-2 rounded-xl bg-red-50 text-red-500 text-xs font-black hover:bg-red-100 transition-colors flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Reject
                        </button>
                    </div>
                    @else
                    <div class="mt-3 pl-12">
                        <span class="text-[11px] text-gray-400 font-semibold italic">Already handled</span>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Footer -->
            <div class="p-4 sm:p-6 border-t border-gray-50 flex flex-wrap items-center justify-between gap-3">
                <p class="text-[13px] font-bold text-gray-400">Showing {{ count($filteredPayouts) }} entries</p>
                <div class="flex items-center gap-1">
                    <button class="px-3 sm:px-4 py-2 text-sm font-bold text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">Previous</button>
                    <button class="w-9 h-9 sm:w-10 sm:h-10 bg-[#1C69D4] text-white rounded-xl text-sm font-bold shadow-md shadow-[#1C69D4]/20">1</button>
                    <button class="w-9 h-9 sm:w-10 sm:h-10 text-gray-600 hover:bg-gray-100 rounded-xl text-sm font-bold">2</button>
                    <button class="px-3 sm:px-4 py-2 text-sm font-bold text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all">Next</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>