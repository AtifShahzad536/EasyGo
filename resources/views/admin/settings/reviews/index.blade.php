@extends('layouts.app')

@section('title', 'Reviews')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 w-full mb-6">
    <h2 class="text-2xl font-bold text-gray-800 tracking-tight shrink-0">Reviews</h2>
</div>

@php
        $flagged = [
            ['name' => 'Ahmed Khan', 'init' => 'AK', 'type' => 'Driver → Rider', 'stars' => 2, 'text' => 'Rider was extremely rude and made unnecessary complaints.', 'date' => '2026-04-07'],
            ['name' => 'Ayesha Khan', 'init' => 'AK', 'type' => 'Rider → Driver', 'stars' => 1, 'text' => 'Driver took wrong route and overcharged. Very unprofessional.', 'date' => '2026-04-07'],
        ];

        $all = [
            ['from' => 'Ali Hassan', 'f_init' => 'AH', 'to' => 'Ahmed Khan', 'type' => 'Rider → Driver', 'rating' => 5, 'text' => 'Excellent service! Very professional and court...', 'date' => '2026-04-08', 'status' => 'Normal'],
            ['from' => 'Zara Malik', 'f_init' => 'ZM', 'to' => 'Sara Ali', 'type' => 'Rider → Driver', 'rating' => 4, 'text' => 'Good experience overall. Slightly delayed pic...', 'date' => '2026-04-08', 'status' => 'Normal'],
            ['from' => 'Ahmed Khan', 'f_init' => 'AK', 'to' => 'Hassan Raza', 'type' => 'Driver → Rider', 'rating' => 2, 'text' => 'Rider was extremely rude and made unneces...', 'date' => '2026-04-07', 'status' => 'Flagged'],
            ['from' => 'Ayesha Khan', 'f_init' => 'AK', 'to' => 'Bilal Ahmed', 'type' => 'Rider → Driver', 'rating' => 1, 'text' => 'Driver took wrong route and overcharged. V...', 'date' => '2026-04-07', 'status' => 'Flagged'],
            ['from' => 'Sara Ali', 'f_init' => 'SA', 'to' => 'Farhan Ali', 'type' => 'Driver → Rider', 'rating' => 5, 'text' => 'Great rider! Very respectful and punctual.', 'date' => '2026-04-06', 'status' => 'Normal'],
        ];
    @endphp

    <div class="space-y-8 mt-6 pb-12">
        
        <!-- Filters Header - Precise Figma Match -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 flex flex-col lg:flex-row lg:items-center gap-6">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
                <input type="text" class="w-full bg-gray-50/50 border border-gray-100 rounded-xl px-11 py-3.5 text-xs font-bold text-gray-900 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none transition-all placeholder:text-gray-400 font-bold" placeholder="Search reviews...">
            </div>

            <div class="flex flex-wrap items-center gap-4">
                <select class="bg-gray-50/50 border border-gray-100 rounded-xl px-6 py-3.5 text-xs font-bold text-gray-500 outline-none w-44 appearance-none cursor-pointer">
                    <option>All Ratings</option>
                    <option>5 Stars</option>
                    <option>4 Stars</option>
                </select>

                <select class="bg-gray-50/50 border border-gray-100 rounded-xl px-6 py-3.5 text-xs font-bold text-gray-500 outline-none w-44 appearance-none cursor-pointer">
                    <option>All Types</option>
                    <option>Driver → Rider</option>
                    <option>Rider → Driver</option>
                </select>

                <label class="flex items-center gap-3 cursor-pointer select-none bg-white border border-gray-100 rounded-xl px-6 py-3.5 shadow-sm">
                    <input type="checkbox" class="w-5 h-5 rounded-lg border-gray-200 text-[#1C69D4] focus:ring-[#1C69D4]/10 transition-all">
                    <span class="text-xs font-bold text-gray-700">Flagged Only</span>
                </label>
            </div>
        </div>

        <!-- Flagged Reviews Section - Similarity Refinement -->
        <div class="space-y-6">
            <div class="flex items-center gap-3 px-2">
                <svg class="w-5 h-5 text-orange-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <h3 class="text-[17px] font-bold text-gray-900 tracking-tight">Flagged Reviews Requiring Attention</h3>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @foreach($flagged as $f)
                <div class="bg-white p-8 rounded-2xl border border-yellow-100/60 shadow-sm flex flex-col gap-5 relative group hover:shadow-md transition-all">
                    <!-- Top Row -->
                    <div class="flex items-start justify-between w-full">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-full bg-[#FEF3C7] text-[#92400E] flex items-center justify-center font-black text-sm border border-[#FDE68A]">
                                {{ $f['init'] }}
                            </div>
                            <div>
                                <h4 class="text-[17px] font-black text-gray-900 tracking-tight leading-none">{{ $f['name'] }}</h4>
                                <p class="text-[13px] font-bold text-gray-400 mt-2">{{ $f['type'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-0.5 text-[#FBBF24]">
                                @for($i=0; $i<5; $i++)
                                <svg class="w-4 h-4 {{ $i < $f['stars'] ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                @endfor
                            </div>
                            <span class="px-3 py-1 bg-[#FEE2E2] text-[#B91C1C] font-black text-[10px] rounded-lg tracking-widest uppercase border border-[#FECACA]">Flagged</span>
                        </div>
                    </div>

                    <!-- Review Text Row -->
                    <div class="px-1">
                        <p class="text-[15px] font-medium text-gray-700 leading-relaxed">{{ $f['text'] }}</p>
                    </div>

                    <!-- Bottom Row -->
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-[13px] font-bold text-gray-400 tracking-tight">{{ $f['date'] }}</span>
                        <button class="bg-[#1C69D4] hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-[13px] font-black tracking-tight shadow-md active:scale-95 transition-all">
                            Take Action
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- All Reviews Table - Standard Blue -->
        <div class="space-y-6">
            <h3 class="text-[17px] font-bold text-gray-900 tracking-tight px-2">All Reviews</h3>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#F8FAFC]">
                            <tr>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Reviewer</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Reviewed</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Type</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Rating</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Review</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">Date</th>
                                <th class="px-6 py-5 text-[11px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($all as $row)
                            <tr class="hover:bg-blue-50/10 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-blue-50 text-[#1C69D4] flex items-center justify-center font-black text-[10px] border border-blue-100 uppercase">
                                            {{ $row['f_init'] }}
                                        </div>
                                        <span class="text-[13px] font-bold text-gray-900 tracking-tight">{{ $row['from'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-[13px] font-bold text-gray-500">{{ $row['to'] }}</td>
                                <td class="px-6 py-5">
                                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter">{{ $row['type'] }}</span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-0.5 text-[#FBBF24]">
                                        @for($i=0; $i<5; $i++)
                                        <svg class="w-3 h-3 {{ $i < $row['rating'] ? 'fill-current' : 'text-gray-200 fill-current' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-[13px] font-medium text-gray-500 line-clamp-1 max-w-[250px]">{{ $row['text'] }}</p>
                                </td>
                                <td class="px-6 py-5 text-[13px] font-bold text-gray-400 tracking-tight">{{ $row['date'] }}</td>
                                <td class="px-6 py-5 text-right">
                                    @if($row['status'] === 'Flagged')
                                    <span class="px-2.5 py-1 bg-[#FEE2E2] text-[#B91C1C] font-black text-[9px] uppercase tracking-widest rounded-lg border border-[#FECACA]">Flagged</span>
                                    @else
                                    <span class="text-gray-200">−</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
