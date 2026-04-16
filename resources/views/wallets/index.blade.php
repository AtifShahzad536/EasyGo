<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Wallets</h2>
    </x-slot>

    @php
        $riderWallets = [
            ['name' => 'Ali Hassan', 'initials' => 'AH', 'balance' => 'PKR 2,500', 'last_tx' => '2026-04-08', 'credited' => 'PKR 15,000', 'debited' => 'PKR 12,500'],
            ['name' => 'Zara Malik', 'initials' => 'ZM', 'balance' => 'PKR 1,200', 'last_tx' => '2026-04-08', 'credited' => 'PKR 8,000', 'debited' => 'PKR 6,800'],
            ['name' => 'Hassan Raza', 'initials' => 'HR', 'balance' => 'PKR 500', 'last_tx' => '2026-04-07', 'credited' => 'PKR 20,000', 'debited' => 'PKR 19,500'],
        ];

        $driverWallets = [
            ['name' => 'Ahmed Khan', 'initials' => 'AK', 'balance' => 'PKR 8,450', 'last_tx' => '2026-04-08', 'credited' => 'PKR 285,000', 'debited' => 'PKR 276,550'],
            ['name' => 'Sara Ali', 'initials' => 'SA', 'balance' => 'PKR 7,820', 'last_tx' => '2026-04-08', 'credited' => 'PKR 245,000', 'debited' => 'PKR 237,180'],
            ['name' => 'Bilal Ahmed', 'initials' => 'BA', 'balance' => 'PKR 3,200', 'last_tx' => '2026-04-07', 'credited' => 'PKR 198,000', 'debited' => 'PKR 194,800'],
        ];

        $currentType = $type ?? 'rider';
        $wallets = $currentType === 'driver' ? $driverWallets : $riderWallets;
    @endphp

    <div class="space-y-6">
        <!-- Main Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Tabs Section -->
            <div class="flex border-b border-gray-100 px-6">
                <a href="{{ route('wallets.index', ['type' => 'rider']) }}" class="px-6 py-5 text-sm font-bold transition-all border-b-2 {{ $currentType === 'rider' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Rider Wallets
                </a>
                <a href="{{ route('wallets.index', ['type' => 'driver']) }}" class="px-6 py-5 text-sm font-bold transition-all border-b-2 {{ $currentType === 'driver' ? 'text-[#1C69D4] border-[#1C69D4]' : 'text-gray-400 border-transparent hover:text-gray-600' }}">
                    Driver Wallets
                </a>
            </div>

            <!-- Toolbar / Search -->
            <div class="p-6">
                <div class="relative max-w-2xl">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                         <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                    </div>
                    <input type="text" class="block w-full pl-11 pr-4 py-2.5 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all" placeholder="Search by name...">
                </div>
            </div>

            <!-- Table Block -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100">User</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100">Current Balance</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100 text-center">Last Transaction</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100 text-center">Total Credited</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100 text-center">Total Debited</th>
                            <th class="px-8 py-4 text-[11px] font-bold text-gray-500 uppercase tracking-tight border-b border-gray-100 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm font-medium">
                        @foreach($wallets as $w)
                        <tr class="hover:bg-blue-50/20 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-bold text-xs border border-blue-100 shadow-sm">{{ $w['initials'] }}</div>
                                    <span class="font-bold text-gray-900 tracking-tight">{{ $w['name'] }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="font-black text-green-600 text-base">{{ $w['balance'] }}</span>
                            </td>
                            <td class="px-8 py-6 text-gray-400 font-bold uppercase text-[10px] tracking-widest">{{ $w['last_tx'] }}</td>
                            <td class="px-8 py-6">
                                <span class="text-green-600/70 font-bold">{{ $w['credited'] }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="text-red-500/70 font-bold">{{ $w['debited'] }}</span>
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex items-center justify-center gap-4">
                                    <button onclick="openAdjustModal('{{ $w['name'] }}', '{{ $w['balance'] }}')" class="px-4 py-2 bg-[#33A1FF] text-white font-bold text-xs rounded-md shadow-sm hover:bg-[#1C69D4] transition-all active:scale-95">
                                        Adjust Balance
                                    </button>
                                    <button class="text-gray-400 hover:text-gray-600 transition-all" title="View History">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            <div class="p-8 border-t border-gray-50 flex flex-wrap items-center justify-between gap-4">
                <p class="text-[13px] font-bold text-gray-400">Showing 3 entries</p>
                <div class="flex items-center gap-1">
                    <button class="px-5 py-2.5 text-xs font-black text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all uppercase tracking-widest">Previous</button>
                    <button class="w-10 h-10 bg-[#1C69D4] text-white rounded-lg text-xs font-black shadow-lg shadow-[#1C69D4]/20">1</button>
                    <button class="w-10 h-10 text-gray-600 hover:bg-gray-100 rounded-lg text-xs font-black transition-all">2</button>
                    <button class="px-5 py-2.5 text-xs font-black text-gray-400 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-all uppercase tracking-widest">Next</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Modal Partial -->
    @include('wallets.partials.adjust-balance-modal')

</x-app-layout>
