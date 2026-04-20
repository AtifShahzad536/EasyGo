@extends('layouts.app')

@section('title', 'Reports')

@section('content')

    <div x-data="{ activeTab: 'usage', chartsInitialized: {} }" x-init="$watch('activeTab', tab => { if (!chartsInitialized[tab]) { initCharts(tab); chartsInitialized[tab] = true; } })" class="space-y-4 sm:space-y-8 mt-4 sm:mt-6 pb-12 px-2 sm:px-0">

        <!-- Tab Navigation — horizontally scrollable on mobile -->
        <div class="overflow-x-auto scrollbar-none -mx-2 px-2">
            <div class="flex items-center gap-4 sm:gap-10 border-b border-gray-100 pb-px min-w-max">
                @foreach([
                    ['id' => 'usage',   'label' => 'Usage'],
                    ['id' => 'revenue', 'label' => 'Revenue'],
                    ['id' => 'driver',  'label' => 'Drivers'],
                    ['id' => 'rider',   'label' => 'Riders'],
                ] as $tab)
                <button
                    @click="activeTab = '{{ $tab['id'] }}'"
                    class="pb-4 sm:pb-5 text-sm sm:text-[15px] font-bold transition-all relative whitespace-nowrap"
                    :class="activeTab === '{{ $tab['id'] }}' ? 'text-[#1C69D4]' : 'text-gray-400 hover:text-gray-900'"
                >
                    {{ $tab['label'] }}
                    <div
                        x-show="activeTab === '{{ $tab['id'] }}'"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-x-0"
                        x-transition:enter-end="opacity-100 scale-x-100"
                        class="absolute bottom-0 left-0 w-full h-[3px] bg-[#1C69D4] rounded-full"
                    ></div>
                </button>
                @endforeach
            </div>
        </div>

       <!-- Date Filter Card -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8">
    <div class="space-y-3 sm:space-y-4">
        <span class="text-[11px] sm:text-[13px] font-black text-gray-900 uppercase tracking-widest block">Date Range</span>
        <div class="flex flex-col gap-3 sm:gap-6">
            <!-- Date inputs — stacked on mobile, side by side on sm+ -->
            <div class="flex flex-col xs:flex-row items-stretch xs:items-center gap-2 sm:gap-6">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <input type="date" placeholder="From" class="w-full bg-gray-50/50 border border-gray-100 rounded-xl pl-10 pr-3 py-3 text-xs font-bold text-gray-400 outline-none cursor-pointer focus:border-[#1C69D4]/30">
                </div>

                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest shrink-0 text-center">to</span>

                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    </div>
                    <input type="date" placeholder="To" class="w-full bg-gray-50/50 border border-gray-100 rounded-xl pl-10 pr-3 py-3 text-xs font-bold text-gray-400 outline-none cursor-pointer focus:border-[#1C69D4]/30">
                </div>
            </div>

            <!-- Download Button — always full width on mobile -->
            <button class="w-full sm:w-auto sm:self-start bg-[#1C69D4] hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl text-[11px] font-black uppercase tracking-widest flex items-center justify-center gap-2 shadow-lg shadow-[#1C69D4]/20 active:scale-95 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download Report
            </button>
        </div>
    </div>
