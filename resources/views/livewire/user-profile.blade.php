<div class="max-w-3xl mx-auto">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100">
        <h3 class="text-2xl font-bold text-slate-800 mb-6">Profil Pengguna</h3>

        @if (session()->has('message'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="updateProfile">
            <div class="flex flex-col sm:flex-row gap-8 mb-8">
                <!-- Avatar Upload -->
                <div class="flex flex-col items-center gap-4">
                    <div class="relative w-32 h-32 rounded-full overflow-hidden bg-slate-100 border-4 border-white shadow-lg">
                        @if ($new_avatar)
                            <img src="{{ $new_avatar->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($avatar)
                            <img src="{{ asset('storage/' . $avatar) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="relative w-full">
                        <input type="file" wire:model="new_avatar" id="avatarUpload" class="hidden">
                        <label for="avatarUpload" class="cursor-pointer flex items-center justify-center w-full px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-semibold rounded-lg hover:bg-indigo-100 transition-colors">
                            Ganti Foto
                        </label>
                        <div wire:loading wire:target="new_avatar" class="text-xs text-slate-500 mt-2 text-center w-full">Mengunggah...</div>
                    </div>
                    @error('new_avatar') <span class="text-xs text-red-500 text-center">{{ $message }}</span> @enderror
                </div>

                <!-- Form Fields -->
                <div class="flex-1 space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Email</label>
                        <input type="email" wire:model="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                        @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor HP / WhatsApp</label>
                        <input type="text" wire:model="phone" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all" placeholder="08123456789">
                        @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1">Alamat Lengkap (Untuk Pengiriman)</label>
                        <textarea wire:model="address" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all placeholder:text-slate-400" placeholder="Jl. Sudirman No. 123, Jakarta"></textarea>
                        @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
