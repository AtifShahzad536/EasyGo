@extends('layouts.app')

@section('title', 'Settings')

@section('content')

    <!-- Main Container with x-data for centralized state control -->
    <div class="space-y-8 max-w-6xl mx-auto pb-12" x-data="{ adminModalOpen: false }">
        
        <!-- Platform Configuration Section -->
        <form action="#" method="POST" class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden p-8 transition-all hover:shadow-md">
            @csrf
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Platform Configuration</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Core system parameters and logic</p>
                </div>
                <button type="submit" class="flex items-center gap-2 px-6 py-2.5 bg-[#1C69D4] text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 hover:scale-[1.02] transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    Save Changes
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Commission Rate (%)</label>
                    <div class="relative">
                        <input type="number" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all outline-none" value="{{ $platformConfig['commission_rate'] }}">
                        <span class="absolute right-5 top-1/2 -translate-y-1/2 font-black text-gray-300">%</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Cancellation Fee (PKR)</label>
                    <div class="relative">
                        <input type="number" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all outline-none" value="{{ $platformConfig['cancellation_fee'] }}">
                        <span class="absolute right-5 top-1/2 -translate-y-1/2 font-black text-gray-300 text-[10px]">PKR</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Surge Pricing Multiplier</label>
                    <input type="number" step="0.1" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all outline-none" value="{{ $platformConfig['surge_Pricing_multiplier'] }}">
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Minimum Ride Fare (PKR)</label>
                    <input type="number" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] transition-all outline-none" value="{{ $platformConfig['minimum_ride_fare'] }}">
                </div>
            </div>
        </form>

        <!-- Fare Management Section -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden p-8 transition-all hover:shadow-md">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Fare Management</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Vehicle-specific pricing tables</p>
                </div>
                <button class="flex items-center gap-2 px-6 py-2.5 bg-[#1C69D4] text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 hover:scale-[1.02] transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    Save Fares
                </button>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-50">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-blue-50/50 text-[#1C69D4]">
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Vehicle Type</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Base Fare (PKR)</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Per KM Rate (PKR)</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Per Minute Rate (PKR)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($fareManagement as $fare)
                        <tr class="group hover:bg-gray-50/30 transition-colors">
                            <td class="px-6 py-6 font-black text-gray-900 text-sm tracking-tight">{{ $fare['type'] }}</td>
                            <td class="px-6 py-6">
                                <input type="number" class="max-w-[120px] bg-white border border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 outline-none transition-all" value="{{ $fare['base_fare'] }}">
                            </td>
                            <td class="px-6 py-6">
                                <input type="number" class="max-w-[120px] bg-white border border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 outline-none transition-all" value="{{ $fare['per_km'] }}">
                            </td>
                            <td class="px-6 py-6">
                                <input type="number" class="max-w-[120px] bg-white border border-gray-100 rounded-xl px-4 py-2 text-sm font-bold text-gray-800 focus:ring-4 focus:ring-[#1C69D4]/10 outline-none transition-all" value="{{ $fare['per_min'] }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Admin User Management Section -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden p-8 transition-all hover:shadow-md">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Admin User Management</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Control administrative access</p>
                </div>
                <!-- Button now directly sets central state -->
                <button type="button" @click="adminModalOpen = true" class="flex items-center gap-2 px-6 py-2.5 bg-[#1C69D4] text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-lg shadow-blue-200 hover:bg-blue-700 hover:scale-[1.02] transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Add Admin
                </button>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-gray-50">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-blue-50/50 text-[#1C69D4]">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest">Name</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Email Address</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest">Role</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-widest text-center">Last Login</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($admins as $admin)
                        <tr class="group hover:bg-gray-50/30 transition-colors">
                            <td class="px-8 py-6 font-black text-gray-900 text-sm tracking-tight">{{ $admin['name'] }}</td>
                            <td class="px-6 py-6 text-sm font-bold text-gray-500">{{ $admin['email'] }}</td>
                            <td class="px-6 py-6">
                                <span class="px-3 py-1 bg-blue-50 text-[#1C69D4] rounded-lg text-[9px] font-black uppercase tracking-widest border border-blue-100">
                                    {{ $admin['role'] }}
                                </span>
                            </td>
                            <td class="px-6 py-6 text-[10px] font-bold text-gray-400 text-center italic">{{ $admin['last_login'] }}</td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-2 text-red-100 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Security Settings Section -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden p-8 transition-all hover:shadow-md">
            <h3 class="text-xl font-black text-gray-900 tracking-tight mb-8">Security & Privacy</h3>
            
            <div class="space-y-6">
                <div class="flex items-center justify-between p-6 bg-gray-50/50 rounded-3xl border border-gray-100 hover:bg-gray-100/50 transition-colors">
                    <div>
                        <h4 class="text-sm font-black text-gray-900 tracking-tight">Two-Factor Authentication</h4>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Multi-layer security for administrative logins</p>
                    </div>
                    <div x-data="{ active: true }">
                        <button @click="active = !active" 
                                :class="active ? 'bg-[#1C69D4] shadow-blue-200' : 'bg-gray-300 shadow-transparent'"
                                class="w-14 h-8 rounded-full relative p-1 transition-all duration-300 shadow-lg">
                            <div :class="active ? 'translate-x-6' : 'translate-x-0'"
                                 class="w-6 h-6 bg-white rounded-full shadow-sm transition-transform duration-300"></div>
                        </button>
                    </div>
                </div>

                <div class="flex items-center justify-between p-6 bg-gray-50/50 rounded-3xl border border-gray-100 hover:bg-gray-100/50 transition-colors">
                    <div>
                        <h4 class="text-sm font-black text-gray-900 tracking-tight">Session Timeout Control</h4>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Inactivity duration before automatic logout</p>
                    </div>
                    <select class="bg-white border border-gray-100 rounded-xl px-5 py-3 text-xs font-black text-gray-700 uppercase tracking-widest focus:ring-4 focus:ring-[#1C69D4]/10 outline-none transition-all cursor-pointer">
                        <option>15 Minutes</option>
                        <option>30 Minutes</option>
                        <option>1 Hour</option>
                        <option>Never</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- App Version & Maintenance Section -->
        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden p-8 transition-all hover:shadow-md">
            <h3 class="text-xl font-black text-gray-900 tracking-tight mb-8">Versioning & Maintenance</h3>
            
            <div class="space-y-8">
                <div class="flex items-center justify-between p-6 bg-gray-50/50 rounded-3xl border border-gray-100 hover:bg-gray-100/50 transition-colors">
                    <div>
                        <h4 class="text-sm font-black text-gray-900 tracking-tight">Global Maintenance Mode</h4>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Temporarily disable platform features for all users</p>
                    </div>
                    <div x-data="{ active: false }">
                        <button @click="active = !active" 
                                :class="active ? 'bg-[#1C69D4] shadow-blue-200' : 'bg-gray-300 shadow-transparent'"
                                class="w-14 h-8 rounded-full relative p-1 transition-all duration-300 shadow-lg">
                            <div :class="active ? 'translate-x-6' : 'translate-x-0'"
                                 class="w-6 h-6 bg-white rounded-full shadow-sm transition-transform duration-300"></div>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="p-6 bg-blue-50/30 rounded-2xl border border-blue-50/50">
                        <p class="text-[9px] font-black text-blue-400 uppercase tracking-widest">Rider App</p>
                        <p class="text-xl font-black text-gray-900 mt-2">{{ $appVersions['rider_version'] }}</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Driver App</p>
                        <p class="text-xl font-black text-gray-900 mt-2">{{ $appVersions['driver_version'] }}</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Min Support</p>
                        <p class="text-xl font-black text-gray-900 mt-2">{{ $appVersions['min_supported'] }}</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">System Sync</p>
                        <p class="text-xl font-black text-green-600 mt-2">Active Now</p>
                    </div>
                </div>
            </div>
        </div>

        @include('settings.partials.add-admin-modal')
    </div>
@endsection
