<div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-slate-100">
    <div class="text-center mb-8">
        <a href="/" class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl text-white font-bold shadow-lg mb-4">TF</a>
        <h2 class="text-2xl font-bold text-slate-900">Masuk ke TechFix</h2>
        <p class="text-sm text-slate-500 mt-2">Selamat datang kembali, silakan masuk ke akun admin kamu.</p>
    </div>

    <form wire:submit.prevent="login" class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
            <input wire:model="email" type="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" placeholder="admin@techfix.com">
            @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input wire:model="password" type="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" placeholder="••••••••">
            @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all active:scale-95">
            Masuk
        </button>
    </form>

    <p class="text-center text-sm text-slate-500 mt-8">
        Belum punya akun? <a href="/register" class="text-indigo-600 hover:text-indigo-800 font-semibold">Daftar di sini</a>
    </p>
</div>
