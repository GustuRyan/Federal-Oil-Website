<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Product;

class CashierTable extends Component
{
    public $type;
    public $items;
    public $sub_total;

    public $isProductFormVisible = false; 
    public $isServiceFormVisible = false; 

    public function toggleProductForm()
    {
        $this->isProductFormVisible = !$this->isProductFormVisible;
    }

    public function toggleServiceForm()
    {
        $this->isServiceFormVisible = !$this->isServiceFormVisible;
    }

    public function render()
    {
        return view('livewire.cashier-table');
    }
}
