<!-- Add Admin Modal -->
<div id="addAdminModal" class="fixed inset-0 z-50 overflow-y-auto" x-show="adminModalOpen" x-cloak x-transition.opacity>
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl transform transition-all flex flex-col overflow-hidden border border-gray-100" 
             x-show="adminModalOpen" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 scale-95" 
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">
            
            <!-- Modal Header -->
            <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-black text-gray-900 tracking-tight">Add New Administrator</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Grant platform access to a new user</p>
                </div>
                <button @click="adminModalOpen = false" class="p-2 hover:bg-gray-100 rounded-xl transition-colors text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <form action="#" method="POST" class="p-8 space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Full Name -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Full Name</label>
                        <input type="text" name="name" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-bold text-sm text-gray-900 transition-all" placeholder="e.g. John Doe">
                    </div>

                    <!-- Email Address -->
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Email Address</label>
                        <input type="email" name="email" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-bold text-sm text-gray-900 transition-all" placeholder="admin@example.com">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Role -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Access Role</label>
                            <select name="role" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-bold text-xs text-gray-700 transition-all uppercase tracking-widest">
                                <option value="super_admin">Super Admin</option>
                                <option value="moderator">Moderator</option>
                                <option value="support">Support</option>
                            </select>
                        </div>

                        <!-- Password -->
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest px-1">Inital Password</label>
                            <input type="password" name="password" required class="w-full px-5 py-3.5 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-[#1C69D4]/10 focus:border-[#1C69D4] outline-none font-bold text-sm text-gray-900 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="bg-blue-50/50 p-4 rounded-2xl border border-blue-100 flex items-start gap-4">
                    <div class="w-8 h-8 rounded-xl bg-[#1C69D4] text-white flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <p class="text-[10px] font-bold text-[#1C69D4] leading-relaxed uppercase tracking-tight">Access level can be modified later under admin settings. Ensure the email is accurate for notifications.</p>
                </div>

                <!-- Action Buttons -->
                <div class="grid grid-cols-2 gap-4 pt-4 shrink-0">
                    <button type="button" @click="adminModalOpen = false" 
                            class="px-6 py-4 bg-white border border-gray-100 text-gray-500 font-black text-[11px] rounded-2xl hover:bg-gray-100 transition-all active:scale-95 uppercase tracking-[0.2em]">Cancel</button>
                    <button type="submit" class="px-6 py-4 bg-[#1C69D4] text-white font-black text-[11px] rounded-2xl shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 uppercase tracking-[0.2em]">Create Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
