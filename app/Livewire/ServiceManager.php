<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;

class ServiceManager extends Component
{
    public $services;
    public $categories;
    
    public $serviceId = null;
    public $code = '';
    public $name = '';
    public $category_id = '';
    public $price = 0;
    
    public $isModalOpen = false;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->services = Service::with('category')->get();
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
        $this->serviceId = null;
        $this->code = '';
        $this->name = '';
        $this->category_id = '';
        $this->price = 0;
    }

    public function store()
    {
        $this->validate([
            'code' => 'required|string|unique:services,code,' . $this->serviceId,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
        ]);

        Service::updateOrCreate(['id' => $this->serviceId], [
            'code' => $this->code,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'price' => $this->price,
        ]);

        session()->flash('message', $this->serviceId ? 'Jasa diperbarui.' : 'Jasa ditambahkan.');

        $this->closeModal();
        $this->loadData();
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $this->serviceId = $id;
        $this->code = $service->code;
        $this->name = $service->name;
        $this->category_id = $service->category_id;
        $this->price = $service->price;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        Service::find($id)->delete();
        session()->flash('message', 'Jasa dihapus.');
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.service-manager')->layout('components.layouts.app', ['title' => 'Daftar Jasa (Services)']);
    }
}
