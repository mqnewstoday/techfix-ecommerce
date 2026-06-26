<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class UserService extends Component
{
    public function render()
    {
        $services = Service::all();
        return view('livewire.user-service', compact('services'))
            ->layout('components.layouts.app', ['title' => 'Layanan IT']);
    }
}
