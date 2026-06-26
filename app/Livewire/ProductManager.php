<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithFileUploads;

    public $products;
    public $categories;
    
    public $productId = null;
    public $code = '';
    public $name = '';
    public $category_id = '';
    public $brand = '';
    public $purchase_price = 0;
    public $selling_price = 0;
    public $discount = 0;
    public $stock = 0;
    public $image = null;
    
    public $isModalOpen = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->products = Product::with('category')->get();
        $this->categories = Category::all();
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->productId = null;
        $this->code = '';
        $this->name = '';
        $this->category_id = '';
        $this->brand = '';
        $this->purchase_price = 0;
        $this->selling_price = 0;
        $this->discount = 0;
        $this->stock = 0;
        $this->image = null;
    }

    public function store()
    {
        $this->validate([
            'code' => 'required|string|unique:products,code,' . $this->productId,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = [
            'code' => $this->code,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'brand' => $this->brand,
            'purchase_price' => $this->purchase_price,
            'selling_price' => $this->selling_price,
            'discount' => $this->discount,
            'stock' => $this->stock,
        ];

        if ($this->image) {
            $data['image'] = $this->image->store('products', 'public');
        }

        if ($this->productId) {
            $product = Product::find($this->productId);
            if ($this->image && $product->image) {
                Storage::disk('public')->delete($product->image);
            }
        }

        Product::updateOrCreate(['id' => $this->productId], $data);

        session()->flash('message', $this->productId ? 'Produk diperbarui.' : 'Produk ditambahkan.');

        $this->closeModal();
        $this->loadData();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->code = $product->code;
        $this->name = $product->name;
        $this->category_id = $product->category_id;
        $this->brand = $product->brand;
        $this->purchase_price = $product->purchase_price;
        $this->selling_price = $product->selling_price;
        $this->discount = $product->discount;
        $this->stock = $product->stock;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        session()->flash('message', 'Produk dihapus.');
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.product-manager')->layout('components.layouts.app', ['title' => 'Daftar Produk']);
    }
}
