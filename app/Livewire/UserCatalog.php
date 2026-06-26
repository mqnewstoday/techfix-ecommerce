<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class UserCatalog extends Component
{
    public function render()
    {
        // Get all products, optionally we can add pagination or search later
        $products = Product::with('category')->get();
        return view('livewire.user-catalog', compact('products'))
            ->layout('components.layouts.app', ['title' => 'Belanja Produk']);
    }
}
