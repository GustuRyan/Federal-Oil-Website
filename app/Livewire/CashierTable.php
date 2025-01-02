<?php

namespace App\Livewire;

use Livewire\Component;

class CashierTable extends Component
{
    public $type;
    public function render()
    {
        return view('livewire.cashier-table');
    }
}
