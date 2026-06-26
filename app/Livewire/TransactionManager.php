<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class TransactionManager extends Component
{
    public function updateStatus($id, $status)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->update(['status' => $status]);
        session()->flash('message', 'Status pesanan #'.$id.' berhasil diperbarui.');
    }

    public function render()
    {
        $transactions = Transaction::with(['user', 'items.product'])->latest()->get();
        return view('livewire.transaction-manager', compact('transactions'))->layout('components.layouts.app', ['title' => 'Monitoring Transaksi']);
    }
}
