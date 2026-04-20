@extends('layouts.app')

@section('title', 'Driver Status')

@section('content')
<div class="space-y-6 pb-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Driver Status Monitor</h2>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Drivers</p>
            <p class="text-2xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm border-l-4 border-l-green-400">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Online</p>
            <p class="text-2xl font-black text-green-600 mt-1">{{ $stats['online'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm border-l-4 border-l-gray-400">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Offline</p>
            <p class="text-2xl font-black text-gray-600 mt-1">{{ $stats['offline'] }}</p>
        </div>
        <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm border-l-4 border-l-orange-400">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Busy</p>
            <p class="text-2xl font-black text-orange-600 mt-1">{{ $stats['busy'] }}</p>
        </div>
    </div>

    <!-- Drivers List -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-4 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-800">Active Drivers</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Driver</th>
                        <th class="px-4 py-3 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Vehicle</th>
                        <th class="px-4 py-3 text-left text-xs font-black text-gray-500 uppercase tracking-wider">Location</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($drivers as $driver)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                                    {{ substr($driver->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $driver->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $driver->mobile_number ?? 'No phone' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if($driver->is_available)
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-green-50 text-green-600 border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                                    Online
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-black uppercase tracking-wider bg-gray-100 text-gray-500 border border-gray-200">
                                    Offline
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $driver->vehicle->type ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-sm text-gray-500">{{ $driver->current_lat && $driver->current_lng ? $driver->current_lat . ', ' . $driver->current_lng : 'Unknown' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                            No drivers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
