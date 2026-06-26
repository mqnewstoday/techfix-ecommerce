<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryManager extends Component
{
    public $categories;
    public $name = '';
    public $categoryId = null;
    public $isModalOpen = false;

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
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
        $this->name = '';
        $this->categoryId = null;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name
        ]);

        session()->flash('message', $this->categoryId ? 'Kategori berhasil diperbarui.' : 'Kategori berhasil ditambahkan.');

        $this->closeModal();
        $this->loadCategories();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Kategori berhasil dihapus.');
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.category-manager')->layout('components.layouts.app', ['title' => 'Daftar Kategori']);
    }
}
