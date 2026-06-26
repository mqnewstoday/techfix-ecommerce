<div>
    <div class="flex justify-between items-center mb-8">
        <div>
            <h3 class="text-2xl font-bold text-slate-800">Monitoring Transaksi</h3>
            <p class="text-slate-500 text-sm mt-1">Pantau semua pesanan yang masuk dari pelanggan.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm" role="alert">
            <p class="font-medium">{{ session('message') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm">ID</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm">Pembeli</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm">Item & Total</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm">Metode</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm">Status</th>
                        <th class="py-4 px-6 font-semibold text-slate-600 text-sm text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr class="border-b border-slate-50 hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 font-mono text-sm text-slate-500">#{{ $trx->id }}</td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-slate-800">{{ $trx->user->name }}</div>
                            <div class="text-xs text-slate-500 mt-1">{{ $trx->user->phone ?? '-' }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <ul class="text-sm text-slate-600 list-disc list-inside mb-2">
                                @foreach($trx->items as $item)
                                    <li>{{ $item->product->name ?? 'Produk Dihapus' }} (x{{ $item->quantity }})</li>
                                @endforeach
                            </ul>
                            <div class="font-semibold text-indigo-600">Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-slate-100 text-slate-600">
                                {{ $trx->payment_method }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            @if($trx->status === 'pending')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Menunggu</span>
                            @elseif($trx->status === 'paid')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">Dibayar</span>
                            @elseif($trx->status === 'completed')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Selesai</span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="py-4 px-6 text-right">
                            <div class="flex flex-col gap-2 items-end">
                                @if($trx->status === 'pending')
                                    <button wire:click="updateStatus({{ $trx->id }}, 'paid')" class="text-xs font-medium text-blue-600 hover:text-blue-800">Tandai Dibayar</button>
                                @endif
                                @if($trx->status === 'paid')
                                    <button wire:click="updateStatus({{ $trx->id }}, 'completed')" class="text-xs font-medium text-green-600 hover:text-green-800">Tandai Selesai</button>
                                @endif
                                @if($trx->status !== 'cancelled' && $trx->status !== 'completed')
                                    <button wire:click="updateStatus({{ $trx->id }}, 'cancelled')" class="text-xs font-medium text-red-600 hover:text-red-800">Batalkan</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-500">Belum ada transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
