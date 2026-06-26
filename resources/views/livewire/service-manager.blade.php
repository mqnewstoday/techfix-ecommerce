<div>
    <div class="bg-white p-6 rounded shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-700">Daftar Jasa (Services)</h3>
            <button wire:click="openModal" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded shadow transition-colors">
                + Tambah Jasa
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
                        <th class="p-4 border-b border-gray-100 font-medium">No</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Kode</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Nama Jasa</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Kategori</th>
                        <th class="p-4 border-b border-gray-100 font-medium">Harga / Tarif</th>
                        <th class="p-4 border-b border-gray-100 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $index => $service)
                    <tr class="hover:bg-gray-50 border-b border-gray-50 transition-colors">
                        <td class="p-4 text-gray-500">{{ $index + 1 }}</td>
                        <td class="p-4 text-gray-800 font-mono text-sm">{{ $service->code }}</td>
                        <td class="p-4 text-gray-800 font-medium">{{ $service->name }}</td>
                        <td class="p-4 text-gray-600">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-xs">{{ $service->category->name ?? '-' }}</span>
                        </td>
                        <td class="p-4 text-indigo-600 font-semibold">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-right">
                            <button wire:click="edit({{ $service->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4 font-medium transition-colors">Edit</button>
                            <button wire:click="delete({{ $service->id }})" class="text-red-500 hover:text-red-700 font-medium transition-colors">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400">Belum ada data jasa.</td>
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
        
        <div class="relative w-full max-w-lg mx-auto z-50 animate-in fade-in zoom-in duration-200">
            <div class="flex flex-col w-full bg-white rounded-xl shadow-2xl border border-gray-100">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $serviceId ? 'Edit Jasa' : 'Tambah Jasa' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
                </div>
                
                <div class="px-6 py-4">
                    <form wire:submit.prevent="store">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Kode Jasa</label>
                            <input wire:model="code" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                            @error('code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
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
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Nama Jasa / Layanan</label>
                            <input wire:model="name" type="text" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow" placeholder="Contoh: Instal Ulang Windows 11">
                            @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-medium mb-2">Tarif / Harga</label>
                            <input wire:model="price" type="number" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-shadow">
                            @error('price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex items-center justify-end pt-4 mt-4 border-t border-gray-100">
                            <button wire:click="closeModal" type="button" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 mr-2 transition-colors">
                                Batal
                            </button>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm transition-colors">
                                Simpan Jasa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
