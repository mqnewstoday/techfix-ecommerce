<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    @if($is_success)
        <div class="bg-white rounded-3xl p-10 text-center shadow-xl border border-slate-100 animate-fade-in-up">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-slate-800 mb-4">Pesanan Berhasil!</h2>
            <p class="text-slate-500 mb-8 max-w-md mx-auto">Terima kasih telah berbelanja. Pesanan Anda sedang kami proses.</p>
            
            @if($payment_method === 'qris')
                <div class="bg-slate-50 p-6 rounded-2xl inline-block mb-8 border border-slate-200">
                    <p class="font-semibold text-slate-700 mb-4">Silakan Scan QRIS (Fiktif) ini untuk simulasi pembayaran:</p>
                    <img src="{{ $fake_qris_url }}" alt="QRIS Fiktif" class="mx-auto rounded-xl shadow-sm border border-slate-200">
                </div>
            @elseif($payment_method === 'transfer')
                <div class="bg-slate-50 p-6 rounded-2xl max-w-md mx-auto text-left mb-8 border border-slate-200">
                    <p class="font-semibold text-slate-700 mb-2">Instruksi Transfer (Fiktif):</p>
                    <p class="text-slate-600">Bank Dummy: <strong>BCA</strong></p>
                    <p class="text-slate-600">No. Rekening: <strong class="text-indigo-600 text-xl tracking-wider">123-456-7890</strong></p>
                    <p class="text-slate-600">Atas Nama: <strong>PT IT Store Fiktif</strong></p>
                </div>
            @elseif($payment_method === 'cod')
                <div class="bg-indigo-50 p-6 rounded-2xl max-w-md mx-auto mb-8 border border-indigo-100">
                    <p class="text-indigo-700 font-medium">Silakan siapkan uang tunai sebesar <strong>Rp {{ number_format($product->selling_price * $quantity, 0, ',', '.') }}</strong> saat kurir tiba di alamat Anda.</p>
                </div>
            @endif

            <div>
                <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-md hover:shadow-lg transition-all">
                    Kembali Belanja
                </a>
            </div>
        </div>
    @else
        <h1 class="text-3xl font-bold text-slate-800 mb-8">Checkout Pesanan</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Rincian Produk -->
            <div class="md:col-span-2 space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Produk yang Dibeli</h2>
                    <div class="flex items-center gap-6">
                        <div class="w-24 h-24 rounded-xl overflow-hidden bg-slate-100 flex-shrink-0">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-slate-800">{{ $product->name }}</h3>
                            <p class="text-slate-500 text-sm mb-2">Kategori: {{ $product->category->name }}</p>
                            <div class="text-indigo-600 font-bold text-lg">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Informasi Pengiriman</h2>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200">
                        <p class="font-medium text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-slate-600 mt-1">{{ auth()->user()->phone ?? 'Belum ada nomor HP' }}</p>
                        <p class="text-slate-600 mt-1">{{ auth()->user()->address ?? 'Belum ada alamat pengiriman' }}</p>
                        
                        <div class="mt-4 pt-4 border-t border-slate-200">
                            <a href="/profile" class="text-sm text-indigo-600 font-medium hover:text-indigo-800 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Ubah Alamat di Profil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ringkasan & Pembayaran -->
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Metode Pembayaran</h2>
                    <div class="space-y-3">
                        <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors {{ $payment_method === 'cod' ? 'ring-2 ring-indigo-500 border-indigo-500' : '' }}">
                            <input type="radio" wire:model="payment_method" value="cod" class="text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="ml-3 font-medium text-slate-700">Bayar di Tempat (COD)</span>
                        </label>
                        <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors {{ $payment_method === 'transfer' ? 'ring-2 ring-indigo-500 border-indigo-500' : '' }}">
                            <input type="radio" wire:model="payment_method" value="transfer" class="text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="ml-3 font-medium text-slate-700">Transfer Bank</span>
                        </label>
                        <label class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors {{ $payment_method === 'qris' ? 'ring-2 ring-indigo-500 border-indigo-500' : '' }}">
                            <input type="radio" wire:model="payment_method" value="qris" class="text-indigo-600 focus:ring-indigo-500 w-4 h-4">
                            <span class="ml-3 font-medium text-slate-700">QRIS (Scan Barcode)</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">Ringkasan Belanja</h2>
                    
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-slate-600">Jumlah</span>
                        <div class="flex items-center gap-3">
                            <button wire:click="$set('quantity', {{ $quantity > 1 ? $quantity - 1 : 1 }})" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200">-</button>
                            <span class="font-semibold">{{ $quantity }}</span>
                            <button wire:click="$set('quantity', {{ $quantity < $product->stock ? $quantity + 1 : $product->stock }})" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200">+</button>
                        </div>
                    </div>

                    <div class="flex justify-between text-slate-600 mb-4 pb-4 border-b border-slate-100">
                        <span>Total Harga</span>
                        <span class="font-semibold">Rp {{ number_format($product->selling_price * $quantity, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between text-lg font-bold text-slate-800 mb-6">
                        <span>Total Bayar</span>
                        <span class="text-indigo-600">Rp {{ number_format($product->selling_price * $quantity, 0, ',', '.') }}</span>
                    </div>

                    <button wire:click="processCheckout" class="w-full py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Bayar Sekarang
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
