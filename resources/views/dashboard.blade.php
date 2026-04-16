<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 tracking-tight flex-shrink-0">Dashboard Overview</h2>
    </x-slot>

    <div class="space-y-6 pb-8">
        <!-- Top KPI Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Rides Today -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-[140px] border-l-[6px] border-l-[#1C69D4] transition-all hover:shadow-md group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Total Rides Today</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-2 tracking-tighter">2,847</h3>
                    </div>
                    <div class="p-2.5 bg-blue-50 rounded-lg border border-blue-100 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-[#1C69D4]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-[10px] font-black text-green-600 mt-auto uppercase tracking-tighter bg-green-50 w-fit px-2 py-1 rounded-md">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    <span>12.5% increase</span>
                </div>
            </div>

            <!-- Card 2: Active Drivers Now -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-[140px] border-l-[6px] border-l-green-500 transition-all hover:shadow-md group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Active Drivers Now</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-2 tracking-tighter">1,234</h3>
                    </div>
                    <div class="p-2.5 bg-green-50 rounded-lg border border-green-100 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0v10a2 2 0 01-2 2H6a2 2 0 01-2-2V7m14 0c0-1.105-.895-2-2-2H6c-1.105 0-2 .895-2 2m16 0v10m-16-10v10"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-[10px] font-black text-gray-400 mt-auto uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                    <span>Live Monitoring</span>
                </div>
            </div>

            <!-- Card 3: Revenue Today -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-[140px] border-l-[6px] border-l-orange-400 transition-all hover:shadow-md group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Revenue Today</p>
                        <h3 class="text-2xl font-black text-orange-500 mt-2 tracking-tighter leading-none">PKR 856K</h3>
                    </div>
                    <div class="p-2.5 bg-orange-50 rounded-lg border border-orange-100 group-hover:scale-110 transition-transform flex items-center justify-center">
                        <span class="text-orange-500 font-black text-xl px-1">₨</span>
                    </div>
                </div>
                <div class="flex items-center text-[10px] font-black text-orange-600 mt-auto uppercase tracking-tighter bg-orange-50 w-fit px-2 py-1 rounded-md">
                    <span>Target: 1.2M</span>
                </div>
            </div>

            <!-- Card 4: New Registrations -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col justify-between h-[140px] border-l-[6px] border-l-purple-500 transition-all hover:shadow-md group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">User Registrations</p>
                        <h3 class="text-3xl font-black text-gray-900 mt-2 tracking-tighter">145</h3>
                    </div>
                    <div class="p-2.5 bg-purple-50 rounded-lg border border-purple-100 group-hover:scale-110 transition-transform text-purple-600 flex items-center justify-center">
                       <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <div class="flex items-center text-[10px] font-black text-gray-400 mt-auto uppercase tracking-tighter">
                    <span>78 Riders / 67 Drivers</span>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Line Chart (Rides Over Time) -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col min-h-[400px]">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-50 text-gray-800">
                    <h3 class="text-lg font-black tracking-tight">System Performance</h3>
                    <select class="bg-gray-50 border-none rounded-lg text-[10px] font-black uppercase tracking-widest p-2 outline-none cursor-pointer">
                        <option>Last 7 Days</option>
                        <option>Last 30 Days</option>
                    </select>
                </div>
                <div class="flex-1 relative w-full pt-4">
                    <canvas id="ridesOverTimeChart"></canvas>
                </div>
            </div>
            
            <!-- Donut Chart (Ride Type Breakdown) -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col min-h-[400px]">
                <h3 class="text-lg font-black text-gray-800 mb-6 pb-4 border-b border-gray-50 tracking-tight">Ride Breakdown</h3>
                <div class="flex-1 relative w-full flex items-center justify-center p-4">
                    <canvas id="rideTypeChart"></canvas>
                </div>
                <!-- Legend -->
                <div class="grid grid-cols-2 gap-y-4 mt-6">
                    <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#1C69D4] mr-2 shadow-sm"></span> Instant (65%)
                    </div>
                    <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        <span class="w-2.5 h-2.5 rounded-full bg-green-500 mr-2 shadow-sm"></span> Reserved (20%)
                    </div>
                    <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        <span class="w-2.5 h-2.5 rounded-full bg-orange-400 mr-2 shadow-sm"></span> Carpool (10%)
                    </div>
                    <div class="flex items-center text-[10px] font-black text-gray-400 uppercase tracking-widest">
                        <span class="w-2.5 h-2.5 rounded-full bg-purple-500 mr-2 shadow-sm"></span> Two-Way (5%)
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Row: Transactions & Alerts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Transactions Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-white flex items-center justify-between">
                    <h3 class="text-lg font-black text-gray-800 tracking-tight">Recent Activity</h3>
                    <button class="text-[10px] font-black text-[#1C69D4] uppercase tracking-widest hover:underline">View All</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-blue-50/30">
                            <tr>
                                <th class="px-6 py-4 text-[10px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Transaction ID</th>
                                <th class="px-6 py-4 text-[10px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50">Rider</th>
                                <th class="px-6 py-4 text-[10px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50 text-right">Amount</th>
                                <th class="px-6 py-4 text-[10px] font-black text-blue-900/60 uppercase tracking-widest border-b border-gray-50 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach([
                                ['id' => 'TXN-2458', 'user' => 'Ali Hassan', 'amount' => 'PKR 450', 'method' => 'Card', 'status' => 'Completed', 'color' => 'green'],
                                ['id' => 'TXN-2457', 'user' => 'Zara Malik', 'amount' => 'PKR 320', 'method' => 'Wallet', 'status' => 'Completed', 'color' => 'green'],
                                ['id' => 'TXN-2456', 'user' => 'Hassan Raza', 'amount' => 'PKR 580', 'method' => 'Cash', 'status' => 'Completed', 'color' => 'green'],
                                ['id' => 'TXN-2455', 'user' => 'Ayesha Khan', 'amount' => 'PKR 290', 'method' => 'Card', 'status' => 'Failed', 'color' => 'red'],
                            ] as $txn)
                            <tr class="hover:bg-blue-50/10 transition-colors group">
                                <td class="px-6 py-5 text-[12px] font-bold text-gray-500 uppercase tracking-tighter">{{ $txn['id'] }}</td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center font-black text-[10px] text-[#1C69D4] border border-gray-100 uppercase">{{ substr($txn['user'], 0, 1) }}{{ substr(explode(' ', $txn['user'])[1] ?? '', 0, 1) }}</div>
                                        <span class="text-sm font-black text-gray-900 tracking-tight">{{ $txn['user'] }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-sm font-black text-gray-900 text-right">{{ $txn['amount'] }}</td>
                                <td class="px-6 py-5 text-center">
                                    <span class="px-3 py-1 text-[10px] font-black bg-{{ $txn['color'] }}-50 text-{{ $txn['color'] }}-600 rounded-lg border border-{{ $txn['color'] }}-100 uppercase tracking-widest">{{ $txn['status'] }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Platform Alerts -->
            <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 flex flex-col">
                <h3 class="text-lg font-black text-gray-800 mb-6 pb-4 border-b border-gray-50 tracking-tight">Active Indicators</h3>
                <div class="flex-1 flex flex-col space-y-4">
                    <!-- Alert 1: High -->
                    <div class="flex items-center justify-between p-4 bg-red-50/30 rounded-xl border border-red-100 group hover:bg-red-50 transition-colors cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <span class="text-[12px] font-black text-gray-700 uppercase tracking-tight leading-tight">Driver verification pending for <span class="text-red-600">12 drivers</span></span>
                        </div>
                        <svg class="w-4 h-4 text-red-300 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <!-- Alert 2: Medium -->
                    <div class="flex items-center justify-between p-4 bg-orange-50/30 rounded-xl border border-orange-100 group hover:bg-orange-50 transition-colors cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-orange-100 text-orange-600 flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-[12px] font-black text-gray-700 uppercase tracking-tight leading-tight">3 rides flagged for <span class="text-orange-600">customer review</span></span>
                        </div>
                        <svg class="w-4 h-4 text-orange-300 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                    <!-- Alert 3: Low -->
                    <div class="flex items-center justify-between p-4 bg-blue-50/30 rounded-xl border border-blue-100 group hover:bg-blue-50 transition-colors cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 text-[#1C69D4] flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-[12px] font-black text-gray-700 uppercase tracking-tight leading-tight">Payment gateway latency <span class="text-[#1C69D4]">detected</span></span>
                        </div>
                        <svg class="w-4 h-4 text-blue-300 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js and initialization -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rides Over Time Line Chart
            const ridesCtx = document.getElementById('ridesOverTimeChart').getContext('2d');
            
            // Create gradient
            const gradient = ridesCtx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(28, 105, 212, 0.15)');
            gradient.addColorStop(1, 'rgba(28, 105, 212, 0)');

            new Chart(ridesCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Rides',
                        data: [240, 310, 270, 350, 420, 500, 460],
                        borderColor: '#1C69D4',
                        backgroundColor: gradient,
                        borderWidth: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#1C69D4',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 600,
                            ticks: {
                                stepSize: 150,
                                color: '#94a3b8',
                                font: { size: 10, weight: '800', family: "'Inter', sans-serif" }
                            },
                            grid: {
                                borderDash: [4, 4],
                                color: '#f1f5f9',
                                drawBorder: false
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: {
                                color: '#94a3b8',
                                font: { size: 10, weight: '800', family: "'Inter', sans-serif" }
                            }
                        }
                    }
                }
            });

            // Ride Type Breakdown Donut Chart
            const typeCtx = document.getElementById('rideTypeChart').getContext('2d');
            new Chart(typeCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Instant', 'Reserved', 'Carpool', 'Two-Way'],
                    datasets: [{
                        data: [65, 20, 10, 5],
                        backgroundColor: [
                            '#1C69D4',
                            '#22c55e',
                            '#fb923c',
                            '#a855f7'
                        ],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '80%',
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        });
    </script>
</x-app-layout>
