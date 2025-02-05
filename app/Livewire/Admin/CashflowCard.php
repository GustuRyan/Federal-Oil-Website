<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class CashflowCard extends Component
{
    public $title;
    public $value;
    public $time;
    public function render()
    {
        return view('livewire.admin.cashflow-card');
    }
}
