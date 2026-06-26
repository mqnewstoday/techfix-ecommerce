<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $product;
    public $quantity = 1;
    public $payment_method = 'cod';
    public $payment_status = 'pending';
    public $is_success = false;
    public $fake_qris_url = '';

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function processCheckout()
    {
        // Validasi Alamat
        if (!Auth::user()->address || !Auth::user()->phone) {
            session()->flash('error', 'Mohon lengkapi alamat dan nomor HP di Profil Anda terlebih dahulu.');
            return redirect('/profile');
        }

        if ($this->quantity > $this->product->stock) {
            session()->flash('error', 'Stok tidak mencukupi.');
            return;
        }

        $total_amount = $this->product->selling_price * $this->quantity;

        // Generate Fake QRIS if chosen
        if ($this->payment_method === 'qris') {
            $this->fake_qris_url = 'https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=QRIS_FAKE_'.time();
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_amount' => $total_amount,
            'payment_method' => $this->payment_method,
            'status' => 'pending',
        ]);

        TransactionItem::create([
            'transaction_id' => $transaction->id,
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'price' => $this->product->selling_price,
        ]);

        // Kurangi stok
        $this->product->decrement('stock', $this->quantity);

        $this->is_success = true;
    }

    public function render()
    {
        return view('livewire.checkout')->layout('components.layouts.app', ['title' => 'Checkout Produk']);
    }
}
