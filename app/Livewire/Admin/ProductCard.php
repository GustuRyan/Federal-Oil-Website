<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.admin.product-card');
    }
}
