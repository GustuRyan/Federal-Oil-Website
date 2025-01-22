<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;

class CashierServiceForm extends Component
{
    public $isOpen;
    public function mount()
    {
        $this->services = Service::all();
    }
    public function render()
    {
        return view('livewire.cashier-service-form', [
            'services' => $this->services,
        ]);
    }
}
