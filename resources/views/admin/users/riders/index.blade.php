@extends('layouts.app')

@section('title', 'Riders')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between w-full mb-6">
        <h2 class="text-2xl font-black text-gray-900 tracking-tight">Riders</h2>
    </div>

    <div class="space-y-4 px-2 sm:px-0" x-data="{
        selectedRider: null,
        drawerOpen: false,
        activeTab: 'overview',
        editOpen: false,
        editData: null,
        selectAll: false,
        selected: [],
        riders: @json($riders->pluck('id')->toArray()),
        toggleAll() { this.selectAll ? this.selected = [...this.riders] : this.selected = []; },
        toggleRow(id) {
            this.selected.includes(id) ? this.selected = this.selected.filter(n => n !== id) : this.selected.push(id);
            this.selectAll = this.selected.length === this.riders.length;
        }
    }">

        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 sm:p-4">
            <div class="flex flex-col gap-3">
                <!-- Search Row -->
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-4 py-2.5 text-sm font-medium text-gray-900 border border-gray-100 rounded-xl bg-gray-50/50 focus:ring-4 focus:ring-[#1C69D4]/5 focus:border-[#1C69D4] focus:outline-none transition-all placeholder-gray-400" placeholder="Search by name, phone, or email...">
                </div>
                <!-- Filters + Export Row -->
                <div class="flex flex-wrap items-center gap-2">
                    <select class="flex-1 min-w-[110px] border border-gray-100 text-xs font-black uppercase tracking-widest text-gray-500 rounded-xl px-3 py-2.5 bg-gray-50/50 outline-none hover:border-blue-200 transition-all focus:ring-4 focus:ring-blue-100 cursor-pointer">
                        <option>All Status</option><option>Active</option><option>Inactive</option><option>Banned</option>
                    </select>
                    <select class="flex-1 min-w-[110px] border border-gray-100 text-xs font-black uppercase tracking-widest text-gray-500 rounded-xl px-3 py-2.5 bg-gray-50/50 outline-none hover:border-blue-200 transition-all focus:ring-4 focus:ring-blue-100 cursor-pointer">
                        <option>All Cities</option><option>Karachi</option><option>Lahore</option><option>Islamabad</option>
                    </select>
                    <button class="flex items-center gap-2 px-4 py-2.5 bg-[#1C69D4] text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Export
                    </button>
                </div>
            </div>
        </div>

        <p class="text-xs font-black text-gray-400 uppercase tracking-widest px-1">Total Riders: <span class="text-gray-700">{{ $riders->count() }}</span></p>

        <!-- Table -->
        <div class="bg-white rounded-2xl sm:rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="w-full overflow-x-auto -webkit-overflow-scrolling-touch">
                <table class="w-full text-left border-collapse" style="min-width:700px;">
                    <thead class="border-b border-gray-100">
                        <tr class="text-[9px] text-gray-400 font-black uppercase tracking-[0.12em] bg-gray-50/60">
                            <th class="px-4 py-3.5 w-10">
                                <input type="checkbox" x-model="selectAll" @change="toggleAll()" class="w-3.5 h-3.5 text-[#1C69D4] bg-white border-gray-300 rounded focus:ring-[#1C69D4] cursor-pointer">
                            </th>
                            <th class="px-3 py-3.5">Rider</th>
                            <th class="px-3 py-3.5">Phone</th>
                            <th class="px-3 py-3.5">City</th>
                            <th class="px-3 py-3.5">Rides</th>
                            <th class="px-3 py-3.5">Wallet</th>
                            <th class="px-3 py-3.5">Status</th>
                            <th class="px-4 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($riders as $rider)
                        <tr class="hover:bg-blue-50/10 transition-colors group" :class="selected.includes({{ $rider->id }}) ? 'bg-blue-50/20' : ''">
                            <td class="px-4 py-3">
                                <input type="checkbox" :checked="selected.includes({{ $rider->id }})" @change="toggleRow({{ $rider->id }})" class="w-3.5 h-3.5 text-[#1C69D4] bg-white border-gray-300 rounded focus:ring-[#1C69D4] cursor-pointer">
                            </td>
                            <td class="px-3 py-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-black text-[10px] border border-blue-100 uppercase shrink-0">
                                        {{ substr($rider->name, 0, 2) }}
                                    </div>
                                    <div class="min-w-0">
                                        <span class="font-black text-gray-900 text-xs tracking-tight block truncate max-w-[120px]">{{ $rider->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-medium block truncate max-w-[120px]">{{ $rider->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-xs font-semibold text-gray-500 whitespace-nowrap">{{ $rider->mobile_number }}</td>
                            <td class="px-3 py-3 text-xs font-bold text-gray-700 whitespace-nowrap">Karachi</td>
                            <td class="px-3 py-3 text-xs font-black text-gray-900">{{ $rider->total_trips }}</td>
                            <td class="px-3 py-3 text-xs font-black text-green-600 whitespace-nowrap">PKR {{ $rider->wallet_balance }}</td>
                            <td class="px-3 py-3">
                                <span id="rider-status-{{ $rider->id }}" class="inline-flex px-2 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-full {{ $rider->status === 'banned' ? 'bg-red-50 text-red-600 border border-red-100' : 'bg-green-50 text-green-600 border border-green-100' }}">
                                    {{ $rider->status === 'banned' ? 'Banned' : 'Active' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex justify-end gap-1">
                                    <!-- Always visible on mobile, hover on desktop -->
                                    <button @click="selectedRider = {{ json_encode($rider->load('statistics')) }}; drawerOpen = true; activeTab = 'overview'"
                                            class="w-7 h-7 flex items-center justify-center text-[#1C69D4] hover:bg-blue-50 rounded-lg transition-all" title="View Profile">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    <button @click="editData = {{ json_encode($rider->load('statistics')) }}; editOpen = true"
                                            class="w-7 h-7 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-50 rounded-lg transition-all" title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button onclick="toggleRiderBan({{ $rider->id }}, '{{ $rider->status }}', this)"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg transition-all {{ $rider->status === 'banned' ? 'text-green-500 hover:text-green-600 hover:bg-green-50' : 'text-red-300 hover:text-red-600 hover:bg-red-50' }}"
                                            title="{{ $rider->status === 'banned' ? 'Unban' : 'Ban' }}">
                                        @if($rider->status === 'banned')
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        @else
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                        @endif
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-4 sm:px-6 py-4 border-t border-gray-50 flex flex-col sm:flex-row items-center justify-between gap-3 bg-white">
                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Showing 1 to {{ $riders->count() }} of {{ $riders->count() }} entries</p>
                <div class="flex items-center gap-2">
                    <button class="px-4 py-2 text-[10px] font-black text-gray-400 uppercase tracking-widest bg-white border border-gray-100 rounded-xl shadow-sm" disabled>Previous</button>
                    <button class="w-9 h-9 text-[11px] font-black text-white bg-[#1C69D4] rounded-xl shadow-lg shadow-blue-200">1</button>
                    <button class="px-4 py-2 text-[10px] font-black text-gray-400 uppercase tracking-widest bg-white border border-gray-100 rounded-xl shadow-sm" disabled>Next</button>
                </div>
            </div>
        </div>

        <!-- ===== Rider Profile Side Drawer ===== -->
        <div class="fixed inset-0 z-[60] overflow-hidden" x-show="drawerOpen" x-cloak @keydown.escape.window="drawerOpen = false">
            <!-- Backdrop -->
            <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px]"
                 x-show="drawerOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="drawerOpen = false"></div>

            <!-- Panel — full width on mobile, max-md on larger screens -->
            <div class="absolute inset-y-0 right-0 w-full sm:max-w-md bg-white shadow-2xl flex flex-col"
                 x-show="drawerOpen"
                 x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                 x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0">

                <!-- Header -->
                <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between shrink-0">
                    <h3 class="text-base sm:text-lg font-black text-gray-900 tracking-tight">Rider Profile</h3>
                    <button @click="drawerOpen = false" class="p-2 hover:bg-gray-100 rounded-xl transition-colors text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Scrollable Body -->
                <div class="flex-1 overflow-y-auto overscroll-contain">
                    <template x-if="selectedRider">
                        <div>
                            <!-- Hero -->
                            <div class="flex flex-col items-center pt-6 pb-5 px-4 sm:px-6 bg-white">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center text-xl sm:text-2xl font-black border-2 border-blue-100 shadow-lg" x-text="selectedRider.full_name ? selectedRider.full_name.substring(0, 2).toUpperCase() : ''"></div>
                                <h4 class="text-lg sm:text-xl font-black text-gray-900 mt-3 tracking-tight text-center" x-text="selectedRider.full_name"></h4>
                                <div class="flex items-center gap-1 mt-2">
                                    <template x-for="i in 5" :key="i">
                                        <svg class="w-3.5 h-3.5 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    </template>
                                    <span class="text-xs font-bold text-gray-400 ml-1.5" x-text="(selectedRider.statistics?.average_rating || 0) + ' rating'"></span>
                                </div>
                                <p class="text-[11px] font-bold text-gray-400 mt-1" x-text="'Member since ' + (selectedRider.created_at ? new Date(selectedRider.created_at).toLocaleDateString() : '')"></p>
                            </div>

                            <!-- Tabs — scrollable on very small screens -->
                            <div class="flex border-b border-gray-100 bg-white sticky top-0 z-10 overflow-x-auto">
                                <button @click="activeTab = 'overview'"
                                        :class="activeTab === 'overview' ? 'text-[#1C69D4] border-b-2 border-[#1C69D4]' : 'text-gray-400 border-b-2 border-transparent hover:text-gray-600'"
                                        class="flex-1 min-w-[70px] py-3 text-[9px] sm:text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap px-1">Overview</button>
                                <button @click="activeTab = 'rides'"
                                        :class="activeTab === 'rides' ? 'text-[#1C69D4] border-b-2 border-[#1C69D4]' : 'text-gray-400 border-b-2 border-transparent hover:text-gray-600'"
                                        class="flex-1 min-w-[70px] py-3 text-[9px] sm:text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap px-1">Rides</button>
                                <button @click="activeTab = 'wallet'"
                                        :class="activeTab === 'wallet' ? 'text-[#1C69D4] border-b-2 border-[#1C69D4]' : 'text-gray-400 border-b-2 border-transparent hover:text-gray-600'"
                                        class="flex-1 min-w-[70px] py-3 text-[9px] sm:text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap px-1">Wallet</button>
                                <button @click="activeTab = 'grievances'"
                                        :class="activeTab === 'grievances' ? 'text-[#1C69D4] border-b-2 border-[#1C69D4]' : 'text-gray-400 border-b-2 border-transparent hover:text-gray-600'"
                                        class="flex-1 min-w-[70px] py-3 text-[9px] sm:text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap px-1">Issues</button>
                            </div>

                            <!-- Tab Content -->
                            <div class="p-4 sm:p-6 space-y-4">

                                <!-- ── Overview ── -->
                                <div x-show="activeTab === 'overview'" class="space-y-5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="space-y-3">
                                        <div class="flex items-start gap-2 py-2 border-b border-gray-50">
                                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest w-16 shrink-0 mt-0.5">Phone</span>
                                            <span class="text-sm font-black text-gray-900" x-text="selectedRider.mobile_number"></span>
                                        </div>
                                        <div class="flex items-start gap-2 py-2 border-b border-gray-50">
                                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest w-16 shrink-0 mt-0.5">Email</span>
                                            <span class="text-sm font-black text-gray-900 break-all" x-text="selectedRider.email"></span>
                                        </div>
                                        <div class="flex items-start gap-2 py-2 border-b border-gray-50">
                                            <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest w-16 shrink-0 mt-0.5">City</span>
                                            <span class="text-sm font-black text-gray-900" x-text="selectedRider.city"></span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-2 gap-3">
                                        <div class="p-4 bg-gray-50/70 border border-gray-100 rounded-2xl">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Rides</p>
                                            <p class="text-2xl font-black text-gray-900 mt-1.5" x-text="selectedRider.statistics?.total_trips || 0"></p>
                                        </div>
                                        <div class="p-4 bg-gray-50/70 border border-gray-100 rounded-2xl">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Spent</p>
                                            <p class="text-xl font-black text-green-600 mt-1.5" x-text="'PKR ' + (selectedRider.statistics?.total_spent || 0)"></p>
                                        </div>
                                    </div>

                                    <div class="space-y-2.5 pt-1">
                                        <button class="w-full py-3 bg-[#1C69D4] text-white font-black text-xs rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all uppercase tracking-widest">
                                            Add Credit to Wallet
                                        </button>
                                        <button class="w-full py-3 bg-white border border-gray-200 text-gray-700 font-black text-xs rounded-xl hover:bg-gray-50 transition-all uppercase tracking-widest">
                                            View All Rides
                                        </button>
                                        <button class="w-full py-3 bg-white border border-red-100 text-red-500 font-black text-xs rounded-xl hover:bg-red-50 transition-all uppercase tracking-widest">
                                            Deactivate Account
                                        </button>
                                    </div>
                                </div>

                                <!-- ── Rides ── -->
                                <div x-show="activeTab === 'rides'" class="space-y-3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                                    @foreach([
                                        ['id'=>'RD-1245','date'=>'2026-04-08 10:30 AM','from'=>'Clifton','to'=>'Saddar',  'fare'=>'PKR 450', 'status'=>'Completed'],
                                        ['id'=>'RD-1198','date'=>'2026-04-07 08:15 PM','from'=>'DHA',    'to'=>'Airport', 'fare'=>'PKR 1200','status'=>'Completed'],
                                        ['id'=>'RD-1156','date'=>'2026-04-06 02:45 PM','from'=>'Gulshan','to'=>'Clifton', 'fare'=>'PKR 320', 'status'=>'Cancelled'],
                                        ['id'=>'RD-1103','date'=>'2026-04-05 11:00 AM','from'=>'Johar',  'to'=>'Gulberg', 'fare'=>'PKR 780', 'status'=>'Completed'],
                                    ] as $ride)
                                    <div class="p-4 bg-white border border-gray-100 rounded-2xl hover:border-blue-100 transition-all">
                                        <div class="flex items-start justify-between mb-1.5">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $ride['id'] }}</p>
                                            <span class="px-2 py-0.5 text-[8px] font-black uppercase tracking-widest rounded-full {{ $ride['status'] === 'Completed' ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-red-50 text-red-500 border border-red-100' }}">{{ $ride['status'] }}</span>
                                        </div>
                                        <p class="text-[10px] font-semibold text-gray-400">{{ $ride['date'] }}</p>
                                        <p class="text-sm font-black text-gray-900 mt-1">{{ $ride['from'] }} &rarr; {{ $ride['to'] }}</p>
                                        <p class="text-sm font-black text-green-600 mt-1">{{ $ride['fare'] }}</p>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- ── Wallet ── -->
                                <div x-show="activeTab === 'wallet'" class="space-y-3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="p-5 bg-[#1C69D4] rounded-2xl shadow-lg shadow-blue-200">
                                        <p class="text-xs font-black text-blue-200 uppercase tracking-widest">Current Balance</p>
                                        <p class="text-3xl font-black text-white mt-2" x-text="'PKR ' + (selectedRider.statistics?.wallet_balance || 0)"></p>
                                    </div>
                                    <div class="space-y-2 pt-1">
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest px-1">Recent Transactions</p>
                                        @foreach([
                                            ['label'=>'Ride Payment',  'date'=>'2026-04-08 10:30 AM','amount'=>'-PKR 450', 'credit'=>false],
                                            ['label'=>'Wallet Top-up', 'date'=>'2026-04-07 03:15 PM','amount'=>'+PKR 5000','credit'=>true],
                                            ['label'=>'Ride Payment',  'date'=>'2026-04-07 08:15 PM','amount'=>'-PKR 1200','credit'=>false],
                                            ['label'=>'Promo Credit',  'date'=>'2026-04-06 09:00 AM','amount'=>'+PKR 100', 'credit'=>true],
                                        ] as $txn)
                                        <div class="flex items-center justify-between p-4 bg-white border border-gray-100 rounded-2xl hover:border-blue-100 transition-all">
                                            <div>
                                                <p class="text-sm font-black text-gray-900">{{ $txn['label'] }}</p>
                                                <p class="text-[10px] font-semibold text-gray-400 mt-0.5">{{ $txn['date'] }}</p>
                                            </div>
                                            <span class="text-sm font-black {{ $txn['credit'] ? 'text-green-600' : 'text-red-500' }}">{{ $txn['amount'] }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- ── Grievances ── -->
                                <div x-show="activeTab === 'grievances'" class="space-y-3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                                    @foreach([
                                        ['title'=>'Driver was rude',      'date'=>'2026-04-05','desc'=>'Rider reported unprofessional behavior from driver during ride #RD-1156.','status'=>'In Review','resolved'=>false],
                                        ['title'=>'Wrong fare charged',    'date'=>'2026-03-28','desc'=>'Refund of PKR 150 processed.','status'=>'Resolved','resolved'=>true],
                                        ['title'=>'App crashed mid-ride',  'date'=>'2026-03-15','desc'=>'Rider reported the app crashed and they were charged without completing the ride.','status'=>'Resolved','resolved'=>true],
                                    ] as $g)
                                    <div class="p-4 bg-white border {{ $g['resolved'] ? 'border-gray-100' : 'border-orange-100' }} rounded-2xl space-y-2.5">
                                        <div class="flex items-start justify-between gap-2">
                                            <div class="min-w-0">
                                                <p class="text-sm font-black text-gray-900">{{ $g['title'] }}</p>
                                                <p class="text-[10px] font-semibold text-gray-400 mt-0.5">Submitted on {{ $g['date'] }}</p>
                                            </div>
                                            <span class="shrink-0 px-2 py-0.5 text-[8px] font-black uppercase tracking-widest rounded-full {{ $g['resolved'] ? 'bg-green-50 text-green-600 border border-green-100' : 'bg-orange-50 text-orange-500 border border-orange-100' }}">{{ $g['status'] }}</span>
                                        </div>
                                        <p class="text-xs font-medium text-gray-600 leading-relaxed">{{ $g['desc'] }}</p>
                                        @if(!$g['resolved'])
                                        <button class="px-4 py-2 bg-[#1C69D4] text-white text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-blue-700 transition-all shadow-md shadow-blue-100">Resolve Issue</button>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- ===== Edit Rider Modal ===== -->
        <div class="fixed inset-0 z-[70] flex items-end sm:items-center justify-center sm:p-4" x-show="editOpen" x-cloak @keydown.escape.window="editOpen = false">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
                 x-show="editOpen"
                 x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="editOpen = false"></div>

            <!-- Bottom sheet on mobile, centered modal on sm+ -->
            <div class="relative w-full sm:max-w-lg bg-white sm:rounded-[2.5rem] rounded-t-[2rem] shadow-2xl overflow-hidden max-h-[95vh] flex flex-col"
                 x-show="editOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full sm:translate-y-4 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full sm:scale-95">

                <template x-if="editData">
                    <div class="flex flex-col max-h-[95vh]">
                        <!-- Drag handle for mobile -->
                        <div class="flex justify-center pt-3 pb-1 sm:hidden shrink-0">
                            <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
                        </div>

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between px-5 sm:px-6 py-4 border-b border-gray-50 shrink-0">
                            <div>
                                <h3 class="text-base sm:text-lg font-black text-gray-900 tracking-tight">Edit Rider</h3>
                                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest mt-0.5">Editing: <span class="text-[#1C69D4]" x-text="editData.full_name || ''"></span></p>
                            </div>
                            <button @click="editOpen = false" class="text-gray-400 hover:text-gray-900 transition-colors p-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Form — scrollable -->
                        <div class="overflow-y-auto overscroll-contain flex-1 px-5 sm:px-6 py-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Full Name</label>
                                    <input type="text" x-model="editData.full_name" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div>
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Phone</label>
                                    <input type="text" x-model="editData.mobile_number" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Email Address</label>
                                <input type="email" x-model="editData.email" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all">
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">City</label>
                                    <select class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all cursor-pointer">
                                        <option value="Karachi" x-bind:selected="editData.city === 'Karachi'">Karachi</option>
                                        <option value="Lahore" x-bind:selected="editData.city === 'Lahore'">Lahore</option>
                                        <option value="Islamabad" x-bind:selected="editData.city === 'Islamabad'">Islamabad</option>
                                        <option value="Rawalpindi">Rawalpindi</option>
                                        <option value="Faisalabad">Faisalabad</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Account Status</label>
                                    <select class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all cursor-pointer">
                                        <option value="Active" x-bind:selected="editData.status === 'Active'">Active</option>
                                        <option value="Inactive" x-bind:selected="editData.status === 'Inactive'">Inactive</option>
                                        <option value="Banned" x-bind:selected="editData.status === 'Banned'">Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Add Credit to Wallet (PKR)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 pointer-events-none uppercase">PKR</span>
                                    <input type="number" class="w-full pl-12 pr-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all" placeholder="0">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label class="block text-[9px] font-black text-gray-400 uppercase tracking-widest mb-1.5">Admin Notes</label>
                                <textarea rows="2" class="w-full px-3 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-xs font-bold text-gray-900 focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-[#1C69D4] transition-all resize-none" placeholder="Internal notes about this rider..."></textarea>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-5 sm:px-6 py-4 flex gap-3 border-t border-gray-50 bg-white shrink-0 pb-safe">
                            <button @click="editOpen = false" class="flex-1 py-3 bg-white border border-gray-200 text-gray-600 font-black text-[10px] rounded-xl hover:bg-gray-50 transition-all uppercase tracking-widest">Cancel</button>
                            <button class="flex-1 py-3 bg-[#1C69D4] text-white font-black text-[10px] rounded-xl shadow-lg shadow-blue-200 hover:bg-[#1656b0] transition-all uppercase tracking-widest">Save Changes</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] { display: none !important; }
        /* Safe area for notched phones */
        .pb-safe { padding-bottom: max(1rem, env(safe-area-inset-bottom)); }
        /* Smooth scrolling for drawer */
        .overscroll-contain { overscroll-behavior: contain; }
        /* Make table scroll indicator visible on iOS */
        .overflow-x-auto { -webkit-overflow-scrolling: touch; }
    </style>

    <script>
        async function toggleRiderBan(riderId, currentStatus, btn) {
            const newStatus = currentStatus === 'banned' ? 'active' : 'banned';
            const isBanning = newStatus === 'banned';

            try {
                const response = await fetch('/riders/' + riderId + '/status', {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ status: newStatus })
                });

                if (response.ok) {
                    const statusBadge = document.getElementById('rider-status-' + riderId);

                    if (isBanning) {
                        if (statusBadge) {
                            statusBadge.classList.remove('bg-green-50', 'text-green-600', 'border-green-100');
                            statusBadge.classList.add('bg-red-50', 'text-red-600', 'border-red-100');
                            statusBadge.textContent = 'Banned';
                        }
                        btn.classList.remove('text-red-300', 'hover:text-red-600', 'hover:bg-red-50');
                        btn.classList.add('text-green-500', 'hover:text-green-600', 'hover:bg-green-50');
                        btn.title = 'Unban';
                        btn.setAttribute('onclick', `toggleRiderBan(${riderId}, 'banned', this)`);
                        btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    } else {
                        if (statusBadge) {
                            statusBadge.classList.remove('bg-red-50', 'text-red-600', 'border-red-100');
                            statusBadge.classList.add('bg-green-50', 'text-green-600', 'border-green-100');
                            statusBadge.textContent = 'Active';
                        }
                        btn.classList.remove('text-green-500', 'hover:text-green-600', 'hover:bg-green-50');
                        btn.classList.add('text-red-300', 'hover:text-red-600', 'hover:bg-red-50');
                        btn.title = 'Ban';
                        btn.setAttribute('onclick', `toggleRiderBan(${riderId}, 'active', this)`);
                        btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>';
                    }
                }
            } catch (e) {
                console.error('Ban toggle failed:', e);
            }
        }
    </script>
</div>
@endsection