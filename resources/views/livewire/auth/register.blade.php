<div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-slate-100">
    <div class="text-center mb-8">
        <a href="/" class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl text-white font-bold shadow-lg mb-4">TF</a>
        <h2 class="text-2xl font-bold text-slate-900">Daftar Akun Baru</h2>
        <p class="text-sm text-slate-500 mt-2">Buat akun untuk mengelola toko dan servis IT.</p>
    </div>

    <form wire:submit.prevent="register" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
            <input wire:model="name" type="text" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
            @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input wire:model="email" type="email" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input wire:model="password" type="password" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
            @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
            <input wire:model="password_confirmation" type="password" class="w-full px-4 py-2 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
        </div>

        <button type="submit" class="w-full py-3 px-4 mt-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all active:scale-95">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-6">
        Sudah punya akun? <a href="/login" class="text-indigo-600 hover:text-indigo-800 font-semibold">Masuk di sini</a>
    </p>
</div>