</div>

        <!-- ── TAB: USAGE ── -->
        <div x-show="activeTab === 'usage'" x-cloak class="space-y-4 sm:space-y-8">

            <!-- KPI Cards — 2 cols on mobile, 4 on desktop -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach([
                    ['label' => 'Total Rides',        'value' => '23,479', 'trend' => '+12.5% vs last period', 'color' => '[#1C69D4]', 'up' => true],
                    ['label' => 'Active Users',        'value' => '8,932',  'trend' => '+8.3% vs last period',  'color' => 'green-500',  'up' => true],
                    ['label' => 'New Registrations',   'value' => '1,245',  'trend' => '+15.7% vs last period', 'color' => 'purple-500', 'up' => true],
                    ['label' => 'Cancellation Rate',   'value' => '4.2%',   'trend' => '+0.8% vs last period',  'color' => 'red-500',    'up' => false],
                ] as $kpi)
                <div class="bg-white p-4 sm:p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-auto sm:h-[180px] border-l-[6px] border-l-{{ $kpi['color'] }} transition-all hover:shadow-md">
                    <p class="text-[11px] sm:text-[13px] font-bold text-gray-500 tracking-tight">{{ $kpi['label'] }}</p>
                    <div class="mt-2 sm:mt-4">
                        <p class="text-2xl sm:text-4xl font-black text-gray-900 tracking-tighter leading-none">{{ $kpi['value'] }}</p>
                        <p class="text-[10px] sm:text-[12px] font-bold {{ $kpi['up'] === false ? 'text-red-500' : 'text-green-500' }} mt-2 sm:mt-4 tracking-tight">
                            {{ $kpi['trend'] }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Rides Per Day Chart -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col h-[300px] sm:h-[480px]">
                <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Rides Per Day</h4>
                <div class="flex-1 w-full relative">
                    <canvas id="usageTrendsChart"></canvas>
                </div>
            </div>

            <!-- Rides by City + Type Distribution -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                <!-- Rides by City -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col h-[280px] sm:h-[450px]">
                    <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Rides by City</h4>
                    <div class="flex-1 w-full relative">
                        <canvas id="usageCityChart"></canvas>
                    </div>
                </div>

                <!-- Ride Type Distribution -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col">
                    <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Ride Type Distribution</h4>
                    <div class="flex flex-row items-center gap-4 sm:gap-8">
                        <!-- Donut -->
                        <div class="w-[130px] h-[130px] sm:w-[220px] sm:h-[220px] relative shrink-0">
                            <canvas id="usageTypeChart"></canvas>
                        </div>
                        <!-- Legend -->
                        <div class="flex-1 grid grid-cols-1 gap-2 sm:gap-y-4">
                            @foreach([
                                ['label' => 'Instant',  'val' => '65%', 'color' => '#1C69D4'],
                                ['label' => 'Reserved', 'val' => '20%', 'color' => '#22c55e'],
                                ['label' => 'Carpool',  'val' => '10%', 'color' => '#fb923c'],
                                ['label' => 'Two-Way',  'val' => '5%',  'color' => '#a855f7'],
                            ] as $item)
                            <div class="flex items-center justify-between p-2.5 sm:p-3.5 bg-gray-50/50 rounded-xl border border-gray-100">
                                <div class="flex items-center gap-2 sm:gap-3">
                                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full shrink-0" style="background-color: {{ $item['color'] }}"></div>
                                    <span class="text-[10px] sm:text-[11px] font-black text-gray-500 uppercase tracking-widest">{{ $item['label'] }}</span>
                                </div>
                                <span class="text-xs font-black text-gray-900">{{ $item['val'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── TAB: REVENUE ── -->
        <div x-show="activeTab === 'revenue'" x-cloak class="space-y-4 sm:space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-6">
                <div class="bg-white p-4 sm:p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-auto sm:h-[180px] border-l-[6px] border-l-green-500">
                    <p class="text-[11px] sm:text-[13px] font-bold text-gray-500 tracking-tight">Total Revenue</p>
                    <div class="mt-2 sm:mt-4">
                        <p class="text-2xl sm:text-4xl font-black text-green-600 tracking-tighter leading-none">PKR 6.8M</p>
                        <p class="text-[10px] sm:text-[12px] font-bold text-green-600 mt-2 sm:mt-4 tracking-tight">Revenue Dashboard</p>
                    </div>
                </div>
                <div class="bg-white p-4 sm:p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-auto sm:h-[180px] border-l-[6px] border-l-[#1C69D4]">
                    <p class="text-[11px] sm:text-[13px] font-bold text-gray-500 tracking-tight">Commission Earned</p>
                    <div class="mt-2 sm:mt-4">
                        <p class="text-2xl sm:text-4xl font-black text-[#1C69D4] tracking-tighter leading-none">PKR 1.4M</p>
                        <p class="text-[10px] sm:text-[12px] font-bold text-[#1C69D4] mt-2 sm:mt-4 tracking-tight">Net Earnings</p>
                    </div>
                </div>
                <div class="bg-white p-4 sm:p-8 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between h-auto sm:h-[180px] border-l-[6px] border-l-red-500">
                    <p class="text-[11px] sm:text-[13px] font-bold text-gray-500 tracking-tight">Refunds Given</p>
                    <div class="mt-2 sm:mt-4">
                        <p class="text-2xl sm:text-4xl font-black text-red-600 tracking-tighter leading-none">PKR 45K</p>
                        <p class="text-[10px] sm:text-[12px] font-bold text-red-400 mt-2 sm:mt-4 tracking-tight">Disputes Processed</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col h-[300px] sm:h-[480px]">
                <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Revenue Trend</h4>
                <div class="flex-1 w-full relative">
                    <canvas id="revenueTrendsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- ── TAB: DRIVER ── -->
        <div x-show="activeTab === 'driver'" x-cloak class="space-y-4 sm:space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col h-[320px] sm:h-[450px]">
                <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Driver Activity Map</h4>
                <div class="flex-1 bg-gray-50 rounded-xl flex items-center justify-center border border-dashed border-gray-200">
                    <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-widest text-center px-4">Map Visualization Data Required</p>
                </div>
            </div>
        </div>

        <!-- ── TAB: RIDER ── -->
        <div x-show="activeTab === 'rider'" x-cloak class="space-y-4 sm:space-y-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 sm:p-8 flex flex-col h-[320px] sm:h-[450px]">
                <h4 class="text-base sm:text-xl font-black text-gray-800 tracking-tight mb-4 sm:mb-8">Rider Retention Matrix</h4>
                <div class="flex-1 bg-gray-50 rounded-xl flex items-center justify-center border border-dashed border-gray-200">
                    <p class="text-[10px] sm:text-xs font-bold text-gray-400 uppercase tracking-widest text-center px-4">Retention Matrix Data Required</p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chartInstances = {};

        function initCharts(tab) {
            const isMobile = window.innerWidth < 640;
            const fConfig = {
                color: '#94a3b8',
                font: { size: isMobile ? 9 : 11, weight: '800', family: "'Inter', sans-serif" },
                grid: { color: '#f1f5f9', borderDash: [4, 4], drawBorder: false }
            };

            if (tab === 'usage' && !chartInstances['usageTrends']) {
                // Usage Trends
                chartInstances['usageTrends'] = new Chart(document.getElementById('usageTrendsChart'), {
                type: 'line',
                data: {
                    labels: ['Apr 1','Apr 2','Apr 3','Apr 4','Apr 5','Apr 6','Apr 7','Apr 8'],
                    datasets: [{
                        data: [2500,2750,2400,3000,3200,3600,3450,3000],
                        borderColor: '#1C69D4', borderWidth: isMobile ? 2 : 4,
                        fill: true,
                        backgroundColor: (c) => {
                            const g = c.chart.ctx.createLinearGradient(0, 0, 0, 400);
                            g.addColorStop(0, 'rgba(28,105,212,0.1)');
                            g.addColorStop(1, 'rgba(28,105,212,0)');
                            return g;
                        },
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#1C69D4',
                        pointBorderWidth: isMobile ? 2 : 3,
                        pointRadius: isMobile ? 3 : 6
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 3600, ticks: { stepSize: 900, color: fConfig.color, font: fConfig.font }, grid: fConfig.grid },
                        x: { grid: { display: false }, ticks: { color: fConfig.color, font: fConfig.font } }
                    }
                }
            });

                // City Bar
                chartInstances['cityBar'] = new Chart(document.getElementById('usageCityChart'), {
                type: 'bar',
                data: {
                    labels: ['Karachi','Lahore','Islamabad','Rawalpindi'],
                    datasets: [{ data: [13000,10500,8200,5400], backgroundColor: '#1C69D4', borderRadius: isMobile ? 6 : 12, maxBarThickness: isMobile ? 30 : 60 }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 14000, ticks: { stepSize: 3500, color: fConfig.color, font: fConfig.font }, grid: fConfig.grid },
                        x: { grid: { display: false }, ticks: { color: fConfig.color, font: fConfig.font } }
                    }
                }
            });

                // Type Donut
                chartInstances['typeDonut'] = new Chart(document.getElementById('usageTypeChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Instant','Reserved','Carpool','Two-Way'],
                    datasets: [{ data: [65,20,10,5], backgroundColor: ['#1C69D4','#22c55e','#fb923c','#a855f7'], borderWidth: 0, hoverOffset: isMobile ? 6 : 12 }]
                },
                options: { responsive: true, maintainAspectRatio: false, cutout: '72%', plugins: { legend: { display: false } } }
            });

            }

            if (tab === 'revenue' && !chartInstances['revenueTrends']) {
                // Revenue Trend
                chartInstances['revenueTrends'] = new Chart(document.getElementById('revenueTrendsChart'), {
                type: 'line',
                data: {
                    labels: ['Apr 1','Apr 2','Apr 3','Apr 4','Apr 5','Apr 6','Apr 7','Apr 8'],
                    datasets: [{
                        data: [850000,920000,780000,1050000,1150000,1280000,1200000,980000],
                        borderColor: '#22c55e', borderWidth: isMobile ? 2 : 4,
                        fill: true,
                        backgroundColor: (c) => {
                            const g = c.chart.ctx.createLinearGradient(0, 0, 0, 400);
                            g.addColorStop(0, 'rgba(34,197,94,0.1)');
                            g.addColorStop(1, 'rgba(34,197,94,0)');
                            return g;
                        },
                        tension: 0.4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#22c55e',
                        pointBorderWidth: isMobile ? 2 : 3,
                        pointRadius: isMobile ? 3 : 6
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, max: 1400000, ticks: { stepSize: 350000, color: fConfig.color, font: fConfig.font }, grid: fConfig.grid },
                        x: { grid: { display: false }, ticks: { color: fConfig.color, font: fConfig.font } }
                    }
                }
            });
            }
        }

        // Initialize usage charts immediately since that's the default tab
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => initCharts('usage'), 100);
        });
    </script>
@endsection