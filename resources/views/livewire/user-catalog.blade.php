<div>
    <div class="mb-8">
        <h3 class="text-2xl font-bold text-slate-800">Katalog Produk</h3>
        <p class="text-slate-500 text-sm mt-1">Pilih dan beli produk IT terbaik kami langsung dari dashboard Anda.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden hover:shadow-lg transition-all group flex flex-col hover:-translate-y-1">
            <div class="h-48 bg-slate-100 flex items-center justify-center relative overflow-hidden">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <svg class="w-12 h-12 text-slate-300 group-hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                @endif
                
                @if($product->stock <= 0)
                    <div class="absolute top-3 right-3 bg-red-100 text-red-600 text-xs font-bold px-2.5 py-1.5 rounded-lg shadow-sm">Stok Habis</div>
                @endif
            </div>
            
            <div class="p-5 flex flex-col flex-1">
                <div class="text-xs text-indigo-600 mb-2 font-semibold tracking-wide uppercase">{{ $product->category->name ?? 'Kategori' }}</div>
                <h3 class="font-bold text-slate-800 text-base leading-tight mb-3 line-clamp-2">{{ $product->name }}</h3>
                
                <div class="mt-auto pt-4 flex flex-col gap-3 border-t border-slate-100">
                    <span class="font-extrabold text-slate-900 text-lg">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                    
                    @if($product->stock > 0)
                        <a href="/checkout/{{ $product->id }}" class="w-full text-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-xl shadow-md transition-all active:scale-95 flex justify-center items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Beli Sekarang
                        </a>
                    @else
                        <button disabled class="w-full px-4 py-2.5 bg-slate-100 text-slate-400 text-sm font-bold rounded-xl cursor-not-allowed">
                            Habis Terjual
                        </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-100 shadow-sm">
            <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-slate-800">Belum Ada Produk</h3>
            <p class="text-slate-500 mt-1">Saat ini belum ada produk yang dijual.</p>
        </div>
        @endforelse
    </div>
</div>
