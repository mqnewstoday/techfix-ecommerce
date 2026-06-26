<div>
    <div class="bg-white p-6 rounded shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Daftar Produk (Barang IT)</h3>
            <button wire:click="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded shadow transition-colors">
                + Tambah Produk
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider">
                        <th class="p-4 border-b border-gray-100 font-medium">Foto</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Kode</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Nama</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Kategori</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Harga Jual</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Stok</th>
                        <th class="p-4 border-b border-gray-100 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $index => $product)
                    <tr class="hover:bg-gray-50 border-b border-gray-50 transition-colors">
                        <td class="p-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-lg shadow-sm border border-slate-200">
                            @else
                                <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center text-slate-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 text-gray-800 font-mono text-sm">{{ $product->code }}</td>
                        <td class="p-4 text-gray-800 font-medium">
                            {{ $product->name }}
                            @if($product->brand)
                                <span class="text-xs text-gray-400 block">{{ $product->brand }}</span>
                            @endif
                        </td>
                        <td class="p-4 text-gray-600">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">{{ $product->category->name ?? '-' }}</span>
                        </td>
                        <td class="p-4 text-indigo-600 font-semibold">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <span class="{{ $product->stock > 5 ? 'text-green-600' : 'text-red-500 font-bold' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <button wire:click="edit({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium transition-colors">Edit</button>
                            <button wire:click="delete({{ $product->id }})" class="text-red-500 hover:text-red-700 font-medium transition-colors">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400">Belum ada data produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    @if($isModalOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center overflow-x-hidden overflow-y-auto">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>
        
        <div class="relative w-full max-w-2xl mx-auto z-50 animate-in fade-in zoom-in duration-200">
            <div class="flex flex-col w-full bg-white rounded-xl shadow-2xl border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $productId ? 'Edit Produk' : 'Tambah Produk' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
                </div>
                
                <div class="px-6 py-4">
                    <form wire:submit.prevent="store">
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Kode -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Kode Produk</label>
                                <input wire:model="code" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                                @error('code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <!-- Kategori -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
                                <select wire:model="category_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow bg-white">
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <!-- Nama -->
                            <div class="mb-4 col-span-2">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Nama Produk</label>
                                <input wire:model="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <!-- Merk -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Merk</label>
                                <input wire:model="brand" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                            </div>
                            <!-- Stok -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Stok Awal</label>
                                <input wire:model="stock" type="number" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                                @error('stock') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <!-- Harga Jual -->
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Harga Jual (Rp)</label>
                                <input wire:model="selling_price" type="number" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                                @error('selling_price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <!-- Foto Produk -->
                            <div class="mb-4 col-span-2">
                                <label class="block text-gray-700 text-sm font-medium mb-2">Foto Produk</label>
                                <input type="file" wire:model="image" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                                <div wire:loading wire:target="image" class="text-sm text-slate-500 mt-1">Mengunggah...</div>
                                @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>@enderror
                                @if ($image)
                                    <div class="mt-2">
                                        <img src="{{ $image->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-xl shadow-sm border border-slate-200">
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-end pt-4 mt-4 border-t border-gray-100">
                            <button wire:click="closeModal" type="button" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 mr-2 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm transition-colors">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
