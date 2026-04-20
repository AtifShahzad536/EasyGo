@extends('layouts.app')

@section('title', 'Promotions')

@section('content')

    @php
        $activePromos = [
            ['name' => 'New User Welcome', 'discount' => '50% off', 'usage' => '245/500', 'usage_p' => 49, 'expiry' => '2026-05-31', 'status' => 'Active'],
            ['name' => 'Weekend Rides', 'discount' => 'PKR 100 off', 'usage' => '89/200', 'usage_p' => 44.5, 'expiry' => '2026-04-30', 'status' => 'Active'],
            ['name' => 'Carpool Special', 'discount' => '30% off', 'usage' => '156/300', 'usage_p' => 52, 'expiry' => '2026-06-15', 'status' => 'Active'],
        ];
        $allPromos = [
            ['id'=>1,'name'=>'New User Welcome','code'=>'WELCOME50', 'discount'=>'50%',    'usage'=>'245/500','period'=>'2026-04-01 TO 2026-05-31','status'=>'Active',  'color'=>'green'],
            ['id'=>2,'name'=>'Weekend Rides',   'code'=>'WEEKEND100','discount'=>'PKR 100','usage'=>'89/200', 'period'=>'2026-04-01 TO 2026-04-30','status'=>'Active',  'color'=>'green'],
            ['id'=>3,'name'=>'Carpool Special', 'code'=>'CARPOOL30', 'discount'=>'30%',    'usage'=>'156/300','period'=>'2026-04-01 TO 2026-06-15','status'=>'Active',  'color'=>'green'],
            ['id'=>4,'name'=>'Eid Mega Sale',   'code'=>'EID2026',   'discount'=>'40%',    'usage'=>'0/1000', 'period'=>'2026-04-15 TO 2026-04-20','status'=>'Draft',   'color'=>'gray'],
            ['id'=>5,'name'=>'Summer Promo',    'code'=>'SUMMER25',  'discount'=>'25%',    'usage'=>'500/500','period'=>'2025-06-01 TO 2025-08-31','status'=>'Expired', 'color'=>'red'],
        ];
    @endphp

    <div class="space-y-6 sm:space-y-8 pb-10 mt-4 sm:mt-6 px-2 sm:px-0" x-data="{
        editOpen: false,
        editData: null,
        deleteOpen: false,
        deleteData: null,
        promos: {{ json_encode($allPromos) }},
        openEdit(promo) { this.editData = { ...promo }; this.editOpen = true; },
        toggleStatus(id) {
            this.promos = this.promos.map(p => {
                if (p.id === id) {
                    if (p.status === 'Active') { p.status = 'Paused'; p.color = 'orange'; }
                    else if (p.status === 'Paused') { p.status = 'Active'; p.color = 'green'; }
                }
                return p;
            });
        },
        confirmDelete(promo) { this.deleteData = promo; this.deleteOpen = true; },
        deletePromo() {
            if (this.deleteData) { this.promos = this.promos.filter(p => p.id !== this.deleteData.id); }
            this.deleteOpen = false; this.deleteData = null;
        }
    }">

        <!-- ── Active Promotions Cards ── -->
        <div class="space-y-4 sm:space-y-5">
            <h3 class="text-lg sm:text-xl font-black text-gray-800 tracking-tight">Active Promotions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($activePromos as $promo)
                <div class="bg-white p-5 sm:p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between group hover:shadow-md transition-all border-l-4 border-l-green-500 relative overflow-hidden h-auto sm:h-[180px]">
                    <div class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity pointer-events-none">
                        <svg class="w-24 h-24 text-gray-400 -mr-8 -mt-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12.75 3.75a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5zM12.75 18.75a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5zM4.5 12a.75.75 0 000-1.5h-1.5a.75.75 0 000 1.5h1.5zM21 12a.75.75 0 000-1.5h-1.5a.75.75 0 000 1.5h1.5z"/></svg>
                    </div>
                    <div class="relative z-10 flex justify-between items-start">
                        <h4 class="font-black text-gray-900 text-base sm:text-lg tracking-tight">{{ $promo['name'] }}</h4>
                        <span class="px-2.5 py-1 bg-green-50 text-green-600 font-black text-[9px] uppercase tracking-widest rounded-lg border border-green-100 shrink-0 ml-2">{{ $promo['status'] }}</span>
                    </div>
                    <div class="relative z-10 mt-3 sm:mt-4">
                        <p class="text-2xl sm:text-3xl font-black text-[#1C69D4] tracking-tighter">{{ $promo['discount'] }}</p>
                        <div class="mt-3 sm:mt-4 flex flex-col gap-1.5">
                            <div class="flex items-center justify-between text-[10px] font-black text-gray-400 uppercase tracking-widest">
                                <span>Usage: {{ $promo['usage'] }}</span>
                                <span>Expires: {{ $promo['expiry'] }}</span>
                            </div>
                            <div class="w-full h-1.5 bg-gray-50 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500 rounded-full transition-all duration-1000" style="width: {{ $promo['usage_p'] }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ── All Promotions ── -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-base sm:text-lg font-black text-gray-800 tracking-tight">All Promotions</h3>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest" x-text="promos.length + ' promos'"></span>
            </div>

            <!-- ─── DESKTOP TABLE (hidden on mobile) ─── -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="w-full text-left border-collapse" style="min-width:800px;">
                    <thead class="bg-gray-50/60 border-b border-gray-100">
                        <tr class="text-[9px] text-gray-400 font-black uppercase tracking-widest">
                            <th class="px-4 py-3.5">Promo Name</th>
                            <th class="px-3 py-3.5">Code</th>
                            <th class="px-3 py-3.5">Discount</th>
                            <th class="px-3 py-3.5">Usage</th>
                            <th class="px-3 py-3.5 text-center">Valid Period</th>
                            <th class="px-3 py-3.5 text-center">Status</th>
                            <th class="px-3 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs">
                        <template x-for="p in promos" :key="p.id">
                            <tr class="hover:bg-blue-50/10 transition-colors group">
                                <td class="px-4 py-3 font-black text-gray-900 tracking-tight" x-text="p.name"></td>
                                <td class="px-3 py-3">
                                    <span class="text-[#1C69D4] font-black uppercase tracking-widest text-[10px] bg-blue-50 px-2 py-1 rounded-md border border-blue-100" x-text="p.code"></span>
                                </td>
                                <td class="px-3 py-3 font-bold text-gray-700" x-text="p.discount"></td>
                                <td class="px-3 py-3">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-[10px] font-bold text-gray-400 uppercase" x-text="p.usage + ' used'"></span>
                                        <div class="w-20 h-1 bg-gray-100 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full transition-all"
                                                 :class="p.color === 'red' ? 'bg-red-500' : 'bg-green-500'"
                                                 :style="'width: ' + (parseInt(p.usage.split('/')[1]) > 0 ? (parseInt(p.usage.split('/')[0]) / parseInt(p.usage.split('/')[1]) * 100) : 0) + '%'"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-center text-[10px] font-bold text-gray-400 uppercase tracking-widest" x-text="p.period"></td>
                                <td class="px-3 py-3 text-center">
                                    <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-lg border"
                                          :class="{
                                              'bg-green-50 text-green-600 border-green-100': p.color === 'green',
                                              'bg-orange-50 text-orange-500 border-orange-100': p.color === 'orange',
                                              'bg-gray-100 text-gray-500 border-gray-200': p.color === 'gray',
                                              'bg-red-50 text-red-500 border-red-100': p.color === 'red'
                                          }"
                                          x-text="p.status"></span>
                                </td>
                                <td class="px-3 py-3 text-right">
                                    <div class="flex justify-end items-center gap-1.5">
                                        <button @click="openEdit(p)" class="w-7 h-7 flex items-center justify-center text-[#1C69D4] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100" title="Edit">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </button>
                                        <button @click="toggleStatus(p.id)" x-show="p.status === 'Active' || p.status === 'Paused'"
                                                :title="p.status === 'Active' ? 'Pause' : 'Activate'"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg transition-all border border-transparent"
                                                :class="p.status === 'Active' ? 'text-orange-400 hover:bg-orange-50 hover:border-orange-100' : 'text-green-500 hover:bg-green-50 hover:border-green-100'">
                                            <template x-if="p.status === 'Active'">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6"/></svg>
                                            </template>
                                            <template x-if="p.status === 'Paused'">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            </template>
                                        </button>
                                        <span x-show="p.status !== 'Active' && p.status !== 'Paused'" class="w-7 h-7 flex items-center justify-center text-gray-200 text-lg">—</span>
                                        <button @click="confirmDelete(p)" class="w-7 h-7 flex items-center justify-center text-red-300 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all border border-transparent hover:border-red-100" title="Delete">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <!-- ─── MOBILE CARDS (shown only on mobile) ─── -->
            <div class="sm:hidden divide-y divide-gray-50">
                <template x-for="p in promos" :key="p.id">
                    <div class="p-4 hover:bg-gray-50/50 transition-colors">
                        <!-- Top Row: Name + Status -->
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <p class="font-black text-gray-900 text-sm tracking-tight truncate" x-text="p.name"></p>
                                <span class="inline-block mt-1 text-[#1C69D4] font-black uppercase tracking-widest text-[10px] bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100" x-text="p.code"></span>
                            </div>
                            <span class="px-2 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-lg border shrink-0"
                                  :class="{
                                      'bg-green-50 text-green-600 border-green-100': p.color === 'green',
                                      'bg-orange-50 text-orange-500 border-orange-100': p.color === 'orange',
                                      'bg-gray-100 text-gray-500 border-gray-200': p.color === 'gray',
                                      'bg-red-50 text-red-500 border-red-100': p.color === 'red'
                                  }"
                                  x-text="p.status"></span>
                        </div>

                        <!-- Details Row -->
                        <div class="mt-3 grid grid-cols-3 gap-2">
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Discount</p>
                                <p class="text-xs font-black text-[#1C69D4] mt-0.5" x-text="p.discount"></p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Usage</p>
                                <p class="text-xs font-bold text-gray-700 mt-0.5" x-text="p.usage"></p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center col-span-1">
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Period</p>
                                <p class="text-[9px] font-bold text-gray-500 mt-0.5 leading-tight" x-text="p.period.replace(' TO ', ' – ')"></p>
                            </div>
                        </div>

                        <!-- Usage Progress Bar -->
                        <div class="mt-2.5 w-full h-1.5 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all"
                                 :class="p.color === 'red' ? 'bg-red-400' : 'bg-green-500'"
                                 :style="'width: ' + (parseInt(p.usage.split('/')[1]) > 0 ? (parseInt(p.usage.split('/')[0]) / parseInt(p.usage.split('/')[1]) * 100) : 0) + '%'"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-3 flex gap-2">
                            <button @click="openEdit(p)" class="flex-1 py-2 rounded-xl bg-blue-50 text-[#1C69D4] text-[10px] font-black hover:bg-blue-100 transition-colors flex items-center justify-center gap-1.5 uppercase tracking-widest">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                Edit
                            </button>
                            <template x-if="p.status === 'Active' || p.status === 'Paused'">
                                <button @click="toggleStatus(p.id)"
                                        class="flex-1 py-2 rounded-xl text-[10px] font-black transition-colors flex items-center justify-center gap-1.5 uppercase tracking-widest"
                                        :class="p.status === 'Active' ? 'bg-orange-50 text-orange-500 hover:bg-orange-100' : 'bg-green-50 text-green-600 hover:bg-green-100'"
                                        x-text="p.status === 'Active' ? 'Pause' : 'Activate'">
                                </button>
                            </template>
                            <button @click="confirmDelete(p)" class="flex-1 py-2 rounded-xl bg-red-50 text-red-500 text-[10px] font-black hover:bg-red-100 transition-colors flex items-center justify-center gap-1.5 uppercase tracking-widest">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                Delete
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ── Performance Analytics ── -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-8">
            <!-- Redemptions Chart -->
            <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-6 border border-gray-100 flex flex-col min-h-[280px] sm:min-h-[400px]">
                <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-4 border-b border-gray-50">
                    <svg class="w-5 h-5 text-[#1C69D4] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    <h3 class="text-base sm:text-xl font-black text-gray-800 tracking-tight leading-none">Promo Redemptions</h3>
                </div>
                <div class="flex-1 w-full relative h-[220px] sm:h-[300px]">
                    <canvas id="promoUsageChart"></canvas>
                </div>
            </div>

            <!-- Distribution Chart + Stats -->
            <div class="flex flex-col gap-4 sm:gap-6">
                <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-6 border border-gray-100 flex flex-col min-h-[280px] sm:min-h-[400px]">
                    <div class="flex items-center gap-3 mb-4 sm:mb-6 pb-4 border-b border-gray-50">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/></svg>
                        <h3 class="text-base sm:text-xl font-black text-gray-800 tracking-tight leading-none">Usage Distribution</h3>
                    </div>
                    <div class="flex-1 flex items-center gap-4 sm:gap-8">
                        <div class="w-[120px] h-[120px] sm:w-[180px] sm:h-[180px] relative shrink-0">
                            <canvas id="promoDistChart"></canvas>
                        </div>
                        <div class="flex-1 space-y-2 sm:space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[#1C69D4]"></div>
                                <span class="text-[10px] sm:text-xs font-bold text-gray-500">Welcome</span>
                                <span class="ml-auto text-[10px] sm:text-xs font-black text-gray-900">245</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[#22c55e]"></div>
                                <span class="text-[10px] sm:text-xs font-bold text-gray-500">Weekend</span>
                                <span class="ml-auto text-[10px] sm:text-xs font-black text-gray-900">89</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[#fb923c]"></div>
                                <span class="text-[10px] sm:text-xs font-bold text-gray-500">Carpool</span>
                                <span class="ml-auto text-[10px] sm:text-xs font-black text-gray-900">156</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-[#a855f7]"></div>
                                <span class="text-[10px] sm:text-xs font-bold text-gray-500">Eid</span>
                                <span class="ml-auto text-[10px] sm:text-xs font-black text-gray-900">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            <div class="bg-blue-50/30 p-4 sm:p-6 rounded-2xl border border-blue-100 shadow-sm">
                <p class="text-[10px] sm:text-[11px] font-black text-blue-400 uppercase tracking-widest">Avg. Redemption Rate</p>
                <p class="text-2xl sm:text-4xl font-black text-[#1C69D4] leading-tight mt-2">32.5%</p>
                <div class="mt-2 flex items-center gap-1 text-green-600 font-bold text-[9px] sm:text-xs uppercase">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    +4.2%
                </div>
            </div>
            <div class="bg-green-50/30 p-4 sm:p-6 rounded-2xl border border-green-100 shadow-sm">
                <p class="text-[10px] sm:text-[11px] font-black text-green-400 uppercase tracking-widest">Revenue Impact</p>
                <p class="text-2xl sm:text-4xl font-black text-green-600 leading-tight mt-2">PKR 245K</p>
                <p class="text-[9px] sm:text-[10px] font-bold text-gray-400 mt-2 italic">Attributed revenue</p>
            </div>
            <div class="bg-purple-50/30 p-4 sm:p-6 rounded-2xl border border-purple-100 shadow-sm">
                <p class="text-[10px] sm:text-[11px] font-black text-purple-400 uppercase tracking-widest">Active Promos</p>
                <p class="text-2xl sm:text-4xl font-black text-purple-600 leading-tight mt-2">3</p>
                <p class="text-[9px] sm:text-[10px] font-bold text-gray-400 mt-2">Out of 5 total</p>
            </div>
            <div class="bg-orange-50/30 p-4 sm:p-6 rounded-2xl border border-orange-100 shadow-sm">
                <p class="text-[10px] sm:text-[11px] font-black text-orange-400 uppercase tracking-widest">Total Redemptions</p>
                <p class="text-2xl sm:text-4xl font-black text-orange-600 leading-tight mt-2">490</p>
                <p class="text-[9px] sm:text-[10px] font-bold text-gray-400 mt-2">This month</p>
            </div>
        </div>

        <!-- ===== Edit Promo Modal ===== -->
        <div class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4" x-show="editOpen" x-cloak @keydown.escape.window="editOpen = false">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
                 x-show="editOpen"
                 x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="editOpen = false"></div>

            <div class="relative w-full sm:max-w-lg bg-white sm:rounded-[2.5rem] rounded-t-[2rem] shadow-2xl overflow-hidden"
                 x-show="editOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8">
                <template x-if="editData">
                    <div>
                        <!-- Drag handle (mobile only) -->
                        <div class="sm:hidden flex justify-center pt-3 pb-1">
                            <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
                        </div>
                        <!-- Header -->
                        <div class="flex items-center justify-between px-6 sm:px-8 pt-4 sm:pt-8 pb-4 sm:pb-5 border-b border-gray-100">
                            <div>
                                <h3 class="text-base sm:text-lg font-black text-gray-900 tracking-tight">Edit Promotion</h3>
                                <p class="text-xs font-semibold text-gray-400 mt-0.5" x-text="'Editing: ' + editData.name"></p>
                            </div>
                            <button @click="editOpen = false" class="p-2 hover:bg-gray-100 rounded-xl text-gray-400 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <!-- Form -->
                        <div class="px-6 sm:px-8 py-5 sm:py-6 space-y-4 sm:space-y-5 max-h-[60vh] overflow-y-auto">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="col-span-2 space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Promo Name</label>
                                    <input type="text" x-model="editData.name" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-900 focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Promo Code</label>
                                    <input type="text" x-model="editData.code" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-900 uppercase focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Discount Value</label>
                                    <input type="text" x-model="editData.discount" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-900 focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Valid From</label>
                                    <input type="date" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-900 focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Valid Until</label>
                                    <input type="date" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-900 focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all">
                                </div>
                                <div class="col-span-2 space-y-1.5">
                                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</label>
                                    <select x-model="editData.status" class="w-full px-4 py-3 bg-gray-50/70 border border-gray-100 rounded-xl text-sm font-semibold text-gray-700 focus:outline-none focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all cursor-pointer">
                                        <option>Active</option>
                                        <option>Paused</option>
                                        <option>Draft</option>
                                        <option>Expired</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Footer -->
                        <div class="px-6 sm:px-8 pb-6 sm:pb-8 pt-2 flex gap-3">
                            <button @click="editOpen = false" class="flex-1 py-3 sm:py-3.5 bg-white border border-gray-200 text-gray-600 font-black text-xs rounded-xl hover:bg-gray-50 transition-all uppercase tracking-widest">Cancel</button>
                            <button @click="editOpen = false" class="flex-1 py-3 sm:py-3.5 bg-[#1C69D4] text-white font-black text-xs rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all uppercase tracking-widest">Save Changes</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ===== Delete Confirmation Modal ===== -->
        <div class="fixed inset-0 z-[60] flex items-end sm:items-center justify-center p-0 sm:p-4" x-show="deleteOpen" x-cloak @keydown.escape.window="deleteOpen = false">
            <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"
                 x-show="deleteOpen"
                 x-transition:enter="ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                 @click="deleteOpen = false"></div>

            <div class="relative w-full sm:max-w-sm bg-white sm:rounded-[2.5rem] rounded-t-[2rem] shadow-2xl overflow-hidden"
                 x-show="deleteOpen"
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-8">
                <template x-if="deleteData">
                    <div class="p-6 sm:p-8 text-center">
                        <!-- Drag handle (mobile only) -->
                        <div class="sm:hidden flex justify-center mb-4">
                            <div class="w-10 h-1 bg-gray-200 rounded-full"></div>
                        </div>
                        <div class="w-14 h-14 sm:w-16 sm:h-16 bg-red-50 rounded-2xl flex items-center justify-center mx-auto mb-4 sm:mb-5 border border-red-100">
                            <svg class="w-7 h-7 sm:w-8 sm:h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </div>
                        <h3 class="text-base sm:text-lg font-black text-gray-900 tracking-tight">Delete Promotion</h3>
                        <p class="text-sm font-semibold text-gray-500 mt-2">Are you sure you want to delete <span class="font-black text-gray-900" x-text="'\"' + deleteData.name + '\"'"></span>? This cannot be undone.</p>
                        <div class="flex gap-3 mt-6 sm:mt-7">
                            <button @click="deleteOpen = false" class="flex-1 py-3 sm:py-3.5 bg-white border border-gray-200 text-gray-600 font-black text-xs rounded-xl hover:bg-gray-50 transition-all uppercase tracking-widest">Cancel</button>
                            <button @click="deletePromo()" class="flex-1 py-3 sm:py-3.5 bg-red-500 text-white font-black text-xs rounded-xl shadow-lg shadow-red-200 hover:bg-red-600 transition-all uppercase tracking-widest">Yes, Delete</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isMobile = window.innerWidth < 640;

            // Redemptions Bar Chart
            const ctx1 = document.getElementById('promoUsageChart').getContext('2d');
            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: ['WELCOME50', 'WEEKEND100', 'CARPOOL30', 'EID2026'],
                    datasets: [{ label: 'Redemptions', data: [245, 89, 156, 0], backgroundColor: '#1C69D4', borderRadius: isMobile ? 6 : 8, hoverBackgroundColor: '#2B83F2', maxBarThickness: isMobile ? 35 : 45 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#111827', padding: 12, cornerRadius: 8, displayColors: false }
                    },
                    scales: {
                        y: { beginAtZero: true, max: 260, ticks: { stepSize: 65, color: '#94a3b8', font: { size: isMobile ? 9 : 10, weight: '800' } }, grid: { borderDash: [4,4], color: '#f1f5f9', drawBorder: false } },
                        x: { grid: { display: false }, ticks: { color: '#94a3b8', font: { size: isMobile ? 9 : 10, weight: '800' } } }
                    }
                }
            });

            // Distribution Donut Chart
            const ctx2 = document.getElementById('promoDistChart').getContext('2d');
            new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    labels: ['Welcome', 'Weekend', 'Carpool', 'Eid'],
                    datasets: [{ data: [245, 89, 156, 0], backgroundColor: ['#1C69D4', '#22c55e', '#fb923c', '#a855f7'], borderWidth: 0, hoverOffset: isMobile ? 4 : 8 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: { legend: { display: false }, tooltip: { backgroundColor: '#111827', padding: 10, cornerRadius: 8 } }
                }
            });
        });
    </script>

    <style>[x-cloak] { display: none !important; }</style>
@endsection