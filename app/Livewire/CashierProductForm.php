<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class CashierProductForm extends Component
{
    public $isOpen;
    public function mount()
    {
        $this->products = Product::all();
    }
    public function render()
    {
        return view('livewire.cashier-product-form', [
            'products' => $this->products,
        ]);
    }
}