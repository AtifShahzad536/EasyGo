@extends('layouts.app')

@section('title', 'Scheduled Rides')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full mb-6">
    <h2 class="text-2xl font-bold text-gray-800 tracking-tight shrink-0">Scheduled Rides</h2>
</div>

@php
        $rides = [
            ['id' => 'SR-1024', 'rider' => 'Ali Hassan', 'driver' => 'Ahmed Khan', 'from' => 'Clifton', 'to' => 'Airport', 'time' => '2026-04-10', 'hour' => '08:00 AM', 'type' => 'Instant', 'seats' => '-', 'status' => 'Confirmed'],
            ['id' => 'SR-1025', 'rider' => 'Zara Malik', 'driver' => 'Unassigned', 'from' => 'DHA Phase 2', 'to' => 'Defence', 'time' => '2026-04-10', 'hour' => '09:30 AM', 'type' => 'Reserved', 'seats' => '-', 'status' => 'Pending Assignment'],
            ['id' => 'SR-1026', 'rider' => 'Hassan Raza', 'driver' => 'Sara Ali', 'from' => 'Gulshan', 'to' => 'Saddar', 'time' => '2026-04-11', 'hour' => '07:00 AM', 'type' => 'Carpool', 'seats' => '2/4', 'status' => 'Confirmed'],
            ['id' => 'SR-1027', 'rider' => 'Ayesha Khan', 'driver' => 'Bilal Ahmed', 'from' => 'Nazimabad', 'to' => 'Clifton', 'time' => '2026-04-11', 'hour' => '10:00 AM', 'type' => 'Two-Way', 'seats' => '-', 'status' => 'Confirmed'],
        ];
    @endphp

    <div x-data="{ view: 'list' }" class="space-y-6 mt-6 pb-12">
        
        <!-- View Control Header - Figma Style -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center bg-gray-50/50 p-1 rounded-xl w-fit border border-gray-100">
                <button @click="view = 'list'" 
                    class="flex items-center gap-2 px-6 py-2.5 rounded-lg text-xs font-black transition-all"
                    :class="view === 'list' ? 'bg-[#1C69D4] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" /></svg>
                    List View
                </button>
                <button @click="view = 'calendar'" 
                    class="flex items-center gap-2 px-6 py-2.5 rounded-lg text-xs font-black transition-all"
                    :class="view === 'calendar' ? 'bg-[#1C69D4] text-white shadow-md' : 'text-gray-400 hover:text-gray-600'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    Calendar View
                </button>
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <select class="bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs font-bold text-gray-700 outline-none w-44 appearance-none cursor-pointer">
                    <option>All Status</option>
                    <option>Confirmed</option>
                    <option>Pending</option>
                </select>
                <select class="bg-white border border-gray-200 rounded-xl px-4 py-2.5 text-xs font-bold text-gray-700 outline-none w-44 appearance-none cursor-pointer">
                    <option>All Types</option>
                    <option>Instant</option>
                    <option>Reserved</option>
                    <option>Carpool</option>
                </select>
            </div>
        </div>

        <!-- LIST VIEW -->
        <div x-show="view === 'list'" x-cloak class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-blue-50/20">
                        <tr>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Booking ID</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Rider</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Driver</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">From</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">To</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Scheduled</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Type</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50 text-center">Seats</th>
                            <th class="px-6 py-6 text-[11px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($rides as $r)
                        <tr class="hover:bg-blue-50/10 transition-colors">
                            <td class="px-6 py-5 text-[13px] font-bold text-[#1C69D4] tracking-tight cursor-pointer hover:underline">{{ $r['id'] }}</td>
                            <td class="px-6 py-5 text-[13px] font-black text-gray-900">{{ $r['rider'] }}</td>
                            <td class="px-6 py-5 text-[13px] font-bold {{ $r['driver'] === 'Unassigned' ? 'text-orange-500' : 'text-gray-600' }}">
                                {{ $r['driver'] }}
                            </td>
                            <td class="px-6 py-5 text-[13px] font-bold text-gray-500 whitespace-nowrap">{{ $r['from'] }}</td>
                            <td class="px-6 py-5 text-[13px] font-bold text-gray-500 whitespace-nowrap">{{ $r['to'] }}</td>
                            <td class="px-6 py-5">
                                <div class="flex flex-col">
                                    <span class="text-[13px] font-bold text-gray-700">{{ $r['time'] }}</span>
                                    <span class="text-[11px] font-bold text-[#1C69D4]">{{ $r['hour'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $typeColors = [
                                        'Instant' => 'bg-blue-50 text-blue-600',
                                        'Reserved' => 'bg-indigo-50 text-indigo-700',
                                        'Carpool' => 'bg-purple-50 text-purple-600',
                                        'Two-Way' => 'bg-sky-50 text-sky-600',
                                    ];
                                @endphp
                                <span class="px-3.5 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest {{ $typeColors[$r['type']] ?? 'bg-gray-50 text-gray-600' }}">
                                    {{ $r['type'] }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center text-[13px] font-black text-gray-400">{{ $r['seats'] }}</td>
                            <td class="px-6 py-5 text-right">
                                @if($r['status'] === 'Confirmed')
                                    <span class="px-3.5 py-1.5 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">Confirmed</span>
                                @else
                                    <span class="px-3.5 py-1.5 bg-[#FFFBEB] text-[#92400E] rounded-lg text-[10px] font-black uppercase tracking-widest border border-[#FDE68A]">Pending Assignment</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CALENDAR VIEW -->
        <div x-show="view === 'calendar'" x-cloak class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-xl font-black text-gray-800 tracking-tight">April 2026</h3>
                <div class="flex items-center gap-2">
                    <button class="px-5 py-2 border border-gray-200 rounded-lg text-[11px] font-black text-gray-600 uppercase hover:bg-gray-50 transition-all">Previous</button>
                    <button class="px-5 py-2 border border-gray-200 rounded-lg text-[11px] font-black text-gray-600 uppercase hover:bg-gray-50 transition-all">Next</button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="border border-gray-100 rounded-xl overflow-hidden">
                <div class="grid grid-cols-7 bg-blue-50/20 border-b border-gray-100">
                    @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="py-4 text-center text-[11px] font-black text-blue-900/60 uppercase tracking-widest">{{ $day }}</div>
                    @endforeach
                </div>
                <div class="grid grid-cols-7 divide-x divide-y divide-gray-100 min-h-[600px]">
                    @for($i=1; $i<=35; $i++)
                        @php $dayNum = $i - 3; @endphp
                        <div class="p-2 h-32 hover:bg-gray-50/50 transition-colors relative">
                            @if($dayNum > 0 && $dayNum <= 30)
                                <span class="text-xs font-bold text-gray-400">{{ $dayNum }}</span>
                                
                                <!-- Mock Indicators -->
                                @if($dayNum == 9)
                                    <div class="mt-2 p-1.5 bg-red-50 text-red-600 border border-red-100 rounded text-[9px] font-black">06:00</div>
                                @endif
                                @if($dayNum == 10)
                                    <div class="mt-2 space-y-1">
                                        <div class="p-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded text-[9px] font-black">08:00</div>
                                        <div class="p-1.5 bg-[#FFFBEB] text-[#92400E] border border-[#FDE68A] rounded text-[9px] font-black">09:30</div>
                                    </div>
                                @endif
                                @if($dayNum == 11)
                                    <div class="mt-2 space-y-1">
                                        <div class="p-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded text-[9px] font-black">07:00</div>
                                        <div class="p-1.5 bg-blue-50 text-blue-600 border border-blue-100 rounded text-[9px] font-black">10:00</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Legend -->
            <div class="mt-8 pt-8 border-t border-gray-100 flex items-center gap-6">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-[#1C69D4]"></div>
                    <span class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Confirmed</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-[#FBBF24]"></div>
                    <span class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Pending</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-red-500"></div>
                    <span class="text-[11px] font-bold text-gray-600 uppercase tracking-widest">Cancelled</span>
                </div>
            </div>
        </div>

    </div>
@endsection
