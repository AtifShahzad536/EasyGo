<!-- Adjust Balance Modal -->
<div id="adjustBalanceModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl transform transition-all scale-95 opacity-0 duration-300 max-h-[90vh] flex flex-col overflow-hidden" id="modalContainer">
            <!-- Modal Header - Compact -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between shrink-0">
                <h3 class="text-lg font-black text-gray-900 tracking-tight">Adjust Wallet Balance</h3>
                <button onclick="closeAdjustModal()" class="p-1.5 hover:bg-gray-100 rounded-full transition-colors text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="#" method="POST" class="p-5 space-y-4 overflow-y-auto flex-1">
                @csrf
                <!-- User Info Box - Tightened -->
                <div class="bg-blue-50/50 p-4 rounded-lg border border-blue-100 flex flex-col gap-0.5">
                    <span class="text-[9px] font-black text-blue-400 uppercase tracking-widest">User</span>
                    <h4 class="text-base font-black text-gray-900" id="modalUserName">Ahmed Khan</h4>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Current Balance</span>
                        <span class="text-xs font-black text-green-600" id="modalUserBalance">PKR 8,450</span>
                    </div>
                </div>

                <!-- Adjustment Type -->
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Adjustment Type</label>
                    <div class="flex gap-5">
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="adjustment_type" value="credit" checked class="w-3.5 h-3.5 text-[#1C69D4] focus:ring-[#1C69D4] border-gray-300">
                            <span class="text-xs font-bold text-gray-700 group-hover:text-gray-900 transition-colors flex items-center gap-1 font-sans">
                                <span class="text-blue-500 text-base">+</span> Add Credit
                            </span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer group">
                            <input type="radio" name="adjustment_type" value="debit" class="w-3.5 h-3.5 text-[#1C69D4] focus:ring-[#1C69D4] border-gray-300">
                            <span class="text-xs font-bold text-gray-700 group-hover:text-gray-900 transition-colors flex items-center gap-1 font-sans">
                                <span class="text-red-500 text-base">-</span> Deduct Amount
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Amount Input -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Amount (PKR) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-lg focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-bold text-sm text-gray-900 transition-all" placeholder="Enter amount">
                </div>

                <!-- Reason Textarea -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Reason/Note <span class="text-red-500">*</span></label>
                    <textarea rows="2" class="w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-lg focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-medium text-xs text-gray-700 transition-all resize-none" placeholder="Enter reason for adjustment..."></textarea>
                </div>

                <!-- Irreversible Warning - More Compact -->
                <div class="bg-amber-50/70 p-3 rounded-lg border border-amber-100 flex items-start gap-2.5">
                    <svg class="w-4 h-4 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <p class="text-[10px] font-bold text-amber-700 leading-tight uppercase tracking-tight">Irreversible action. Verify details before confirming.</p>
                </div>

                <!-- Action Buttons - Compact -->
                <div class="grid grid-cols-2 gap-3 pt-3 border-t border-gray-50 shrink-0">
                    <button type="button" onclick="closeAdjustModal()" class="px-4 py-3 bg-white border border-gray-200 text-gray-600 font-black text-[10px] rounded-lg hover:bg-gray-50 transition-all active:scale-95 uppercase tracking-widest">Cancel</button>
                    <button type="submit" class="px-4 py-3 bg-[#1C69D4] text-white font-black text-[10px] rounded-lg shadow-lg shadow-[#1C69D4]/20 hover:bg-blue-700 transition-all active:scale-95 uppercase tracking-widest">Confirm Adjustment</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openAdjustModal(user, balance) {
        const modal = document.getElementById('adjustBalanceModal');
        const container = document.getElementById('modalContainer');
        document.getElementById('modalUserName').innerText = user;
        document.getElementById('modalUserBalance').innerText = balance;
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            container.classList.remove('scale-95', 'opacity-0');
            container.classList.add('scale-100', 'opacity-100');
        }, 10);
    }

    function closeAdjustModal() {
        const modal = document.getElementById('adjustBalanceModal');
        const container = document.getElementById('modalContainer');
        
        container.classList.remove('scale-100', 'opacity-100');
        container.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
